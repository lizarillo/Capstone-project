<!DOCTYPE html>
<html lang="en">
<head>
      <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     

    <style>
        .main-content {
            margin-left: 250px; /* Match sidebar width */
            padding: 20px;
            margin-top: 70px; /* Adjust based on header height */
        }
        
        .modal {
            z-index: 1060 !important; /* Higher than sidebar z-index */
        }
        
        .modal-dialog {
            max-width: 90%;
            margin: 1.75rem auto;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .modal-content {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .modal-backdrop {
            z-index: 1040 !important;
        }
    </style>

</head>
<body>
    @extends('superadmin.layout')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Registered Users Section -->
            <div class="row mt-5 mb-4">
                <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mt-3">Registered Administrators</h5>
                    <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        Add Administrator
                    </button>
                </div>

                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table id="userTable" class="table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($admins as $user)
                                            @if(in_array($user->role, ['admin', 'superadmin']))
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td><span class="badge bg-primary">{{ ucfirst($user->role) }}</span></td>
                                                    <td>
                                                        @if(strtolower($user->status) === 'active')
                                                            <span class="badge bg-success">Active</span>
                                                            <div class="text-muted small">
                                                                Last active: {{ $user->last_active_at?->diffForHumans() ?? 'N/A' }}
                                                            </div>
                                                        @else
                                                            <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $user->id }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Modals for each user -->
                                                <!-- View Modal -->
                                                <div class="modal fade" id="viewModal{{ $user->id }}">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">User Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <dl class="row">
                                                                    <dt class="col-sm-4">Full Name</dt>
                                                                    <dd class="col-sm-8">{{ $user->firstname }} {{ $user->lastname }}</dd>
                                                                    <dt class="col-sm-4">Email</dt>
                                                                    <dd class="col-sm-8">{{ $user->email }}</dd>
                                                                    <dt class="col-sm-4">Role</dt>
                                                                    <dd class="col-sm-8">{{ ucfirst($user->role) }}</dd>
                                                                    <dt class="col-sm-4">Status</dt>
                                                                    <dd class="col-sm-8">
                                                                        @if($user->status == 'active')
                                                                            <span class="badge bg-success">Active</span>
                                                                        @else
                                                                            <span class="badge bg-danger">Inactive</span>
                                                                        @endif
                                                                    </dd>
                                                                    <dt class="col-sm-4">Last Activity</dt>
                                                                    <dd class="col-sm-8">{{ $user->last_active_at?->format('M d, Y H:i') ?? 'N/A' }}</dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal{{ $user->id }}">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ route('superadmin.users.update', $user->id) }}">
                                                                @csrf @method('PUT')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit User</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label>First Name</label>
                                                                        <input type="text" name="firstname" 
                                                                            class="form-control" value="{{ $user->firstname }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label>Last Name</label>
                                                                        <input type="text" name="lastname" 
                                                                            class="form-control" value="{{ $user->lastname }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label>Email</label>
                                                                        <input type="email" name="email" 
                                                                            class="form-control" value="{{ $user->email }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label>Role</label>
                                                                        <select name="role" class="form-select" required>
                                                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                            <option value="superadmin" {{ $user->role == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal{{ $user->id }}">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ route('superadmin.users.destroy', $user->id) }}">
                                                                @csrf @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="lead">Are you sure you want to delete:</p>
                                                                    <p class="h5 mb-3">{{ $user->firstname }} {{ $user->lastname }}</p>
                                                                    <p class="text-danger small">This action cannot be undone!</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4">No administrators found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Login History Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6>Login History</h6>
                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#archivedUsersModal">
                            <i class="fas fa-archive"></i> Archived Users
                        </button>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="loginHistoryTable" class="table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($loginLogs as $log)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div>{{ $log->user->firstname }} {{ $log->user->lastname }}</div>
                                                <div class="text-muted small">{{ $log->user->email }}</div>
                                            </td>
                                            <td>
                                                @if($log->action === 'login')
                                                    <span class="text-success"><i class="fas fa-sign-in-alt"></i> Login</span>
                                                @else
                                                    <span class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($log->success)
                                                    <span class="badge bg-success">Success</span>
                                                @else
                                                    <span class="badge bg-danger">Failed</span>
                                                @endif
                                            </td>
                                            <td>{{ $log->created_at->format('M d, Y H:i:s') }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">No login records found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       
        <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <form method="POST" action="{{ route('superadmin.admin.store') }}" id="addUserForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Create New Administrator</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 border-end">
                                    <div class="mb-3">
                                        <label>First Name</label>
                                        <input type="text" name="firstname" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input type="text" name="lastname" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Role</label>
                                        <select name="role" class="form-select" required>
                                            <option value="admin">Admin</option>
                                            <option value="superadmin">Super Admin</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="profilePreview" class="text-center">
                                        <i class="fas fa-user fa-5x text-muted mb-3"></i>
                                        <h4 class="previewName">New Administrator</h4>
                                        <p class="text-muted previewRole"></p>
                                        <dl class="row text-start mt-4">
                                            <dt class="col-sm-4">Email</dt>
                                            <dd class="col-sm-8 previewEmail"></dd>
                                            <dt class="col-sm-4">Status</dt>
                                            <dd class="col-sm-8"><span class="badge bg-success">Active</span></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Create User</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

         <!-- Archived Users Modal -->
        <div class="modal fade" id="archivedUsersModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Archived Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <table id="archivedUsersTable" class="table table-hover w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Deleted At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($archivedAdmins as $user)
                                <tr>
                                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>{{ $user->deleted_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('superadmin.users.restore', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
        // Initialize DataTables
        $('#userTable, #loginHistoryTable, #archivedUsersTable').DataTable({
            responsive: true,
            paging: true,
            ordering: true,
            info: true,
            order: [[0, 'asc']]
        });

        // Real-time form preview
        $('#addUserForm input, #addUserForm select').on('input change', function() {
            const formData = {
                firstname: $('input[name="firstname"]').val(),
                lastname: $('input[name="lastname"]').val(),
                email: $('input[name="email"]').val(),
                role: $('select[name="role"]').val()
            };

            $('.previewName').text(`${formData.firstname} ${formData.lastname}`);
            $('.previewRole').text(formData.role);
            $('.previewEmail').text(formData.email);
        });

        // Handle edit modal
        $('.editUserBtn').click(function() {
            const userData = $(this).data('user');
            $('#editUserForm input[name="firstname"]').val(userData.firstname);
            $('#editUserForm input[name="lastname"]').val(userData.lastname);
            $('#editUserForm input[name="email"]').val(userData.email);
            $('#editUserForm select[name="role"]').val(userData.role);
        });
});
</script>
@endsection