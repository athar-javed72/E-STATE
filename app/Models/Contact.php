<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'type',
        'status',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
