<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div align="center">
        <div style="position: absolute; top: 20px; right: 20px; z-index: 10;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    Log out
                </button>
            </form>
        </div>

        <img src="{{ $user->image ? asset('storage/' . $user->image) : 'https://via.placeholder.com/150' }}"
             alt="User Picture"
             style=" width: 200px; height: 200px; object-fit: cover; border-radius: 50%;" class="mt-4">
        <p>User: {{ $user->firstName }} {{ $user->lastName }}</p>
        <p>Email: {{ $user->email }} </p>
        <p>Projects: <a href="{{ route('showProjects') }}">Show Projects</a></p>

        <h2 class="mt-5">Add Project</h2>
        <div class="mt-2">
            <form action="{{ route('storeProject') }}" method="POST">
                @csrf
                <label for="title" class="mt-2"> Project name</label>
                <div class="mt-1">
                    <input type="text" name="name" placeholder="Enter the project name">
                </div>
                <label for="deadline" class="mt-2">Deadline </label>
                <div class="mt-1">
                    <input type="date" name="deadline" placeholder="Enter the deadline">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-outline-primary">Add Project</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
