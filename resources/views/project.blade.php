<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div align="center" class="mt-4">
        <h2>All Projects</h2>

        <table>
            <tr style="border: 2px solid black; padding: 10px;">
                <th style="border: 2px solid black; padding: 10px;">Project Name</th>
                <th style="border: 2px solid black; padding: 10px;">Deadline</th>
                <th style="border: 2px solid black; padding: 10px;">Status</th>
                <th style="border: 2px solid black; padding: 10px;">Mark as Completed</th>
                <th style="border: 2px solid black; padding: 10px;">Mark as Not Completed</th>
                <th style="border: 2px solid black; padding: 10px;">Show Tasks</th>
            </tr>

            <tr style="border: 2px solid black; padding: 10px;">
                @foreach($projects as $project)
                    <td style="border: 2px solid black; padding: 10px;">{{ $project->name }}</td>
                    <td style="border: 2px solid black; padding: 10px;">{{ $project->deadline }}</td>
                    <td style="border: 2px solid black; padding: 10px;">
                        @if ($project->completed)
                            <span class="text-success">Completed</span>
                        @else
                            <span class="text-danger">Not Completed</span>
                        @endif
                    </td>
                    <td style="border: 2px solid black; padding: 10px;">
                        <a href="{{ route('updateProjectStatus', ['projectId' => $project->id, 'status' => 'completed']) }}"
                           class="btn btn-outline-primary">Completed</a>
                    </td>
                    <td style="border: 2px solid black; padding: 10px;">
                        <a href="{{ route('updateProjectStatus', ['projectId' => $project->id, 'status' => 'not_completed']) }}"
                           class="btn btn-outline-danger">Not Completed</a>
                    </td>
                    <td style="border: 2px solid black; padding: 10px;">
                        <a href="{{ route('showProjectTasks', ['projectId' => $project->id]) }}" class="btn btn-outline-primary">Show Tasks</a>
                    </td>
                </tr>
                @endforeach
        </table>

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

