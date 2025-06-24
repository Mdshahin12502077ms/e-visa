<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #f5f7fa;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Segoe UI", sans-serif;
    }

    .form-wrapper {
      background: #ffffff;
      border-radius: 16px;
      padding: 40px;
      width: 100%;
      max-width: 480px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05);
      color: #1f2937;
    }

    h3 {
      font-weight: 600;
      color: #1f2937;
    }

    p {
      color: #6b7280;
    }

    .form-control {
      background-color: #f0f4f8;
      border: 1px solid #d1d5db;
      color: #1f2937;
    }

    .form-control:focus {
      background-color: #ffffff;
      border-color: #2563eb;
      box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
    }

    .btn-primary {
      background-color: #2563eb;
      border-color: #2563eb;
      font-weight: 500;
    }

    .btn-primary:hover {
      background-color: #1d4ed8;
      border-color: #1d4ed8;
    }

    .text-link {
      color: #2563eb;
    }

    .text-link:hover {
      color: #1d4ed8;
    }

    .text-danger {
      font-size: 0.875rem;
    }
  </style>
</head>
<body>

  <div class="form-wrapper">
    <h3 class="text-center mb-3">🔐 Forgot Password</h3>
    <p class="text-center mb-4">Enter your email address and we'll send you a password reset link.</p>

    <!-- Session Message -->
    <!-- @if (session('status')) <div class="alert alert-success"> ... </div> @endif -->

    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" name="email" class="form-control" placeholder="you@example.com" required>
        @if ($errors->has('email'))
          <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
      </div>

      <div class="d-grid mt-4">
        <button type="submit" class="btn btn-primary">Send Reset Link</button>
      </div>
    </form>

    <div class="text-center mt-4">
      <a href="{{ route('login') }}" class="text-link text-decoration-none">← Back to Login</a>
    </div>
  </div>

</body>
</html>
