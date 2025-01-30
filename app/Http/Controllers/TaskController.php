<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateTaskStatus(int $taskId, $status): RedirectResponse
    {
        $task = Task::findOrFail($taskId);

        if ($status == 'completed') {
            $task->completed = true;
        } elseif ($status == 'not_completed') {
            $task->completed = false;
        }

        // Save the updated task
        $task->save();

        return redirect()->route('showProjectTasks', ['projectId' => $task->project_id])
            ->with('success', 'Task status updated!');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
        ]);

        $project = Project::findOrFail($request->project_id);

        $task = new Task([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => false,
            'project_id' => $project->id,
            'user_id' => Auth::id(),
        ]);

        $task->save();

        return redirect()->route('showProjectTasks', ['projectId' => $project->id])->with('success', 'Task created successfully!');
    }

}

