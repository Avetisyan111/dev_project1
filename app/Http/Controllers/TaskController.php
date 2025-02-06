<?php

declare(strict_types=1);

namespace App\Http\Controllers;


use App\Models\Task;
use App\Models\User;
use App\Models\UserTask;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeTask(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_id' => 'required|exists:projects,id',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'project_id' => $request->project_id,
        ]);


        UserTask::create([
            'user_id' => auth()->id(),
            'task_id' => $task->id,
        ]);


        return redirect()->route('showProjectTasks', ['projectId' => $request->project_id])
            ->with('success', 'Task added successfully!');
    }

    public function updateTaskStatus(int $taskId, $status): RedirectResponse
    {
        $task = Task::findOrFail($taskId);

        $task->completed = ($status == 'completed') ? true: false;

        $task->save();

        return back();
    }


    public function showUser($taskId)
    {
        $task = Task::findOrFail($taskId);
        $assignedUserIds = $task->users->pluck('id')->toArray();

        $users = User::whereNotIn('id', $assignedUserIds)->get();

        return response()->json(['users' => $users]);
    }

}

