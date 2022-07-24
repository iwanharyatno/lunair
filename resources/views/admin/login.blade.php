<!DOCTYPE html>
<html>
<head>
    <title>Sitaara Admin | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <main class="p-4">
        <h1 class="text-center mb-4">Admin Login</h1>
        <form method="post" class="border rounded p-3 mx-auto" style="max-width: 25rem">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Login</button>
        </form>
    </main>
</body>
</html>
