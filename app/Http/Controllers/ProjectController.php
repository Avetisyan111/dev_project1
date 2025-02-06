<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeProject(Request $request): RedirectResponse
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

    public function showProjects(): View
    {
        $userId = Auth::id();

        $projects = Project::where('user_id', $userId)->paginate(8);

        $users = User::all();

        return view('project', compact('projects',  'users'));

    }

    public function updateProjectStatus(int $projectId, string $status): RedirectResponse
    {
        $completedStatus = ($status == 'completed') ? 1 : 0;

        DB::table('projects')
            ->where('id', $projectId)
            ->update(['completed' => $completedStatus]);

        return redirect()->route('showProjects')->with('success', 'Project status updated!');
    }

    public function showProjectTasks(int $projectId): View
    {
        $project = Project::findOrFail($projectId);

        $users = User::all();

        $tasks = DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.id', $projectId)
            ->select('tasks.*')
            ->paginate(4);

        return view('task', compact('project' , 'tasks', 'users'));

    }

}
