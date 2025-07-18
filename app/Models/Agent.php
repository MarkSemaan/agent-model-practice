<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use SoftDeletes;

    protected $fillable = [ //Excludes important fields from mass assignment, like id
        'name',
        'description',
        'type',
        'is_active',
    ];

    protected $casts = [ // Get the attributes that should be cast
        'is_active' => 'boolean',
    ];
}
