<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Task $task)
    {
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('tasks.' . $this->task->id);
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->task->id,
            'status' => $this->task->status,
            'assignee_id' => $this->task->assignee_id,
        ];
    }
}

