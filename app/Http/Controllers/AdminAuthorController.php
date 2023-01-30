<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Boardgame;
use Illuminate\Http\Request;

class AdminAuthorController extends Controller
{
    public function index() {
        return view('admin.authors.index', [
            'authors' => Author::paginate(50)
        ]);
    }

    public function create() {
        return view('admin.authors.create', [
            'boardgames' => Boardgame::all(),
        ]);
    }

    public function store() {
        $attributes = $this->validateAuthor();

        unset($attributes['boardgames_id']);

        $author = Author::create($attributes);

        if(request()->boardgames_id != null)
            $author->boardgames()->attach(request()->boardgames_id);

        return redirect('/admin/authors')->with('success', 'Autore aggiunto!');
    }

    public function createInline() {
        $attributes = $this->validateAuthor();

        $author = Author::create($attributes);

        $response = array(
            'status' => 'success',
            'id' => $author->id,
            'firstName' => $author->firstName,
            'lastName' => $author->lastName
        );

        return response()->json($response);
    }

    public function edit(Author $author) {
        return view('admin.authors.edit', [
            'author' => $author,
            'boardgames' => Boardgame::all()
        ]);
    }

    public function update(Author $author) {
        $attributes = $this->validateAuthor($author);

        unset($attributes['boardgames_id']);

        $author->update($attributes);

        if(request()->boardgames_id != null)
            $author->boardgames()->sync(request()->boardgames_id);

        return redirect('/admin/authors')->with('success', 'Autore Aggiornato!');
    }

    public function destroy(Author $author) {
        $author->delete();

        return back()->with('success', 'Autore Eliminato!');
    }

    protected function validateAuthor(?Author $author = null): array {

        $author ??= new Author();

        return request()->validate([
            'firstName' => 'required',
            'lastName' => 'required',
        ]);
}
}
