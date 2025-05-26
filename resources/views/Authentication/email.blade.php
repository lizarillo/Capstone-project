<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reset Password - DSSC</title>

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

  display: flex;
  justify-content: center;
  align-items: center;
  padding: 1rem;
  margin: 0;
}

.auth-card {
  background: rgba(255, 255, 255, 0.95);
  border-radius: 20px;
  backdrop-filter: blur(8px);
  border: none;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  padding: 2rem 2rem 2.5rem;
  max-width: 400px;
}


    .auth-logo {
      height: 50px;
      margin-bottom: 1rem;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    h2 {
      font-size: 1.75rem;
      margin-bottom: 0.5rem;
      text-align: center;
    }

    p.text-muted {
      font-size: 0.9rem;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    label.form-label {
      font-size: 0.9rem;
    }

    .form-control {
      border: 2px solid #dee2e6;
      padding: 0.5rem 0.75rem;
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
      width: 100%;
    }

    .btn-primary:hover {
      background-color: #1d4ed8;
    }

    .alert {
      font-size: 0.9rem;
    }

    .text-center a {
      font-size: 0.9rem;
      text-decoration: none;
      color: #2563eb;
    }

    .text-center a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="auth-card">
    <img src="{{ asset('img/logoreg.png') }}" alt="DSSC Logo" class="auth-logo" />
    <h2>Reset Password</h2>
    <p class="text-muted">Enter your email to receive password reset link</p>

    @if(session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input
          id="email"
          type="email"
          name="email"
          value="{{ old('email') }}"
          required
          autofocus
          class="form-control @error('email') is-invalid @enderror"
          placeholder="Enter your email"
        />
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
    </form>

    <div class="text-center mt-3">
      <a href="{{ route('loginUser') }}">Back to login</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
