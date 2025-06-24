<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">📧 Verify Your Email Address</h4>
            </div>

            <div class="card-body p-4">
                <p class="text-muted">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
                    If you didn’t receive the email, we’ll gladly send you another.
                </p>

                <!-- Example Success Message -->
                <!-- You can toggle this div with Laravel's session -->
                <div class="alert alert-success mt-3" role="alert">
                    ✅ A new verification link has been sent to the email address you provided during registration.
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <!-- Resend Verification Email Form -->
                    <form method="POST" action="/email/verification-notification">
                        <!-- Include CSRF token in Laravel -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-success">
                            🔁 Resend Verification Email
                        </button>
                    </form>

                    <!-- Logout Form -->
                    <form method="POST" action="/logout">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-outline-secondary">
                            🔒 Log Out
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-footer text-center small text-muted">
                Didn’t get the email? Check your spam or junk folder.
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional if needed) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
<
