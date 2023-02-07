<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\View as ContractView;

class PlayerController extends Controller
{
    /**
     * @return ContractView
     */
    public function index(): ContractView
    {
        $teams = Team::all();

        return View::make('teams.index')->with(compact('teams'));
    }

    /**
     * @param int $id
     *
     * @return ContractView
     */
    public function api(int $id): ContractView
    {
        $players = Cache::remember('teams:' . $id, 1600, function () use ($id) {
            try {
                $response = Http::withHeaders([
                    'X-Auth-Token' => config('services.football.auth_token'),
                ])->get(config('services.football.url') . $id);

                return json_decode($response->body(), true)['squad'];
            } catch (Exception $e) {
                return [];
            }
        });

        return View::make('teams.api')->with(compact('players'));
    }

    /**
     * @param Player $playerA
     * @param Player $playerB
     *
     * @return void
     */
    public function switch(Player $playerA, Player $playerB)
    {
        $playerATeam = $playerA->team_id;
        $playerBTeam = $playerB->team_id;

        $playerA->team_id = $playerBTeam;
        $playerA->save();

        $playerB->team_id = $playerATeam;
        $playerB->save();
    }
}
