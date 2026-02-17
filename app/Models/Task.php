<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'site_id',
        'title',
        'description',
        'status',
        'priority',
        'assignee_id',
        'reporter_id',
        'scheduled_start_at',
        'scheduled_end_at',
        'started_at',
        'completed_at',
        'estimated_minutes',
        'actual_minutes',
        'parent_task_id',
        'tags',
        'metadata',
    ];

    protected $casts = [
        'scheduled_start_at' => 'datetime',
        'scheduled_end_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'estimated_minutes' => 'integer',
        'actual_minutes' => 'integer',
        'tags' => 'array',
        'metadata' => 'array',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function parent()
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    public function children()
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }

    public function dependencies()
    {
        return $this->hasMany(TaskDependency::class);
    }

    public function dependents()
    {
        return $this->hasMany(TaskDependency::class, 'depends_on_task_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}

