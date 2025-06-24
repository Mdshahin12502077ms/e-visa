<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | e-Visa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="col-md-6">
        <div class="card shadow-lg border-0">
            <div class="card-header text-center bg-primary text-white">
                <h4 class="mb-0">🔐 Reset Your Password</h4>
                <small>Enter your new password to access your e-Visa account</small>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="/reset-password">
                    <!-- CSRF Token (only needed if used in Laravel) -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- Reset Token -->
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control"
                               value="{{ old('email', request()->email) }}" required autofocus>
                        @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        @error('password')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control" required>
                        @error('password_confirmation')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">🔁 Reset Password</button>
                    </div>
                </form>
            </div>

            <div class="card-footer text-center small text-muted">
                Need help? <a href="/contact" class="text-decoration-none">Contact support</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

