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

        <h3 class="mt-4">Signed Tasks</h3>
        <table>
            <tr style="border: 2px solid black; padding: 10px;">
                <th style="border: 2px solid black; padding: 10px;">Title</th>
                <th style="border: 2px solid black; padding: 10px;">Description</th>
                <th style="border: 2px solid black; padding: 10px;">Status</th>
                <th style="border: 2px solid black; padding: 10px;">Mark as Completed</th>
                <th style="border: 2px solid black; padding: 10px;">Mark as Not Completed</th>
            </tr>
            <tr style="border: 2px solid black; padding: 10px;">
                @forelse($tasks as $task)
                    <td style="border: 2px solid black; padding: 10px;">{{ $task->title }}</td>
                    <td style="border: 2px solid black; padding: 10px;">{{ $task->description }}</td>
                    <td style="border: 2px solid black; padding: 10px;">
                        @if ($task->completed)
                            <span class="text-success">Completed</span>
                        @else
                            <span class="text-danger">Not Completed</span>
                        @endif
                    </td>
                    <td style="border: 2px solid black; padding: 10px;">
                        <form action="{{ route('updateTaskStatus', ['taskId' => $task->id, 'status' => 'completed']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-outline-primary">Mark as Completed</button>
                        </form>
                    </td>
                    <td style="border: 2px solid black; padding: 10px;">
                        <form action="{{ route('updateTaskStatus', ['taskId' => $task->id, 'status' => 'not_completed']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-outline-danger">Mark as Not Completed</button>
                        </form>
                    </td>
            </tr>
            @empty
                <p>No tasks found for this project.</p>
            @endforelse
        </table>

        <div class="mt-3">
            <a href="{{ route('showProjects') }}" class="btn btn-outline-primary "> Back to Projects</a>
        </div>

        <div class="mt-2">
            <a href="{{ route('showUser') }}" class="btn btn-outline-primary "> Back to User page</a>
        </div>

    </div>

</body>
</html>
