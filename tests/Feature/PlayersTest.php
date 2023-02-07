<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PlayersTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return void
     */
    public function testSwitch()
    {
        $this->withoutExceptionHandling();

        $playersA = Player::where('team_id', 1)->pluck('id');
        $playersB = Player::where('team_id', 2)->pluck('id');

        self::assertEquals([1, 2, 3, 4, 5], $playersA->toArray());
        self::assertEquals([6, 7, 8, 9, 10], $playersB->toArray());

        $this->patch('/players/switch/1/6');

        $playersA = Player::where('team_id', 1)->pluck('id');
        $playersB = Player::where('team_id', 2)->pluck('id');

        self::assertEquals([2, 3, 4, 5, 6], $playersA->toArray());
        self::assertEquals([1, 7, 8, 9, 10], $playersB->toArray());
    }
}
