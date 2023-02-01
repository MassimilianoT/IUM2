<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Boardgame;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardgameController extends Controller
{
    public function index(){
        return view('boardgames.index', [
            'boardgames' => Boardgame::orderBy('name')->filter(
                request(['search'])
            )->simplePaginate()->withQueryString(),
        ]);
    }

    public function show(Boardgame $boardgame){
        return view('boardgames.show', [
            'boardgame' => $boardgame
        ]);
    }

    public function random(Request $request){
        $neverPlayedGames = DB::table('boardgames')
            ->whereNotIn('boardgames.id', function($query) use ($request){
                $query->select('boardgame_id')
                    ->from('plays')
                    ->join('play_user', 'plays.id', '=', 'play_user.play_id')
                    ->where('play_user.user_id', '=', request()->user_id)
                    ->where('plays.valid', '=', 1);
            });

        $selectables = $neverPlayedGames;

        if ($request->category_id != -1) {
            $selectables = $selectables
                ->join('boardgame_category', 'boardgames.id', '=', 'boardgame_category.boardgame_id')
                ->where('boardgame_category.category_id', '=', $request->category_id);
        }

        if ($request->author_id != -1) {
            $selectables = $selectables
                ->join('author_boardgame', 'boardgames.id', '=', 'author_boardgame.boardgame_id')
                ->where('author_boardgame.author_id', '=', $request->author_id);
        }

        if ($request->players != null) {
            $selectables = $selectables
                ->where('boardgames.minPlayers', '<=', $request->players)
                ->where('boardgames.maxPlayers', '>=', $request->players);
        }

        $selectables = $selectables->select('boardgames.id')->inRandomOrder()->first();

        if($selectables != null){
            $boardgame = Boardgame::find($selectables->id);

            return view('boardgames.show', [
                'boardgame' => $boardgame
            ]);
        }

        return redirect('/')->with('success', 'Non esistono giochi in collezione che hanno questi parametri e che non hai mai giocato!');
    }
}
