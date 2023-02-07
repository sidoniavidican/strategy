<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Models\Team;
use App\Services\PlayersService;
use Illuminate\Console\Command;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:teams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import players into teams from json';

    /**
     * @return void
     */
    public function handle()
    {
        $path = storage_path()."/app/public/players.json";
        $content = file_get_contents($path);
        $teams = PlayersService::setTeams(json_decode($content ? $content : '', true));

        foreach ($teams as $key => $players) {
            $team = Team::create(['name' => $key]);
            foreach ($players as $player) {
                Player::create([
                    'team_id' => $team->id,
                    'name'    => $player['name'],
                    'score'   => $player['score'],
                ]);
            }
        }
    }
}
