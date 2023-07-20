<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;

use App\Http\Controllers\FruitController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTasksController;
use App\Http\Controllers\ProjectTasksSubtasksController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TasksSubtasksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProjectAssignmentController;
use App\Http\Controllers\UserTaskAssignmentController;
use App\Http\Controllers\UserSubtasksController;
use App\Http\Controllers\UserTasksController;
use App\Http\Controllers\UserProjectsController;
use App\Http\Controllers\UserProjectsTasksController;
use App\Http\Controllers\UserProjectsTasksSubtasksController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:api')->group(function () {
    Route::apiResource('/fruits', FruitController::class);
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/project', ProjectController::class);
    Route::apiResource('/tasks', TaskController::class);
    Route::apiResource('/subtasks', SubTaskController::class);


    //assign project and task 
    Route::post('assign/project', UserProjectAssignmentController::class);
    Route::post('assign/task', UserTaskAssignmentController::class);



    //user projects
    Route::get('/users/{user}/projects', UserProjectsController::class);

    //user tasks
    Route::get('/users/{user}/tasks', UserTasksController::class);

    //user subtasks
    Route::get('/users/{user}/subtasks', UserSubtasksController::class);

    //user projects and tasks
    Route::get('/users/{user}/projects/tasks', UserProjectsTasksController::class);

    //user projects, tasks, and subtasks
    Route::get('/users/{user}/projects/tasks/subtasks', UserProjectsTasksSubtasksController::class);

    //project tasks
    Route::get('/projects/{project}/tasks', ProjectTasksController::class);

    //project tasks and subtasks
    Route::get('/projects/{project}/tasks/subtasks', ProjectTasksSubtasksController::class);

    //task subtasks
    Route::get('/tasks/{task}/subtasks', TasksSubtasksController::class);

    Route::post('auth/logout', [LogoutController::class, 'logout']);
    Route::post('auth/refresh', [LoginController::class, 'refresh']);
    Route::post('auth/me', [LoginController::class, 'me']);
});




//auth,assign middleware =>
// Route::middleware('auth:api', 'assignPermissionCheck')->group(function () {

// });

//login and registration
Route::post('auth/login', [LoginController::class, 'login'])->middleware('denyIfAuthenticated');
Route::post('auth/register', RegisterController::class)->middleware('denyIfAuthenticated');








//gets and polici