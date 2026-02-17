<?php

namespace App\Http\Controllers\Api\V1\ActivityLogs;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', ActivityLog::class);

        $query = ActivityLog::query()->with(['user', 'subject']);

        if ($userId = $request->input('user_id')) {
            $query->where('user_id', $userId);
        }

        if ($event = $request->input('event')) {
            $query->where('event', $event);
        }

        if ($subjectType = $request->input('subject_type')) {
            $query->where('subject_type', $subjectType);
        }

        $logs = $query->orderByDesc('created_at')
            ->paginate($request->integer('per_page', 50));

        return response()->json($logs);
    }
}

