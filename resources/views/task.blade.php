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

        <h3 class="mt-4">All Tasks</h3>
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
                        <form action="{{ route('updateTaskStatus', ['taskId' => $task->id, 'projectId' => $project->id,'status' => 'completed']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-outline-primary">Mark as Completed</button>
                        </form>
                    </td>
                    <td style="border: 2px solid black; padding: 10px;">
                        <form action="{{ route('updateTaskStatus', ['taskId' => $task->id, 'projectId' => $project->id, 'status' => 'not_completed']) }}" method="POST">
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

        <div class="d-flex justify-content-center mt-4 align-items-center">
            <div class="pagination-links mt-3">
                {{ $tasks->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-outline-primary" onclick="openAssignModal({{ $project->id }})">
                Assign Task
            </button>
        </div>

        <div class="mt-2">
            <p><a href="{{ route('showAssignTasks') }}" class="btn btn-outline-primary">Signed Tasks</a></p>
        </div>

        <div class="mt-2">
            <a href="{{ route('showProjects') }}" class="btn btn-outline-primary "> Back to Projects</a>
        </div>

        <div class="mt-2">
            <a href="{{ route('showUser') }}" class="btn btn-outline-primary "> Back to User page</a>
        </div>

        <div id="assignModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                background: white; padding: 20px; border: 2px solid black; z-index: 1000;">

            <h2>Select User to Assign</h2>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Assign</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->firstName }}</td>
                        <td>{{ $user->lastName }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('assignTask') }}" method="POST">
                                @csrf
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>
                                            <form action="{{ route('assignTask') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id ?? null }}">
                                                <input type="hidden" name="task_id" id="modalTaskId" value="{{ $task->id }}">
                                                <button type="submit" class="btn btn-outline-primary">Assign</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
                <button onclick="closeAssignModal()" class="btn btn-outline-secondary">Close</button>
        </div>

        <div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);
                z-index: 999;" onclick="closeAssignModal()">
        </div>

        <script>
            function openAssignModal(taskId) {
                document.getElementById("modalTaskId").value = taskId;

                document.getElementById("assignModal").style.display = "block";
                document.getElementById("overlay").style.display = "block";
            }

            function closeAssignModal() {
                document.getElementById("assignModal").style.display = "none";
                document.getElementById("overlay").style.display = "none";
            }
        </script>

    </div>
</body>
</html>
