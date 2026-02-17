<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\Schedule;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view dashboard');

        $stats = [
            'projects' => [
                'total' => Project::count(),
                'active' => Project::where('status', 'active')->count(),
                'on_hold' => Project::where('status', 'on_hold')->count(),
                'completed' => Project::where('status', 'completed')->count(),
            ],
            'tasks' => [
                'total' => Task::count(),
                'backlog' => Task::where('status', 'backlog')->count(),
                'in_progress' => Task::where('status', 'in_progress')->count(),
                'completed' => Task::where('status', 'completed')->count(),
                'overdue' => Task::whereNotNull('scheduled_end_at')
                    ->where('scheduled_end_at', '<', now())
                    ->where('status', '!=', 'completed')
                    ->count(),
            ],
            'tickets' => [
                'total' => Ticket::count(),
                'open' => Ticket::where('status', 'open')->count(),
                'in_progress' => Ticket::where('status', 'in_progress')->count(),
                'resolved' => Ticket::where('status', 'resolved')->count(),
            ],
            'schedules' => [
                'today' => Schedule::whereDate('starts_at', today())->count(),
                'upcoming' => Schedule::whereDate('starts_at', '>', today())->count(),
            ],
        ];

        return response()->json([
            'data' => $stats,
        ]);
    }
}

