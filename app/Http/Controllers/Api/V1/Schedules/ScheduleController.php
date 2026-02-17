<?php

namespace App\Http\Controllers\Api\V1\Schedules;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Schedule::class);

        $query = Schedule::query()->with(['task', 'site', 'technician']);

        if ($technicianId = $request->input('technician_id')) {
            $query->where('technician_id', $technicianId);
        }

        if ($siteId = $request->input('site_id')) {
            $query->where('site_id', $siteId);
        }

        if ($from = $request->input('from')) {
            $query->where('starts_at', '>=', $from);
        }

        if ($to = $request->input('to')) {
            $query->where('ends_at', '<=', $to);
        }

        $schedules = $query->paginate($request->integer('per_page', 50));

        return response()->json($schedules);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Schedule::class);

        $data = $request->validate([
            'task_id' => ['nullable', 'exists:tasks,id'],
            'site_id' => ['nullable', 'exists:sites,id'],
            'technician_id' => ['nullable', 'exists:users,id'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'status' => ['nullable', 'string', 'max:50'],
            'title' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'metadata' => ['nullable', 'array'],
        ]);

        /** @var \App\Models\Schedule $schedule */
        $schedule = Schedule::create($data);

        return response()->json([
            'data' => $schedule->fresh(['task', 'site', 'technician']),
        ], 201);
    }

    public function show(Schedule $schedule)
    {
        $this->authorize('view', $schedule);

        return response()->json([
            'data' => $schedule->load(['task', 'site', 'technician']),
        ]);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $this->authorize('update', $schedule);

        $data = $request->validate([
            'task_id' => ['nullable', 'exists:tasks,id'],
            'site_id' => ['nullable', 'exists:sites,id'],
            'technician_id' => ['nullable', 'exists:users,id'],
            'starts_at' => ['sometimes', 'date'],
            'ends_at' => ['sometimes', 'date', 'after:starts_at'],
            'status' => ['nullable', 'string', 'max:50'],
            'title' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'metadata' => ['nullable', 'array'],
        ]);

        $schedule->update($data);

        return response()->json([
            'data' => $schedule->fresh(['task', 'site', 'technician']),
        ]);
    }

    public function destroy(Schedule $schedule)
    {
        $this->authorize('delete', $schedule);

        $schedule->delete();

        return response()->json([], 204);
    }
}

