<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function index(User $user) {
        $votables = DB::table('play_user')
            ->join('plays', function($join) use ($user) {
                $join->on('plays.id', '=', 'play_user.play_id')
                     ->where('play_user.user_id', '=', $user->id);
            })
            ->join('boardgames', 'boardgames.id', '=', 'plays.boardgame_id')
            ->whereNotIn('boardgames.id', function($query) use ($user) {
                $query->select('boardgame_id')->from('votes')->where('user_id', '=', $user->id);
            })
            ->select('boardgames.*')
            ->get();

        return view('user.votes.index', [
            'votables' => $votables,
            'user' => $user
        ]);
    }

    public function store(User $user, Boardgame $boardgame) {

        request()->validate([
            'vote' => ['required', 'min:1', 'max:10'],
        ]);

        $vote = new Vote();

        $vote->vote = request()->vote;
        $vote->boardgame_id = $boardgame->id;
        $vote->user_id = $user->id;

        $vote->save();

        return redirect('/user/'.auth()->id().'/votes')->with('success', 'Voto registrato per il gioco '.$boardgame->name);
    }
}
