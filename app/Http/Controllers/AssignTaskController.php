<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AssignTaskController extends Controller
{

    public function showTasks(): View
    {
        $tasks = DB::table('user_tasks')
            ->join('tasks', 'user_tasks.task_id', '=', 'tasks.id')
            ->join('users', 'user_tasks.user_id', '=', 'users.id')
            ->select('tasks.*', 'users.firstName', 'users.lastName', 'users.email')
            ->where('user_tasks.user_id', auth()->id())
            ->distinct()
            ->get();

        return view('signedTasks', compact('tasks'));
    }

    public function assignTask(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
        ]);

        DB::table('user_tasks')->insert([
            'user_id' => $request->user_id,
            'task_id' => $request->task_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('showProjects');

    }

}
