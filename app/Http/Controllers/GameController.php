<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\View as ContractView;

class GameController extends Controller
{
    /**
     * @return ContractView
     */
    public function index(): ContractView
    {
        $games = Game::all();

        return View::make('games.index')->with(compact('games'));
    }
}
