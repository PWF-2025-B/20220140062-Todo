<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/todo', [\App\Http\Controllers\TodoController::class, 'index'])->name('todo.index');
Route::get('/todo/create', [\App\Http\Controllers\TodoController::class, 'create'])->name('todo.create');
Route::get('/todo/edit', [\App\Http\Controllers\TodoController::class, 'edit'])->name('todo.edit');
Route::patch('/todo/{todo}/complete', [TodoController::class, 'complete'])->name('todo.complete');
Route::patch('/todo/{todo}/uncomplete', [TodoController::class, 'uncomplete'])->name('todo.uncomplete');
Route::patch('/user/{user}/makeadmin', [UserController::class, 'makeAdmin'])->name('user.makeadmin');
Route::patch('/user/{user}/removeadmin', [UserController::class, 'removeAdmin'])->name('user.removeadmin');
Route::get('/todo/{todo}/edit', [TodoController::class, 'edit'])->name('todo.edit');
Route::patch('/todo/{todo}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');
Route::delete('/todo', [TodoController::class, 'destroyCompleted'])->name('todo.deleteallcompleted');

Route::get('/user', [    \App\Http\Controllers\UserController::class, 
    'index'
])->name('user.index');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::resource('todo', TodoController::class)->except(['show']);

require __DIR__.'/auth.php';