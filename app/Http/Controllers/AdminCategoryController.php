<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCategoryController extends Controller
{
    public function index() {
        return view('admin.categories.index', [
            'categories' => Category::orderBy('name')->paginate(50)
        ]);
    }

    public function create() {
        return view('admin.categories.create', [
            'boardgames' => Boardgame::orderBy('name')->get()
        ]);
    }

    public function createInline() {
        $attributes = $this->validateCategory();

        $category = Category::create($attributes);

        $response = array(
            'status' => 'success',
            'id' => $category->id,
            'name' => $category->name
        );

        return response()->json($response);
    }

    public function store() {
        $attributes = $this->validateCategory();

        unset($attributes['boardgames_id']);

        $category = Category::create($attributes);

        if(request()->boardgames_id != null)
            $category->boardgames()->attach(request()->boardgames_id);

        return redirect('/admin/categories')->with('success', 'Categoria aggiunta!');
    }

    public function edit(Category $category) {
        return view('admin.categories.edit', [
            'category' => $category,
            'boardgames' => Boardgame::orderBy('name')->get()
        ]);
    }

    public function update(Category $category) {
        $attributes = $this->validateCategory($category);

        unset($attributes['boardgames_id']);

        $category->update($attributes);

        if(request()->boardgames_id != null)
            $category->boardgames()->sync(request()->boardgames_id);

        return redirect('/admin/categories')->with('success', 'Categoria Aggiornata!');
    }

    public function destroy(Category $category) {
        $category->delete();

        return back()->with('success', 'Categoria Eliminata!');
    }

    protected function validateCategory(?Category $category = null): array {

        $category ??= new Category();

        if(isset(request()->categoryName))
            request()->merge(['name' => request()->categoryName]);

        return request()->validate([
            'name' => 'required',
            'slug' => ['required', Rule::unique('categories', 'slug')->ignore($category)],
        ]);
    }
}
