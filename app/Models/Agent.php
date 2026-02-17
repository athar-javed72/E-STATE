<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'designation',
        'avatar',
        'bio',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'experience',
        'rating',
        'is_online',
        'status',
    ];

    protected $casts = [
        'is_online' => 'boolean',
        'rating' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($agent) {
            if (empty($agent->slug)) {
                $agent->slug = Str::slug($agent->name);
            }
        });
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function getPropertiesCountAttribute(): int
    {
        return $this->properties()->where('status', 'active')->count();
    }
}
