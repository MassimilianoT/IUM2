<?php

    use App\Http\Controllers\AdminAuthorController;
    use App\Http\Controllers\AdminBoardgameController;
    use App\Http\Controllers\AdminCategoryController;
    use App\Http\Controllers\AdminPlayController;
    use App\Http\Controllers\AdminUserController;
    use App\Http\Controllers\AjaxController;
    use App\Http\Controllers\BoardgameController;
    use App\Http\Controllers\PlayController;
    use App\Http\Controllers\RegisterController;
    use App\Http\Controllers\SessionController;
    use App\Http\Controllers\VoteController;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', [BoardgameController::class, 'index'])->name('home');
    Route::get('boardgames/{boardgame}', [BoardgameController::class, 'show']);

    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisterController::class, 'create']);
        Route::post('register', [RegisterController::class, 'store']);
        Route::get('login', [SessionController::class, 'create']);
    });

    Route::post('login', [SessionController::class, 'store']);

    Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

    Route::middleware('can:admin')->group(function () {
        Route::resource('admin/boardgames', AdminBoardgameController::class)->except('show');
        Route::resource('admin/authors', AdminAuthorController::class)->except('show');
        Route::resource('admin/categories', AdminCategoryController::class)->except('show');
        Route::post('admin/categories/inline', [AdminCategoryController::class, 'createInline']);
        Route::post('admin/authors/inline', [AdminAuthorController::class, 'createInline']);
        Route::get('admin/users', [AdminUserController::class, 'index']);
        Route::get('admin/users/{user}/edit/activate', [AdminUserController::class, 'activate']);
        Route::get('admin/users/{user}/edit/deactivate', [AdminUserController::class, 'deactivate']);
        Route::get('admin/users/{user}/edit/admin_activate', [AdminUserController::class, 'admin_activate']);
        Route::get('admin/users/{user}/edit/admin_deactivate', [AdminUserController::class, 'admin_deactivate']);
        Route::get('admin/users/{user}/reset_password', [AdminUserController::class, 'passwordReset']);
        Route::delete('admin/users/{user}', [AdminUserController::class, 'destroy']);
        Route::get('admin/plays', [AdminPlayController::class, 'index']);
        Route::delete('admin/plays/{play}', [AdminPlayController::class, 'destroy']);
        Route::get('admin/plays/{play}/edit', [AdminPlayController::class, 'edit']);
        Route::patch('admin/plays/{play}', [AdminPlayController::class, 'update']);
        Route::get('admin/plays/{play}/edit/validate', [AdminPlayController::class, 'validatePlay']);
        Route::get('admin/plays/{play}/edit/invalidate', [AdminPlayController::class, 'invalidatePlay']);
        Route::delete('plays/{play}', [AdminPlayController::class, 'destroy']);
    });

    Route::middleware('can:notAdmin')->group(function () {
        Route::get('user/{user}/plays', [PlayController::class, 'index']);
        Route::get('user/{user}/votes', [VoteController::class, 'index']);
        Route::post('user/{user}/votes/{boardgame}', [VoteController::class, 'store']);
        Route::get('user/{user}/plays/winned', [PlayController::class, 'indexWinned']);
        Route::get('plays/create', [PlayController::class, 'create']);
        Route::post('plays', [PlayController::class, 'store']);
        Route::post('boardgames/random', [BoardgameController::class, 'random']);
    });