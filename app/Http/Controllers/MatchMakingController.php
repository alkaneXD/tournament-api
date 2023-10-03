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

    public function setNextFight()
    {
        $matchesData = Fight::get();
        $loopIndex = 0;

        for ($i = 0; $i < count($matchesData); $i += 2) {
            $match1 = $matchesData[$i];
            $match2 = isset($matchesData[$i + 1]) ? $matchesData[$i + 1] : null;
            
            $nextFight = Fight::whereNull(['player_one_id', 'player_two_id'])->skip($loopIndex)->orderBy('id', 'asc')->first();
            
            if($match1) {
                $match1->next_fight_id = $nextFight->id ?? null;
                $match1->save();
            }
            if($match2) {
                $match2->next_fight_id = $nextFight->id ?? null;
                $match2->save();
            }

            $loopIndex++;
        }


        return response()->json($matchesData);
    }
}
