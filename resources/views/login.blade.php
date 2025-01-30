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
    <h1>Login</h1>
    <form action="{{ route('loginStore') }}" method="POST">
        @csrf
        <label class="mt-1">Email</label>
        <div class="mt-1">
            <input type="email" name="email" placeholder="email" required><br>
        </div>
        <label class="mt-1">Password</label>
        <div class="mt-1">
            <input type="password" name="password" placeholder="password" required><br>
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-outline-primary">Login</button>
        </div>
    </form>
    <div class="mt-4">
        <h3>Sign up Here </h3>
        <a href="{{ route('signupForm') }}" class="btn btn-outline-primary mt-2">Sign up</a>
    </div>
</div>
</body>
</html>
