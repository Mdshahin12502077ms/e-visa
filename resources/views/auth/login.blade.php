<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>eVisa Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('Backend/evisa.gif') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 420px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            background-color: #f1f3f5;
            border: 1px solid #ced4da;
        }

        .form-control::placeholder {
            color: #999;
        }

        .btn-primary {
            background-color: #0d9488;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0f766e;
        }

        .text-link {
            color: #0d9488;
            text-decoration: none;
        }

        .text-link:hover {
            text-decoration: underline;
        }

        .text-danger {
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

    <div class="overlay">
        <h4 class="text-center mb-4">eVisa Login</h4>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="you@example.com" value="{{ old('email') }}">
                @error('email') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
                @error('password') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                <label for="remember_me" class="form-check-label">Remember Me</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-link">Forgot Password?</a>
                @endif
                <button type="submit" class="btn btn-primary px-4">Login</button>
            </div>
        </form>
    </div>

</body>
</html>
