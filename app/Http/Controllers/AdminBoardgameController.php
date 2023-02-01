<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Boardgame;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBoardgameController extends Controller
{
    public function index() {
        return view('admin.boardgames.index', [
            'boardgames' => Boardgame::orderBy('name')->paginate(50)
        ]);
    }

    public function create() {
        return view('admin.boardgames.create', [
            'authors' => Author::orderBy('lastName')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store() {
        $attributes = array_merge($this->validateBoardgame(), [
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);

        unset($attributes['categories_id']);
        unset($attributes['authors_id']);

        $boardgame = Boardgame::create($attributes);

        $boardgame->authors()->attach(request()->authors_id);

        $boardgame->categories()->attach(request()->categories_id);

        return redirect('/admin/boardgames')->with('success', 'Gioco aggiunto!');
    }

    public function edit(Boardgame $boardgame) {
        return view('admin.boardgames.edit', [
            'boardgame' => $boardgame,
            'authors' => Author::orderBy('lastName')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Boardgame $boardgame) {
        $attributes = $this->validateBoardgame($boardgame);

        unset($attributes['categories_id']);
        unset($attributes['authors_id']);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $boardgame->update($attributes);

        $boardgame->authors()->sync(request()->authors_id);

        $boardgame->categories()->sync(request()->categories_id);

        return redirect('/admin/boardgames')->with('success', 'Gioco Aggiornato!');
    }

    public function destroy(Boardgame $boardgame) {
        $boardgame->delete();

        return back()->with('success', 'Gioco Eliminato!');
    }

    protected function validateBoardgame(?Boardgame $boardgame = null): array {

        $boardgame ??= new Boardgame();

        return request()->validate([
            'name' => 'required',
            'minPlayers' => 'required|integer',
            'maxPlayers' => 'required|integer',
            'editor' => 'required',
            'description' => 'required',
            'thumbnail' => $boardgame->exists ? ['image'] : ['required', 'image'],
            'categories_id' => 'required',
            'authors_id' => 'required',
        ]);
    }

    public function ajax(){
        return request()->name;
    }
}
