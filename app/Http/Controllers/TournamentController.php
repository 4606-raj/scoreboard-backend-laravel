<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Tournament, Team};

class TournamentController extends Controller
{
    public function index() {
        return Tournament::with('teams')->get();
    }
    public function show($id) {
        return Tournament::with('teams')->findOrFail($id);
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'firstTeamName' => 'required|string|max:255',
            'secondTeamName' => 'required|string|max:255',
            'firstTeamColor' => 'required|string|max:7',
            'secondTeamColor' => 'required|string|max:7',
        ]);

        $teamsData = $request->only(['firstTeamName', 'secondTeamName', 'firstTeamColor', 'secondTeamColor', 'firstTeamScore', 'secondTeamScore']);
        
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('logos', 'public');
        }
        $tournament = Tournament::create([
            'name' => $request->name,
            'logo' => $logo ?? null,
        ]);
        
        $tournament->teams()->createMany([
            ['name' => $teamsData['firstTeamName'], 'color' => $teamsData['firstTeamColor']],
            ['name' => $teamsData['secondTeamName'], 'color' => $teamsData['secondTeamColor']],
        ]);
        
        return response()->json($tournament, 201);
    }

    public function update(Request $request, $id) {

        $tournament = Tournament::findOrFail($id);

        foreach ($tournament->teams as $index => $team) {
            $team->update([
                'score' => $request->input('teams')[$index]['score'],
                'warning' => $request->input('teams')[$index]['warning'],
            ]);
        }

        return response()->json($tournament);
    }
}
