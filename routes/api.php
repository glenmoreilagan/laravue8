<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;
use App\Events\GetTodoEvent;
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
// header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
// header("Access-Control-Max-Age", "3600");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
// header("Access-Control-Allow-Credentials", "true");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get all data
Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
// get 1 data
Route::get('/todo/{id}', [TodoController::class, 'show'])->name('todo.show');
// save data
Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
// got edit form with selected data
Route::get('/todo/{id}/edit', [TodoController::class, 'edit'])->name('todo.edit');
// update data
Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
// delete data
Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');

Route::post('/getTodos', function()
{
	$text = request()->todo;

	event(new App\Events\GetTodoEvent($text));
	return "Event has been sent!";
});