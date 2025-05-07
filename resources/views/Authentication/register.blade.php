<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DSSC</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }

        .auth-logo {
            height: 70px;
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 2px solid #dee2e6;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .btn-primary {
            background-color: #2563eb;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .auth-footer {
            font-size: 0.9rem;
        }
    </style>
</head>
<body class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card p-4 p-md-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('img/logoreg.png') }}" alt="DSSC Logo" class="auth-logo">
                        <h2 class="mt-3 mb-1 fw-bold">Create Account</h2>
                        <p class="text-muted">Register to continue</p>
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

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Role Selection -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Select Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="" disabled selected>Select your role</option>
                                <option value="admin">Admin</option>
                                <option value="superadmin">Superadmin</option>
                            </select>
                        </div>

                        <!-- Name Fields -->
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" 
                                       placeholder="First name" required value="{{ old('firstname') }}">
                            </div>
                            <div class="col">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" 
                                       placeholder="Last name" required value="{{ old('lastname') }}">
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   placeholder="Email Address" required value="{{ old('email') }}">
                        </div>

                        <!-- Password Fields -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Password (min 6 characters)" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" 
                                   name="password_confirmation" placeholder="Confirm Password" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>

                        <!-- Login Link -->
                        <div class="text-center auth-footer">
                            <span class="text-muted">Already have an account? </span>
                            <a href="{{ route('mylogin') }}" class="text-decoration-none fw-semibold">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>