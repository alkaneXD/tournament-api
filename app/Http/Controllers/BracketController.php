<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TournamentGenerator\Constants;
use TournamentGenerator\Tournament;
use TournamentGenerator\Preset\SingleElimination;
use TournamentGenerator\Export\Hierarchy\Exporter;

class BracketController extends Controller
{
    public function view()
    {
        $tournament = new Tournament('Tournament name');

        // Set tournament lengths - could be omitted
        $tournament
            ->setPlay(7) // SET GAME TIME TO 7 MINUTES
            ->setGameWait(2) // SET TIME BETWEEN GAMES TO 2 MINUTES
            ->setRoundWait(0); // SET TIME BETWEEN ROUNDS TO 0 MINUTES

        // Create a round and a final round
        $round = $tournament->round("First's round's name");
        $final = $tournament->round("Final's round's name");

        // Create 2 groups for the first round
        $group_1 = $round->group('Round 1')
            ->setInGame(2) // 2 TEAMS PLAYING AGAINST EACH OTHER
            ->setType(Constants::ROUND_ROBIN); // ROBIN-ROBIN GROUP
        $group_2 = $round->group('Round 2')
            ->setInGame(2) // 2 TEAMS PLAYING AGAINST EACH OTHER
            ->setType(Constants::ROUND_ROBIN); // ROBIN-ROBIN GROUP

        // Create a final group
        $final_group = $final->group('Finale')
            ->setInGame(2) // 2 TEAMS PLAYING AGAINST EACH OTHER
            ->setType(Constants::ROUND_ROBIN); // ROBIN-ROBIN GROUP

        // CREATE 6 TEAMS
        for ($i=1; $i <= 6; $i++) {
            $tournament->team('Team '.$i);
        }

        // SET PROGRESSIONS FROM GROUP 1 AND 2 TO FINAL GROUP
        $group_1->progression($final_group, 0, 2); // PROGRESS 2 BEST WINNING TEAMS
        $group_2->progression($final_group, 0, 2); // PROGRESS 2 BEST WINNING TEAMS

        // Generate games in the first round
        $round->genGames();
        // Simulate results (or you can fill it with your own real results)
        $round->simulate();
        // Progress best teams from first round to final round
        $round->progress();
        // Generate games in the final round
        $final->genGames();
        // Simulate results (or you can fill it with your own real results)
        $final->simulate();

        // GET ALL TEAMS
        $teams = $tournament->getTeams(true); // TRUE to get teams ordered by their results

        $export = Exporter::start($final)->getJson();
        $export = $final->export()->getJson();
        print_r($export);

    }
}
