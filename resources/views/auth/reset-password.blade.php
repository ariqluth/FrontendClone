<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password • Instagram</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&display=swap" rel="stylesheet">
</head>
<body>

    <div class="container login-container">
        <div class="card">
            <div class="card-body">
                <div class="logo">Forgot Password</div>
                <p>Trouble Logging In ?</p>
                <p>Enter your email address and we'll send you a link to reset your password.</p>
                <form action="{{ route('reset-password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email address" required value="{{ old('email') }}">
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Send Login Link</button>
                    </div>
                </form>

                <div class="or-separator">OR</div>

                <div class="register">
                    <a href="{{ route('register.index') }}">Sign up</a>
                </div>
            </div>
        </div>

        <div class="card signup-card text-center">
            <p class="mb-0">Back to  <a href="{{ route('login.index') }}">Log In</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>