<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Report</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example2').DataTable();
        });
    </script>
</head>
<body>
    <!-- Header -->
    @include('admin.layouts')

    <!-- Content Wrapper -->
   <!-- Content Wrapper -->
<div class="content-wrapper" style="margin-top: 60px;">


        <!-- Page Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
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
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($user as $row)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row->firstname }}</td>
        <td>{{ $row->lastname }}</td>
        <td>{{ $row->email }}</td>
        <td>{{ $row->role }}</td>
        <td>{{ $row->created_at->format('Y-m-d H:i') }}</td>
    </tr>
@empty
    <tr><td colspan="6">No Data Available</td></tr>
@endforelse

                                    </tbody>
                                </table>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div> <!-- /.container-fluid -->
        </section>
    </div>
</body>
</html>
