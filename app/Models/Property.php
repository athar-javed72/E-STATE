<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'title',
        'slug',
        'description',
        'address',
        'city',
        'state',
        'zip',
        'type',
        'listing_type',
        'price',
        'bedrooms',
        'bathrooms',
        'area',
        'parking',
        'featured_image',
        'gallery',
        'featured',
        'views',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean',
        'gallery' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->title);
            }
        });
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
