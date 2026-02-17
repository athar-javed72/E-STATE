<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Projects\ProjectController;
use App\Http\Controllers\Api\V1\Tasks\TaskController;
use App\Http\Controllers\Api\V1\Tickets\TicketController;
use App\Http\Controllers\Api\V1\Sites\SiteController;
use App\Http\Controllers\Api\V1\Schedules\ScheduleController;
use App\Http\Controllers\Api\V1\Dashboard\DashboardController;
use App\Http\Controllers\Api\V1\ActivityLogs\ActivityLogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Versioned, API-first endpoints for the Field Service Management platform.
| These routes are stateless and protected by token-based authentication.
|
*/

Route::prefix('v1')->group(function () {
    // Auth
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('auth/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

    // Protected FSM API
    Route::middleware('auth:sanctum')->group(function () {
        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])
            ->middleware('permission:view dashboard');

        // Projects
        Route::apiResource('projects', ProjectController::class);

        // Tasks
        Route::apiResource('tasks', TaskController::class);
        Route::post('tasks/{task}/complete', [TaskController::class, 'complete'])
            ->name('tasks.complete');

        // Tickets
        Route::apiResource('tickets', TicketController::class);

        // Sites
        Route::apiResource('sites', SiteController::class);

        // Schedules
        Route::apiResource('schedules', ScheduleController::class)
            ->only(['index', 'store', 'show', 'update', 'destroy']);

        // Activity Logs (read-only)
        Route::get('activity-logs', [ActivityLogController::class, 'index'])
            ->middleware('permission:view activity logs');
    });
});

