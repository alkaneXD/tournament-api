<?php

namespace App\Http\Controllers;

use App\Models\Fight;
use App\Models\Tournament;
use Illuminate\Http\Request;
use App\Services\MatchMakingService;

class MatchMakingController extends Controller
{
    public function generateMatches(Request $request)
    {
        $players = $request->input('players');
        $mode = $request->input('mode');
        $tournamentName = $request->input('tournament_name');
        
        $matches = MatchMakingService::generateMatches($players, $mode, $tournamentName);

        return response()->json($matches, 200);
    }

    public function getMatches()
    {
        $tournament_id = request('id');
        $matches = Tournament::where('id', $tournament_id)->with(['groups.rounds.fights'])->get();

        return response()->json($matches, 200);
    }
}
