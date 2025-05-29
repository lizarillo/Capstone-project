<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity | Report</title>
    <link rel="icon" href="{{ asset('img/dssc_logo_official.png') }}" type="image/png">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .status-select.active {
            color: green;
            font-weight: bold;
        }
        .status-select.inactive {
            color: red;
            font-weight: bold;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#example2').DataTable();
            document.querySelectorAll('.status-select').forEach(el => setStatusColor(el));
        });

        function setStatusColor(selectElement) {
            selectElement.classList.remove('active', 'inactive');
            const selectedValue = selectElement.value.toLowerCase();
            selectElement.classList.add(selectedValue);
        }
    </script>
</head>
<body>
    @include('admin.layouts')

    <div class="content-wrapper" style="margin-top: 60px;">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Registered Admin</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($admins as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->firstname }}</td>
                                                <td>{{ $row->lastname }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>{{ $row->role }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $row->status == 'Active' ? 'success' : 'secondary' }}">
                                                        {{ $row->status ?? 'Active' }}
                                                    </span>
                                                </td>
                                                <td>{{ optional($row->created_at)->format('Y-m-d H:i') ?? 'N/A' }}</td>

                                                <td>
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $row->id }}">View</button>
                                                </td>
                                            </tr>

                                            <!-- View Modal -->
                                            <div class="modal fade" id="viewModal{{ $row->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $row->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewModalLabel{{ $row->id }}">Admin Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>First Name:</strong> {{ $row->firstname }}</p>
                                                            <p><strong>Last Name:</strong> {{ $row->lastname }}</p>
                                                            <p><strong>Email:</strong> {{ $row->email }}</p>
                                                            <p><strong>Role:</strong> {{ $row->role }}</p>
                                                            <p><strong>Status:</strong> {{ $row->status ?? 'Active' }}</p>
                                                            <p><strong>Created Date:</strong> {{ optional($row->created_at)->format('Y-m-d H:i') ?? 'N/A' }}</p>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No Data Available</td>
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
    </div>
</body>
</html>
