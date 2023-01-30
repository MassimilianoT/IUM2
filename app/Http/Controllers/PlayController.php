<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Play;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlayController extends Controller
{
    public function index(User $user) {
        return view('user.plays.index', [
            'plays' => $this->getValidPlays($user),
        ]);
    }

    public function create() {
        return view('user.plays.create',[
            'boardgames' => Boardgame::all(),
            'users' => User::where('username', '!=', 'admin')->get()
        ]);
    }

    public function store() {

        $attributes = request()->validate([
            'date' => ['required', 'date'],
            'boardgame_id' => ['required', Rule::exists('boardgames', 'id')],
            'players_id' => ['required', Rule::exists('users', 'id')],
            'winner_id' => ['required', Rule::exists('users', 'id')]
        ]);

        $play = new Play();

        $play->winner_id = request()->winner_id;
        $play->date = request()->date;
        $play->boardgame_id = request()->boardgame_id;

        $play->save();

        $play->players()->attach(request()->players_id);

        return redirect('/user/'.auth()->id().'/plays')->with('success', 'Partita aggiunta! Aspetta che un amministratore la convalidi!');
    }

    public function destroy(Play $play) {
        $play->delete();

        return back()->with('success', 'Partita Eliminata!');
    }

    public function indexWinned(User $user) {
        return view('user.plays.winned', [
            'plays' => $this->getValidPlaysWinned($user),
        ]);
    }

    protected function getValidPlays(User $user){
        return $user->games->filter(function ($item) {
            return $item->valid == 1;
        });
    }

    protected function getValidPlaysWinned(User $user){
        return $user->winned->filter(function ($item) {
            return $item->valid == 1;
        });
    }
}
