<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div align="center" class="mt-3">
        <h2>All Projects</h2>

        @foreach($projects as $project)
            <div class="mt-4">
                <h5>Project name:  {{ $project->name }}</h5>
                <p class="mt-3">Deadline: {{ $project->deadline }}</p>
                <p>Status:
                    @if ($project->completed)
                        <span class="text-success">Completed</span>
                    @else
                        <span class="text-danger" >Not Completed</span>
                    @endif
                </p>
                <a href="{{ route('updateProjectStatus', ['projectId' => $project->id, 'status' => 'completed']) }}" class="btn btn-outline-primary">Mark as Completed</a>
                <a href="{{ route('updateProjectStatus', ['projectId' => $project->id, 'status' => 'not_completed']) }}" class="btn btn-outline-danger">Mark as Not Completed</a>
                <p class="mt-2"><a href="{{ route('showProjectTasks', ['projectId' => $project->id]) }}">Show Tasks</a></p>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4 align-items-center">
            <div class="pagination-links mt-3">
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <div>
            <p><a href="{{ route('showUser') }}" class="btn btn-outline-primary">Get back to User page</a></p>
        </div>
    </div>
</body>
</html>

