<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LogoutController;

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
    Route::post('/project', [ProjectController::class, 'store'])->name('storeProject');
    Route::get('/project/{projectId}/status/{status}', [ProjectController::class, 'updateProjectStatus'])
        ->name('updateProjectStatus');
    Route::get('/task/{taskId}/status/{status}', [TaskController::class, 'updateTaskStatus'])
        ->name('updateTaskStatus');

    Route::post('/task', [TaskController::class, 'store'])->name('storeTask');
});


