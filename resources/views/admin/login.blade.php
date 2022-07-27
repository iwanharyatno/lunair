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
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error')['message'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" required>
            </div>
            <div classc"form-check mb-3">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label for="remember" class="form-check-label">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Login</button>
        </form>
    </main>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
