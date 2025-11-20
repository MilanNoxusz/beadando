<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SzallodaController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', function ($request, $next) {
    if (auth()->id() !== 5) {
        abort(403, 'Nincs jogosultságod megtekinteni ezt az oldalt.');
    }
    return $next($request);
}])->name('admin');

require __DIR__.'/auth.php';

use App\Http\Controllers\MessageController;


Route::get('/messages', [MessageController::class, 'index'])->name('messages');
Route::post('/messages', [MessageController::class, 'store'])->middleware('auth')->name('messages.store');

Route::get('/admin', function () {
    return view('admin');
})->middleware('auth')->name('admin');

// Ajánlatok (szállodák) list and detail
Route::get('/ajanlatok', [SzallodaController::class, 'index'])->name('szallodak.index');
Route::get('/ajanlatok/{az}', [SzallodaController::class, 'show'])->name('szallodak.show');
Route::get('/diagram/data', [SzallodaController::class, 'diagramData'])->name('szallodak.diagram.data');
Route::get('/diagram/tavasz-data', [SzallodaController::class, 'diagramTavaszData'])->name('szallodak.diagram.tavasz');
Route::get('/diagram', [SzallodaController::class, 'diagramPage'])->name('szallodak.diagram');
