<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - DSSC</title>

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('img/dssc_logo_official.png') }}" type="image/png" />

  <!-- Bootstrap 5 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <!-- Custom CSS -->
  <style>
    body {
      background: url('/img/dssc.png') no-repeat center center/cover;
      min-height: 100vh;
    }

    .auth-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      backdrop-filter: blur(8px);
      border: none;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      padding: 2rem 2rem 2.5rem;
    }

    .auth-logo {
      height: 50px; /* smaller logo */
      margin-bottom: 1rem;
    }

    h2 {
      font-size: 1.75rem; /* smaller heading */
      margin-bottom: 0.25rem;
    }

    p.text-muted {
      font-size: 0.9rem;
      margin-bottom: 1.5rem;
    }

    label.form-label {
      font-size: 0.9rem; /* smaller labels */
    }

    .form-control {
      border: 2px solid #dee2e6;
      padding: 0.5rem 0.75rem; /* smaller input padding */
      font-size: 0.9rem;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .btn-primary {
      background-color: #2563eb;
      padding: 0.5rem;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #1d4ed8;
    }

    .auth-footer {
      font-size: 0.85rem;
    }

    .form-check-label.text-muted {
      font-size: 0.85rem;
    }

    a.text-decoration-none {
      font-size: 0.9rem;
    }
  </style>
</head>
<body class="d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="auth-card">
          <div class="text-center mb-3">
            <img src="{{ asset('img/logoreg.png') }}" alt="DSSC Logo" class="auth-logo" />
            <h2 class="fw-bold">Welcome Back</h2>
            <p class="text-muted">Sign in to your account</p>
          </div>

          <form action="{{ route('loginUser') }}" method="POST">
            @csrf

            <!-- Notifications -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('failed') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Email Input -->
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                placeholder="Enter your email"
                required
              />
            </div>

            <!-- Password Input -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Enter your password"
                required
              />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                <label class="form-check-label text-muted" for="remember">Remember me</label>
              </div>
           
              <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>

            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100 mb-3">Sign In</button>

            <!-- Registration Link -->
            <div class="text-center auth-footer">
              <span class="text-muted">Don't have an account? </span>
              <a href="{{ route('registerUser') }}" class="text-decoration-none fw-semibold"
                >Create account</a
              >
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
