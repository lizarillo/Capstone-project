<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - DSSC</title>

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
    max-width: 400px; /* Added max-width for better proportions */
    margin: 0 auto;
    padding: 1.5rem 1.5rem 2rem; /* Reduced padding */
    border-radius: 15px; /* Smaller border radius */
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
    font-size: 0.7rem; /* Smaller subtext */
    margin-bottom: 1rem;
}

.form-label {
    font-size: 0.8rem !important; /* Smaller labels */
    margin-bottom: 0.2rem; /* Tighter spacing */
}

.form-control, .form-select {
    padding: 0.3rem 0.5rem;
    font-size: 0.85rem;
    height: 34px; /* Consistent height */
    border-radius: 8px; /* Slightly rounded */
}

    
    .form-control:focus, .form-select:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 5px rgba(37, 99, 235, 0.1);
    }

   .btn-primary {
    padding: 0.3rem;
    font-size: 0.9rem;
}

    .btn-primary:hover {
      background-color: #1d4ed8;
    }

    .auth-footer {
      font-size: 0.85rem;
    }

    a.text-decoration-none {
      font-size: 0.9rem;
    }

    .mb-2 {
    margin-bottom: 0.6rem !important;
}
.mb-3 {
    margin-bottom: 1rem !important;
}
  </style>


</head>
<body class="d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="auth-card">
          <div class="text-center mb-3">
            <img src="{{ asset('img/logoreg.png') }}" alt="DSSC Logo" class="auth-logo" />
            <h2 class="fw-bold">Create Account</h2>
            <p class="text-muted">Register to get started</p>
          </div>

          <form action="{{ route('registerUser') }}" method="POST">
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

          <!-- Role Selection -->
<div class="mb-2">
  <label for="role" class="form-label" style="font-size: 0.85rem;">Select Role</label>
  <select
    id="role"
    name="role"
    class="form-select"
    required
    style="padding: 0.3rem 0.5rem; font-size: 0.85rem; height: 32px;"
  >
    <option value="" disabled selected>Select your role</option>
    <option value="admin">Admin</option>
    <option value="superadmin">Superadmin</option>
  </select>
</div>
           <!-- Name -->
<div class="row mb-2">
  <div class="col">
    <label for="firstname" class="form-label" style="font-size: 0.85rem;">First Name</label>
    <input
      type="text"
      id="firstname"
      name="firstname"
      class="form-control"
      value="{{ old('firstname') }}"
      required
      style="padding: 0.3rem 0.5rem; font-size: 0.85rem; height: 32px;"
    />
  </div>
  <div class="col">
    <label for="lastname" class="form-label" style="font-size: 0.85rem;">Last Name</label>
    <input
      type="text"
      id="lastname"
      name="lastname"
      class="form-control"
      value="{{ old('lastname') }}"
      required
      style="padding: 0.3rem 0.5rem; font-size: 0.85rem; height: 32px;"
    />
  </div>
</div>

<!-- Email -->
<div class="mb-2">
  <label for="email" class="form-label" style="font-size: 0.85rem;">Email Address</label>
  <input
    type="email"
    id="email"
    name="email"
    class="form-control"
    value="{{ old('email') }}"
    required
    style="padding: 0.3rem 0.5rem; font-size: 0.85rem; height: 32px;"
  />
</div>

<!-- Password -->
<div class="mb-2">
  <label for="password" class="form-label" style="font-size: 0.85rem;">Password</label>
  <input
    type="password"
    id="password"
    name="password"
    class="form-control"
    required
    style="padding: 0.3rem 0.5rem; font-size: 0.85rem; height: 32px;"
  />
</div>

<!-- Confirm Password -->
<div class="mb-3">
  <label for="password_confirmation" class="form-label" style="font-size: 0.85rem;">Confirm Password</label>
  <input
    type="password"
    id="password_confirmation"
    name="password_confirmation"
    class="form-control"
    required
    style="padding: 0.3rem 0.5rem; font-size: 0.85rem; height: 32px;"
  />
</div>

<!-- Submit -->
<button type="submit" class="btn btn-primary w-100 mb-3" style="padding: 0.4rem; font-size: 0.95rem;">Register</button>

<!-- Link to Login -->
<div class="text-center auth-footer" style="font-size: 0.85rem;">
  <span class="text-muted">Already have an account? </span>
  <a href="{{ route('mylogin') }}" class="text-decoration-none fw-semibold" style="font-size: 0.9rem;">Login</a>
</div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
