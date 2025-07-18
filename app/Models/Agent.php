<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ //Excludes important fields from mass assignment, like id
        'name',
        'description',
        'type',
        'is_active',
    ];

    protected $casts = [ // Get the attributes that should be cast
        'is_active' => 'boolean',
    ];

    //Agent has many tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function activeTasks()
    {
        return $this->hasMany(Task::class)->where('status', 'active');
    }

    public function completedTasks()
    {
        return $this->hasMany(Task::class)->where('status', 'completed');
    }
    public function getIsActiveAttribute($value)
    {
        return $value ? 'Active' : 'Inactive';
    }
}
