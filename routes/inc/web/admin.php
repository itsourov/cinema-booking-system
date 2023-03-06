<?php




use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShowController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');

    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');


    Route::prefix('movies')->group(function () {
        Route::get('/', [MovieController::class, 'index'])->name('admin.movies');
        Route::get('/create', [MovieController::class, 'create'])->name('admin.movies.create');
        Route::post('/create', [MovieController::class, 'store']);

        Route::get('/genres', [GenreController::class, 'index'])->name('admin.movies.genres');
        Route::post('/genres', [GenreController::class, 'store']);

        Route::get('/{movie}', [MovieController::class, 'edit'])->name('admin.movies.edit');
        Route::put('/{movie}', [MovieController::class, 'update'])->name('admin.movies.update');
        Route::delete('/{movie}', [MovieController::class, 'destroy'])->name('admin.movies.delete');
    });
    Route::prefix('shows')->group(function () {
        Route::get('/', [ShowController::class, 'index'])->name('admin.shows');
        Route::get('/{show}', [ShowController::class, 'edit'])->name('admin.shows.edit');
        Route::put('/{show}', [ShowController::class, 'update'])->name('admin.shows.update');
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
