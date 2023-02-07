<?php

namespace App\Services;

class PlayersService
{
    /**
     * @param array $players
     *
     * @return array
     */
    public static function setTeams(array $players): array
    {
        $players = array_values(collect($players)->sortBy('score')->toArray());
        $teams = [];
        $key = 0;
        $round = 0;
        while (isset($players[$key + 1])) {
            $teams[$round % 2 ? 'B' : 'A'][] = $players[$key];
            $teams[$round % 2 ? 'A' : 'B'][] = $players[$key + 1];
            $key += 2;
            $round++;
        }

        return $teams;
    }
}
