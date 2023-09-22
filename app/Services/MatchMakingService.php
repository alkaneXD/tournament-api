<?php

namespace App\Services;

use App\Models\Tournament;
use App\Models\Stage;
use App\Models\Participant;
use App\Models\Group;
use App\Models\Round;
use App\Models\Fight;

/**
 * Class MatchMakingService
 * @package App\Services
 */
class MatchMakingService
{
    public static function generateMatches($players, $mode, $tournamentName)
    {
        $tournament = Tournament::create(['name' => $tournamentName]);

        if ($mode == 'single_elimination') {
            return self::generateSingleEliminationMatches($players, $tournament);
        } elseif ($mode == 'double_elimination') {
            return self::generateDoubleEliminationMatches($players, $tournament);
        }
    }


    private static function generateSingleEliminationMatches($players, $tournament)
    {
        $tournamentId = $tournament->id;
        
        $stage = Stage::create([
            'tournament_id' => $tournamentId,
            'name' => 'Single Elimination Stage',
            'type' => 'single_elimination',
        ]);
    
        $group = Group::create([
            'stage_id' => $stage->id,
            'number' => 1,
        ]);
        
        $participantIds = [];
        foreach ($players as $player) {
            $participant = Participant::create([
                'tournament_id' => $tournamentId,
                'name' => $player['name'],
            ]);
    
            $participantIds[] = $participant->id;
        }
        
        $participantsCount = count($participantIds);
        $firstRoundMatchesCount = $participantsCount / 2;
        $numRounds = log($participantsCount, 2);
    
        if ($participantsCount > 1) {

            $matchesCount = $participantsCount;
            $matchNumber = 1;

            for ($roundNumber = 1; $roundNumber <= $numRounds; $roundNumber++) {
                $matchesCount /= 2;
                $matchesPerRound[$roundNumber] = $matchesCount;
            
                $round = Round::create([
                    'stage_id' => $stage->id,
                    'group_id' => $group->id,
                    'number' => $roundNumber,
                    'matches_count' => $matchesCount,
                ]);
            
                for ($i = 0; $i < $matchesCount; $i++) {
                    $match = Fight::create([
                        'stage_id' => $stage->id,
                        'round_id' => $round->id,
                        'group_id' => $group->id,
                        'opponent1_id' => ($matchNumber <= $firstRoundMatchesCount ? $participantIds[$matchNumber - 1] : null),
                        'opponent2_id' => ($matchNumber <= $firstRoundMatchesCount ? $participantIds[$participantsCount - $matchNumber] : null),
                        'bracket_position' => $matchNumber,
                    ]);
            
                    $matchNumber++;
                    $roundMatches[] = $match;
                }
            }

            $matches[] = $roundMatches;
        }
    
        return $matches;
    }
    

    private static function generateDoubleEliminationMatches($players, $tournament)
    {
        $stage = Stage::create([
            'tournament_id' => $tournament->id,
            'name' => 'Double Elimination Stage',
            'type' => 'double_elimination',
        ]);

        // Create winners bracket group
        $winnersGroup = Group::create([
            'stage_id' => $stage->id,
            'number' => 1,
        ]);

        // Create losers bracket group
        $losersGroup = Group::create([
            'stage_id' => $stage->id,
            'number' => 2,
        ]);

        $participants = [];
        foreach ($players as $player) {
            $participants[] = Participant::create([
                'tournament_id' => $tournament->id,
                'name' => $player['name'],
            ]);
        }

        $matches = [];
        $numPlayers = count($participants);

        // Create winners bracket matches and rounds
        $winnersMatches = [];
        for ($roundNumber = 1; $roundNumber <= ceil(log($numPlayers, 2)); $roundNumber++) {
            $round = Round::create([
                'stage_id' => $stage->id,
                'group_id' => $winnersGroup->id,
                'number' => $roundNumber,
            ]);

            $groupSize = pow(2, $roundNumber - 1);

            for ($i = 0; $i < $numPlayers / $groupSize; $i++) {
                $match = Fight::create([
                    'stage_id' => $stage->id,
                    'group_id' => $winnersGroup->id,
                    'round_id' => $round->id,
                    'opponent1_id' => $participants[$i]->id,
                    'opponent1_position' => $i + 1,
                    'opponent2_id' => $participants[$numPlayers - $i - 1]->id,
                    'opponent2_position' => $numPlayers - $i,
                ]);

                $winnersMatches[] = $match;
            }
        }
        $matches['winners'] = $winnersMatches;

        // Create losers bracket matches and rounds
        $losersMatches = [];
        for ($roundNumber = 1; $roundNumber <= ceil(log($numPlayers, 2)) - 1; $roundNumber++) {
            $round = Round::create([
                'stage_id' => $stage->id,
                'group_id' => $losersGroup->id,
                'number' => $roundNumber,
            ]);

            $groupSize = pow(2, $roundNumber - 1);

            for ($i = 0; $i < $numPlayers / $groupSize; $i++) {
                $match = Fight::create([
                    'stage_id' => $stage->id,
                    'group_id' => $losersGroup->id,
                    'round_id' => $round->id,
                    'opponent1_id' => null,
                    'opponent1_position' => $i + 1,
                    'opponent2_id' => null,
                    'opponent2_position' => $numPlayers - $i,
                ]);

                $losersMatches[] = $match;
            }
        }
        $matches['losers'] = $losersMatches;

        return $matches;
    }

}
