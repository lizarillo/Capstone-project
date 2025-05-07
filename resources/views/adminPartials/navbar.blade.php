<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('img/logoreg.png') }}" alt="DSSC Logo" height="100" width="100">
</div>


<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top" style="border-bottom: 2px solid #004080; z-index: 1030;">


    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- User Profile Dropdown -->
        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
        @auth
            @php
                $user = Auth::user();
                $profilePic = $user->profile_picture
                    ? asset('storage/' . $user->profile_picture) . '?v=' . time()
                    : asset('img/user.jpg');
                $userName = $user->firstname . ' ' . $user->lastname;
            @endphp
            <img src="{{ $profilePic }}" alt="Profile" class="img-circle" style="width: 30px; height: 30px; object-fit: cover;">
            <span class="d-none d-md-inline">
                {{ $userName }}
                @if($user->role === 'admin')
                    <small class="text-muted">(Admin)</small>
                @elseif($user->role === 'Superadmin')
                    <small class="text-muted">(Superdmin)</small>
                @endif
            </span>
        @else
            <img src="{{ asset('img/user.jpg') }}" alt="Profile" class="img-circle" style="width: 30px; height: 30px; object-fit: cover;">
            <span class="d-none d-md-inline">Guest</span>
        @endauth
    </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="border-top: 2px solid #004080;">
                @auth
                    <a href="{{ route('admin.profileEdit') }}" class="dropdown-item">
                        <i class="fas fa-user-edit"></i> Edit Account
                    </a>

                    
                    <a href="#" class="dropdown-item" onclick="confirmLogout(event)">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                @else
                    <a href="{{ route('mylogin') }}" class="dropdown-item">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                @endauth
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- JavaScript for Logout Confirmation with SweetAlert2 -->
<script type="text/javascript">
    function confirmLogout(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, logout',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('logout') }}";
            }
        });
    }
</script>
