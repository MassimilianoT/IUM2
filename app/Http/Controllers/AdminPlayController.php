<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Play;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPlayController extends Controller
{
    public function index() {
        return view('admin.plays.index', [
            'plays' => Play::paginate(50)
        ]);
    }

    public function validatePlay(Play $play) {
        $play->valid = true;

        $play->save();

        return back()->with('success', 'Partita validata!');
    }

    public function invalidatePlay(Play $play) {
        $play->valid = false;

        $play->save();

        return back()->with('success', 'Partita invalidata!');
    }

    public function destroy(Play $play) {
        $play->delete();

        return back()->with('success', 'Partita Eliminata!');
    }

    public function edit(Play $play) {
        return view('admin.plays.edit', [
            'play' => $play,
            'boardgames' => Boardgame::all(),
            'users' => User::all()
        ]);
    }

    public function update(Play $play) {
        $attributes = request()->validate([
            'date' => ['required', 'date'],
            'boardgame_id' => ['required', Rule::exists('boardgames', 'id')],
            'players_id' => ['required', Rule::exists('users', 'id')],
            'winner_id' => ['required', Rule::exists('users', 'id')]
        ]);

        unset($attributes['players_id']);

        $play->update($attributes);

        if(request()->players_id != null)
            $play->players()->sync(request()->players_id);

        return redirect('/admin/plays')->with('success', 'Partita Aggiornata!');
    }
}
