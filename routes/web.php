<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AssignTaskController;

Route::get('/', function () {
    return view('login');
});

Route::get('/signup', [SignupController::class, 'signupForm'])->name('signupForm');
Route::post('/signup', [SignupController::class, 'store'])->name('signupStore');

Route::get('/login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [LoginController::class, 'login'])->name('loginStore');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/user', [UserController::class, 'showUser'])->name('showUser');

    Route::get('/projects', [ProjectController::class, 'showProjects'])->name('showProjects');
    Route::get('/projects/{projectId}/tasks', [ProjectController::class, 'showProjectTasks'])->name('showProjectTasks');

    Route::post('/project', [ProjectController::class, 'storeProject'])->name('storeProject');
    Route::put('/project/{projectId}/status/{status}', [ProjectController::class, 'updateProjectStatus'])
        ->name('updateProjectStatus');
    Route::put('/task/{taskId}/status/{status}', [TaskController::class, 'updateTaskStatus'])
        ->name('updateTaskStatus');

    Route::post('/task', [TaskController::class, 'storeTask'])->name('storeTask');

    Route::get('/showAssignTasks', [AssignTaskController::class, 'showTasks'])->name('showAssignTasks');
    Route::post('/assignTask', [AssignTaskController::class, 'assignTask'])->name('assignTask');


});


