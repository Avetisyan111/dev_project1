<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div align="center">
        <h1>Sign up</h1>
        <form action="{{ route('signupStore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="mt-1">First Name</label>
            <div class="mt-1">
                <input type="text" name="firstName" required><br>
            </div>
            <label class="mt-1">Last Name</label>
            <div class="mt-1">
                <input type="text" name="lastName" required><br>
            </div>
            <label class="mt-1">Email</label>
            <div class="mt-1">
                <input type="email" name="email" required><br>
            </div>
            <label class="mt-1">Password</label>
            <div class="mt-1">
                <input type="password" name="password" required><br>
            </div>
            <label class="mt-1">Image</label>
            <div class="mt-1">
                <input type="file" name="image"><br>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-outline-primary">Sign up</button>
            </div>
        </form>
        <div class="mt-3">
            <a href="{{ route('loginForm') }}" class="btn btn-outline-primary">Log in</a>
        </div>
    </div>
</body>
</html>


