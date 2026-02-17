<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'site_id',
        'number',
        'subject',
        'description',
        'status',
        'priority',
        'type',
        'requester_id',
        'assignee_id',
        'sla_due_at',
        'resolved_at',
        'closed_at',
        'channel',
        'is_customer_visible',
        'metadata',
    ];

    protected $casts = [
        'sla_due_at' => 'datetime',
        'resolved_at' => 'datetime',
        'closed_at' => 'datetime',
        'is_customer_visible' => 'boolean',
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

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
}

