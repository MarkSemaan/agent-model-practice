<?php

use Illuminate\Support\Facades\Route;
use App\Models\Agent;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});

//  For time and testing purposes I did not make controllers, sorry Charbel 

Route::get('/create', function () {
    $faker = Faker::create();

    $agent = Agent::create([
        'name' => $faker->name,
        'description' => $faker->text,
        'type' => $faker->randomElement(['chatbot', 'agent', 'assistant']),
        'is_active' => $faker->boolean,
    ]);
    Log::info("Agent created: " . $agent->id . "" . $agent->name);
    return "Agent created: " . $agent->id . "" . $agent->name;
});

// Create or update an agent

Route::get('/agents/update-or-create/{id}', function ($id) {
    $agent = Agent::updateOrCreate(
        ['id' => $id],
        ['name' => 'Updated Agent']
    );

    return "Agent: " . $agent->name;
});

// Get all agents

Route::get('/agents', function () {
    $agents = Agent::all();

    $output = "<h1>All agents:</h1>";
    foreach ($agents as $agent) {
        $output .= " ID: " . $agent->id . " Name: " . $agent->name . " Description: " . $agent->description . " Type: " . $agent->type . " Is Active:    " . $agent->is_active . "<br>";
    }
    return $output;
});

//Get active agents

Route::get("/agents/active", function () {
    $agents = Agent::where('is_active', true)->get();
    return "Found " . $agents->count() . " active agents";
});

//Order agents by id

Route::get("/agents/ordered", function () {
    $agent = Agent::orderBy("id", "desc")->get();
    $output = "<h2> Agents Ordered by ID</h2>";
    foreach ($agent as $agent) {
        $output .= " ID: " . $agent->id . " Name: " . $agent->name;
    }
    return $output;
});

//Get agent by id

Route::get('/agents/{agent}', function (Agent $agent) {
    return "Agent found: " . $agent->name;
});

//Deletes and agent, soft delete enable

Route::get("/agents/delete/{id}", function (int $id) {
    $agent = Agent::find($id);
    if (! $agent) {
        return "Not found";
    }
    $agent->delete();
    Log::warning("Agent deleted: " . $agent->id . "" . $agent->name);
    return "Deleted" . $agent->id . "" . $agent->name;
});

Route::get("/agents/restore/{id}", function (int $id) {
    $agent = Agent::withTrashed()->find($id);
    if ($agent->trashed()) {
        $agent->restore();
        return "Restored" . $agent->id . "" . $agent->name;
    }
    return "Not found";
});
