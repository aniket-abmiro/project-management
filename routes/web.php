<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

// Route::get('/user/allusers', [UserController::class, 'showAll']);
// Route::get('/user/project/{user}', [UserController::class, 'showProject']);
// Route::get('/user/task/{user}', [UserController::class, 'showTask']);
// Route::get('/user/subtask/{user}', [UserController::class, 'showSubTask']);


Route::get('/project/allprojects', [ProjectController::class, 'showAll']);
Route::get('/project/user/{project}', [ProjectController::class, 'showUser']);
Route::get('/project/task/{project}', [ProjectController::class, 'showTask']);
Route::get('/project/subtask/{project}', [ProjectController::class, 'showSubTask']);


Route::get('/task/alltasks', [TaskController::class, 'showAll']);
Route::get('/task/user/{task}', [TaskController::class, 'showUser']);
Route::get('/task/project/{task}', [TaskController::class, 'showProject']);
Route::get('/task/subtask/{task}', [TaskController::class, 'showSubTask']);


Route::get('/subtask/allsubtasks', [SubTaskController::class, 'showAll']);
Route::get('/subtask/user/{subtask}', [SubTaskController::class, 'showUser']);
Route::get('/subtask/project/{subtask}', [SubTaskController::class, 'showProject']);
Route::get('/subtask/task/{subtask}', [SubTaskController::class, 'showTask']);


// Route::get('/projects/showtask/{project}', [ProjectController::class, 'showTask']);
// Route::get('/tasks/{task}', [TaskController::class, 'showUser']);
// Route::get('/subtasks/{user}', [SubTaskController::class, 'show']);
// Route::get('/subtasks/{task}', [SubTaskController::class, 'showsubtasks']);




