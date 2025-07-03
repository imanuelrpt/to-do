<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('todos.index');
});

Route::resource('todos', TodoController::class)->except(['show']);
Route::patch('todos/{todo}/toggle', [TodoController::class, 'toggleStatus'])->name('todos.toggle');
Route::get('todos-export', [ExportController::class, 'excel'])->name('todos.export');
