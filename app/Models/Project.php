<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'name',
        'code',
        'description',
        'status',
        'priority',
        'start_date',
        'due_date',
        'completed_at',
        'manager_id',
        'metadata',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
        'completed_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}

