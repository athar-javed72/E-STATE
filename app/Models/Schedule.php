<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'site_id',
        'technician_id',
        'starts_at',
        'ends_at',
        'status',
        'title',
        'notes',
        'metadata',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}

