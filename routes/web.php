<?php

use Illuminate\Support\Facades\Route;
use App\Models\Agent;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    $agent = Agent::create([
        'name' => 'ChatGPT',
        'description' => 'Chatbot',
        'type' => 'chatbot',
        'is_active' => true,
    ]);
});

Route::get('/agents', function () {
    $agents = Agent::all();

    $output = "<h1>All agents:</h1>";
    foreach ($agents as $agent) {
        $output .= " ID: " . $agent->id . " Name: " . $agent->name . " Description: " . $agent->description . " Type: " . $agent->type . " Is Active:    " . $agent->is_active . "<br>";
    }
    return $output;
});

Route::get('/agents/{id}', function ($id) {
    $agent = Agent::find($id);
    if (!$agent) {
        return "Agent not found";
    }
    return "Agent found: " . $agent->name;
});
