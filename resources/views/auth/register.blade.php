<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up • Instagram</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&display=swap" rel="stylesheet">
</head>
<body>

    <div class="container login-container">
        <div class="card">
            <div class="card-body" style="padding: 40px 40px 20px;">
                <div class="logo">Instagram</div>
                <p class="text-center text-muted" style="font-weight: 600;">Sign up to see photos and videos from your friends.</p>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <input type="email" name="email" class="form-control" placeholder="Email address" required value="{{ old('email') }}">
                    </div>
                    <div class="mb-2">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-2">
                       <input type="text" name="name" class="form-control" placeholder="Full Name" required value="{{ old('name') }}">
                   </div>
                    <div class="mb-2">
                       <input type="text" name="username" class="form-control" placeholder="Username" required value="{{ old('username') }}">
                   </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card signup-card text-center">
            <p class="mb-0">Have an account? <a href="{{ route('login.index') }}">Log in</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>