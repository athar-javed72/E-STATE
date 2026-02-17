<?php

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Events\TaskUpdated;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Task::class);

        $query = Task::query()->with(['project', 'site', 'assignee']);

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($assigneeId = $request->input('assignee_id')) {
            $query->where('assignee_id', $assigneeId);
        }

        if ($projectId = $request->input('project_id')) {
            $query->where('project_id', $projectId);
        }

        if ($siteId = $request->input('site_id')) {
            $query->where('site_id', $siteId);
        }

        $tasks = $query->paginate($request->integer('per_page', 20));

        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Task::class);

        $data = $request->validate([
            'project_id' => ['nullable', 'exists:projects,id'],
            'site_id' => ['nullable', 'exists:sites,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
            'priority' => ['nullable', 'string', 'max:50'],
            'assignee_id' => ['nullable', 'exists:users,id'],
            'reporter_id' => ['nullable', 'exists:users,id'],
            'scheduled_start_at' => ['nullable', 'date'],
            'scheduled_end_at' => ['nullable', 'date', 'after_or_equal:scheduled_start_at'],
            'estimated_minutes' => ['nullable', 'integer', 'min:0'],
            'parent_task_id' => ['nullable', 'exists:tasks,id'],
            'tags' => ['nullable', 'array'],
            'metadata' => ['nullable', 'array'],
        ]);

        /** @var \App\Models\Task $task */
        $task = Task::create($data);

        return response()->json([
            'data' => $task->fresh(['project', 'site', 'assignee']),
        ], 201);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return response()->json([
            'data' => $task->load(['project', 'site', 'assignee', 'dependencies', 'dependents']),
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $data = $request->validate([
            'project_id' => ['nullable', 'exists:projects,id'],
            'site_id' => ['nullable', 'exists:sites,id'],
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
            'priority' => ['nullable', 'string', 'max:50'],
            'assignee_id' => ['nullable', 'exists:users,id'],
            'reporter_id' => ['nullable', 'exists:users,id'],
            'scheduled_start_at' => ['nullable', 'date'],
            'scheduled_end_at' => ['nullable', 'date', 'after_or_equal:scheduled_start_at'],
            'estimated_minutes' => ['nullable', 'integer', 'min:0'],
            'parent_task_id' => ['nullable', 'exists:tasks,id'],
            'tags' => ['nullable', 'array'],
            'metadata' => ['nullable', 'array'],
        ]);

        $task->update($data);

        event(new TaskUpdated($task));

        return response()->json([
            'data' => $task->fresh(['project', 'site', 'assignee']),
        ]);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response()->json([], 204);
    }

    public function complete(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        event(new TaskUpdated($task));

        return response()->json([
            'data' => $task->fresh(),
        ]);
    }
}

