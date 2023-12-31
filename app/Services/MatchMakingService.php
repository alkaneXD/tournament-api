<?php

namespace App\Services;

use App\Models\Fight;
use App\Models\Group;
use App\Models\Round;
use App\Models\Player;
use App\Models\Tournament;

/**
 * Class MatchMakingService
 * @package App\Services
 */
class MatchMakingService
{
    public static function generateMatches($players, $mode, $tournamentName)
    {
        $tournament = Tournament::create(['name' => $tournamentName, 'type' => $mode]);

        if ($mode == 'single_elimination') {
            return self::generateSingleEliminationMatches($players, $tournament);
        } elseif ($mode == 'double_elimination') {
            return self::generateDoubleEliminationMatches($players, $tournament);
        }
    }


    private static function generateSingleEliminationMatches($players, $tournament)
    {
        $tournamentId = $tournament->id;

        $group = Group::create([
            'tournament_id' => $tournamentId,
            'name' => 'upper_bracket',
        ]);
        
        $playerIds = [];
        foreach ($players as $player) {
            $player = Player::create([
                'name' => $player['name'],
            ]);
    
            $playerIds[] = $player->id;
        }
        
        $playersCount = count($playerIds);
        $firstRoundMatchesCount = $playersCount / 2;
        $numRounds = log($playersCount, 2);
    
        if ($playersCount > 1) {

            $matchesCount = $playersCount;
            $matchNumber = 1;
            $fightIds = [];
            for ($roundNumber = 1; $roundNumber <= $numRounds; $roundNumber++) {
                $matchesCount /= 2;
                $matchesPerRound[$roundNumber] = $matchesCount;
            
                $round = Round::create([
                    'group_id' => $group->id,
                    'number' => $roundNumber,
                    'matches_count' => $matchesCount,
                ]);
                
                for ($i = 0; $i < $matchesCount; $i++) {
                    $match = Fight::create([
                        'round_id' => $round->id,
                        'player_one_id' => ($matchNumber <= $firstRoundMatchesCount ? $playerIds[$matchNumber - 1] : null),
                        'player_two_id' => ($matchNumber <= $firstRoundMatchesCount ? $playerIds[$playersCount - $matchNumber] : null),
                        'bracket_position' => $matchNumber,
                    ]);
            
                    $matchNumber++;
                    $fightIds[] = $match->id;
                    $roundMatches[] = $match;
                }

                
            }
            
            $createdMatches = Fight::whereIn('id', $fightIds)->orderBy('id', 'asc')->get();

            $loopIndex = 0;
            for ($i = 0; $i < count($createdMatches); $i += 2) {
                $match_one = $createdMatches[$i];
                $match_two = isset($createdMatches[$i + 1]) ? $createdMatches[$i + 1] : null;
                
                $nextFight = Fight::whereIn('id', $fightIds)->whereNull(['player_one_id', 'player_two_id'])->skip($loopIndex)->orderBy('id', 'asc')->first();
                
                if($match_one) {
                    $match_one->next_fight_id = $nextFight->id ?? null;
                    $match_one->save();
                }
                if($match_two) {
                    $match_two->next_fight_id = $nextFight->id ?? null;
                    $match_two->save();
                }

                $loopIndex++;
            }
        }
    
        return $createdMatches;
    }

    private static function generateDoubleEliminationMatches($players, $tournament)
    {
        //
    }

}
