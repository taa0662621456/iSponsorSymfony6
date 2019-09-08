<?php
declare(strict_types=1);

namespace App\Fixture;

class Scores
{
    public static function random()
    {
        $teams = array("Arsenal", "Aston Villa", "Cardiff", "Chelsea", "Crystal Palace", "Everton", "Fulham", "Hull", "Liverpool", "Man City", "Man Utd", "Newcastle", "Norwich", "Southampton", "Stoke", "Sunderland", "Swansea", "Tottenham", "West Brom", "West Ham");

        shuffle($teams);

        for ($i = 0, $iMax = count($teams); $i <= $iMax; $i++) {
            $id = uniqid('', true);
            $games[$id] = array(
                'id' => $id,
                'home' => array(
                    'team' => array_pop($teams),
                    'score' => 0,
                ),
                'away' => array(
                    'team' => array_pop($teams),
                    'score' => 0,
                ),
            );
        }

        return $games;
    }
}