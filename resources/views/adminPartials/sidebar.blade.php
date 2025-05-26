<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #004080; display: flex; flex-direction: column; min-height: 100vh;">

    <!-- DSSC Logo and Title -->
    <a href="index3.html" class="brand-link d-flex align-items-center" style="background-color: #004080;">
        <img src="{{ asset('img/logodssc.jpg') }}" alt="DSSC Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8;">
        <span class="brand-text font-weight-light text-white" style="font-size: 14px;">
            Davao del Sur State College
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column justify-content-between p-2" style="background-color: #004080; flex-grow: 1;">
        
        <!-- Top Part -->
        <div>
            <!-- RegisTrack Brand Panel -->
            <div class="registrack-panel mt-3 pb-3 mb-3">
                <div class="registrack-brand d-flex align-items-center px-3 py-2">
                    <img src="{{ asset('img/reg.jpg') }}" alt="RegisTrack Logo"
                         class="mr-2"
                         style="width: 50px; height: 50px; object-fit: contain; border-radius: 80px; opacity: 0.9;">
                    <span class="text-white font-weight-bold animated-brand" 
                          style="font-size: 14px; letter-spacing: 1px;">
                        RegisTrack
                    </span>
                </div>
                <div class="registrack-separator my-3" 
                     style="border-top: 2px dashed rgba(255,255,255,0.15); width: 100%;"></div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <!-- Dashboard -->
                    <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                  

                    <!-- Document Submitted -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-folder-open"></i>
                            <p>
                                Document Submitted
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('listDocuments') }}" class="nav-link">
                                    <i class="nav-icon fas fa-inbox text-info"></i>
                                    <p>All Submitted</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-day text-info"></i>
                                    <p>Submitted Per Day</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt text-success"></i>
                                    <p>By Documents</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-graduate text-warning"></i>
                                    <p>By Student</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Manage Requests -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>
                                Manage Requests
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-clock text-warning"></i>
                                    <p>Pending Requests</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-check-circle text-success"></i>
                                    <p>Approved Requests</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-times-circle text-danger"></i>
                                    <p>Rejected Requests</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Reports -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                Activity Logs
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.reports') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Admin Logs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-history"></i>
                                    <p>Student Login History</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Admin Profile -->
                    <li class="nav-item">
                        <a href="{{ route('admin.profileEdit') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Admin Profile</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</aside>

<style>
.animated-brand {
    display: inline-flex;
    align-items: center;
    font-family: monospace;
    font-size: 1.5rem;
    overflow: hidden;
    white-space: nowrap;
}

.animated-brand .letter {
    opacity: 0;
    display: inline-block;
    transform: translateY(0.5em);
    animation: typewriter-letter 4s infinite;
    animation-fill-mode: forwards;
}

@keyframes typewriter-letter {
    0% {
        opacity: 0;
        transform: translateY(0.5em);
    }
    10% {
        opacity: 1;
        transform: translateY(0);
    }
    90% {
        opacity: 1;
        transform: translateY(0);
    }
    100% {
        opacity: 0;
        transform: translateY(-0.5em);
    }
}
/* Sidebar styling */
.main-sidebar {
    border-radius: 6px 60px 60px 6px !important; /* TL TR BR BL */
    overflow: hidden;
    position: relative;
    z-index: 1;
}

/* Adjust child elements to respect border radius */
.brand-link {
    border-radius: 10px 50px 0 0 !important;
}

.sidebar {
    border-radius: 0 0 60px 5px !important;
}

.logout-section {
    border-radius: 0 0 50px 10px !important;
}

/* Adjust menu items to match curvature */
.nav-link {
    border-radius: 8px 20px 20px 8px !important;
}

.nav-link:hover {
    border-radius: 12px 25px 25px 12px !important;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .main-sidebar {
        border-radius: 0 25px 25px 0 !important;
    }
    
    .brand-link,
    .sidebar {
        border-radius: 0 !important;
    }
}
<div class="animated-brand" id="brand-text"></div>


</style>
<!-- JavaScript for animation and SweetAlert -->
<script>


function animateBrandText() {
    const brand = document.querySelector('.animated-brand');
    const text = brand.textContent.trim();
    brand.innerHTML = ''; // Clear previous content

    text.split('').forEach((letter, index) => {
        const span = document.createElement('span');
        span.textContent = letter;
        span.classList.add('letter');
        span.style.animationDelay = `${0.1 * index}s`;
        brand.appendChild(span);
    });
}

// Animate on load
document.addEventListener("DOMContentLoaded", () => {
    animateBrandText();

    // Loop the animation every 5 seconds
    setInterval(() => {
        animateBrandText();
    }, 5000);
});



    function confirmLogout() {
        Swal.fire({
            title: 'Confirm Logout',
            text: "Are you sure you want to logout?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout!',
            cancelButtonText: 'No, stay here'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('mylogin') }}";
            }
        });
    }
</script>
