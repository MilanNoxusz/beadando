<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SzallodaController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminTavaszController;
use App\Http\Middleware\AdminMiddleware;



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

require __DIR__.'/auth.php';


Route::get('/messages', [MessageController::class, 'index'])->name('messages');
Route::post('/messages', [MessageController::class, 'store'])->middleware('auth')->name('messages.store');

Route::get('/ajanlatok', [SzallodaController::class, 'index'])->name('szallodak.index');
Route::get('/ajanlatok/{az}', [SzallodaController::class, 'show'])->name('szallodak.show');
Route::get('/diagram/data', [SzallodaController::class, 'diagramData'])->name('szallodak.diagram.data');
Route::get('/diagram/tavasz-data', [SzallodaController::class, 'diagramTavaszData'])->name('szallodak.diagram.tavasz');
Route::get('/diagram', [SzallodaController::class, 'diagramPage'])->name('szallodak.diagram');



Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    

    Route::get('/admin', [AdminTavaszController::class, 'index'])->name('admin');
    

    Route::get('/admin/create', [AdminTavaszController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminTavaszController::class, 'store'])->name('admin.store');

    Route::get('/admin/{id}/edit', [AdminTavaszController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminTavaszController::class, 'update'])->name('admin.update');
    

    Route::delete('/admin/{id}', [AdminTavaszController::class, 'destroy'])->name('admin.destroy');
});