<?php

namespace App\Http\Controllers\Api\V1\Projects;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Project::class);

        $query = Project::query()->with(['site', 'manager']);

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($managerId = $request->input('manager_id')) {
            $query->where('manager_id', $managerId);
        }

        if ($siteId = $request->input('site_id')) {
            $query->where('site_id', $siteId);
        }

        $projects = $query->paginate($request->integer('per_page', 20));

        return response()->json($projects);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Project::class);

        $data = $request->validate([
            'site_id' => ['nullable', 'exists:sites,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50', 'unique:projects,code'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
            'priority' => ['nullable', 'string', 'max:50'],
            'start_date' => ['nullable', 'date'],
            'due_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'manager_id' => ['nullable', 'exists:users,id'],
            'metadata' => ['nullable', 'array'],
        ]);

        /** @var \App\Models\Project $project */
        $project = Project::create($data);

        return response()->json([
            'data' => $project->fresh(['site', 'manager']),
        ], 201);
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return response()->json([
            'data' => $project->load(['site', 'manager', 'tasks', 'tickets']),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $data = $request->validate([
            'site_id' => ['nullable', 'exists:sites,id'],
            'name' => ['sometimes', 'string', 'max:255'],
            'code' => ['sometimes', 'string', 'max:50', 'unique:projects,code,' . $project->id],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
            'priority' => ['nullable', 'string', 'max:50'],
            'start_date' => ['nullable', 'date'],
            'due_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'manager_id' => ['nullable', 'exists:users,id'],
            'metadata' => ['nullable', 'array'],
        ]);

        $project->update($data);

        return response()->json([
            'data' => $project->fresh(['site', 'manager']),
        ]);
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return response()->json([], 204);
    }
}

