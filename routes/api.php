<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('todo-list',[TodoListController::class,'index'])->name('todo-list.index');
Route::get('todo-list/{todolist}',[TodoListController::class,'show'])->name('todo-list.show');
Route::post('todo-list',[TodoListController::class,'store'])->name('todo-list.store');
Route::delete('todo-list/{todolist}',[TodoListController::class,'destroy'])->name('todo-list.destroy');
Route::patch('todo-list/{todolist}',[TodoListController::class,'update'])->name('todo-list.update');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
