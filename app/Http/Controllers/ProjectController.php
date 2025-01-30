<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProjects(): View
    {
        $userId = Auth::id();
        $projects = Project::where('user_id', $userId)->paginate(4);

        return view('project', compact('projects'));
    }

    public function showProjectTasks(int $projectId): View
    {
        $project = Project::with('tasks')->findOrFail($projectId);

        $tasks = $project->tasks()->paginate(4);

        return view('task', [
            'project' => $project,
            'tasks' => $tasks,
        ]);
    }

    public function updateProjectStatus(int $projectId, $status): RedirectResponse
    {
        $project = Project::findOrFail($projectId);

        if ($status == 'completed') {
            $project->completed = true;
        } elseif ($status == 'not_completed') {
            $project->completed = false;
        }

        $project->save();

        return redirect()->route('showProjects')->with('success', 'Project status updated!');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);

        $project = new Project([
            'name' => $request->name,
            'deadline' => $request->deadline,
            'completed' => false,
            'user_id' => Auth::id(),
        ]);

        $project->save();

        return redirect()->route('showUser')->with('success', 'Project added successfully!');
    }

}
