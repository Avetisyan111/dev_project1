<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div align="center" class="mt-3">
        <div >
            <h2 >Add Task</h2>
            <form action="{{ route('storeTask') }}" method="POST">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <label for="title" class="mt-1">Title</label>
                <div class="mt-1">
                    <input type="text" name="title" placeholder="Enter the title">
                </div>
                <label for="description" class="mt-2">Description</label>
                <div class="mt-1">
                    <input type="text" name="description" placeholder="Enter the description">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-outline-primary">Add Task</button>
                </div>
            </form>
        </div>

        <div class="mt-4">
            <h2>Project Tasks</h2>
            @forelse($tasks as $task)
                <h5 class="mt-4">Title: {{ $task->title }}</h5>
                <p class="mt-3">Description: {{ $task->description }}</p>
                <p>Status:
                    @if ($task->completed)
                        <span class="text-success">Completed</span>
                    @else
                        <span class="text-danger">Not Completed</span>
                    @endif
                </p>
                <a href="{{ route('updateTaskStatus', ['taskId' => $task->id, 'status' => 'completed']) }}" class="btn btn-outline-primary">Mark as Completed</a>
                <a href="{{ route('updateTaskStatus', ['taskId' => $task->id, 'status' => 'not_completed']) }}" class="btn btn-outline-danger">Mark as Not Completed</a>

            @empty
                <p>No tasks found for this project.</p>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $tasks->links('pagination::bootstrap-5') }}
        </div>
        <div class="mt-3">
            <a href="{{ route('showProjects') }}" class="btn btn-outline-primary "> Back to Projects</a></p>
        </div>
        <div>
            <a href="{{ route('showUser') }}" class="btn btn-outline-primary "> Back to User page</a></p>
        </div>
    </div>
</body>
</html>
