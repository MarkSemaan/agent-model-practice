<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'agent_id',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    //Task belong to an agent
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
