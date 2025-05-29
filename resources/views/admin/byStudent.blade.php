<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Submission by Student</title>
    <link rel="icon" href="{{ asset('img/dssc_logo_official.png') }}" type="image/png" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
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
                                <h3 class="card-title">Submission by Student</h3>
                            </div>
                            <div class="card-body">
                                <table id="studentSubmissions" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student ID</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Total Submitted</th>
                                            <th>Approved</th>
                                            <th>Pending</th>
                                            <th>Declined</th>
                                            <th>Late</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $students = [
                                                ['id' => '2021001', 'name' => 'Juan Dela Cruz', 'email' => 'juan.delacruz@gmail.com', 'total' => 5, 'approved' => 3, 'pending' => 1, 'declined' => 1, 'late' => 0],
                                                ['id' => '2021002', 'name' => 'Maria Santos', 'email' => 'maria.santos@gmail.com', 'total' => 6, 'approved' => 4, 'pending' => 1, 'declined' => 1, 'late' => 0],
                                                ['id' => '2021003', 'name' => 'Carlos Reyes', 'email' => 'carlos.reyes@gmail.com', 'total' => 4, 'approved' => 2, 'pending' => 0, 'declined' => 1, 'late' => 1],
                                                ['id' => '2021004', 'name' => 'Ana Lopez', 'email' => 'ana.lopez@gmail.com', 'total' => 3, 'approved' => 1, 'pending' => 2, 'declined' => 0, 'late' => 0],
                                                ['id' => '2021005', 'name' => 'Pedro Garcia', 'email' => 'pedro.garcia@gmail.com', 'total' => 5, 'approved' => 3, 'pending' => 1, 'declined' => 1, 'late' => 0],
                                                ['id' => '2021006', 'name' => 'Luz Delgado', 'email' => 'luz.delgado@gmail.com', 'total' => 6, 'approved' => 4, 'pending' => 1, 'declined' => 1, 'late' => 0],
                                                ['id' => '2021007', 'name' => 'Ramon Santos', 'email' => 'ramon.santos@gmail.com', 'total' => 4, 'approved' => 1, 'pending' => 0, 'declined' => 2, 'late' => 1],
                                                ['id' => '2021008', 'name' => 'Elena Torres', 'email' => 'elena.torres@gmail.com', 'total' => 5, 'approved' => 5, 'pending' => 0, 'declined' => 0, 'late' => 0],
                                                ['id' => '2021009', 'name' => 'Mario Fernandez', 'email' => 'mario.fernandez@gmail.com', 'total' => 3, 'approved' => 1, 'pending' => 2, 'declined' => 0, 'late' => 0],
                                                ['id' => '2021010', 'name' => 'Gloria Marquez', 'email' => 'gloria.marquez@gmail.com', 'total' => 6, 'approved' => 4, 'pending' => 1, 'declined' => 1, 'late' => 0],
                                            ];
                                        @endphp

                                        @foreach ($students as $index => $student)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $student['id'] }}</td>
                                                <td>{{ $student['name'] }}</td>
                                                <td>{{ $student['email'] }}</td>
                                                <td>{{ $student['total'] }}</td>
                                                <td>{{ $student['approved'] }}</td>
                                                <td>{{ $student['pending'] }}</td>
                                                <td>{{ $student['declined'] }}</td>
                                                <td>{{ $student['late'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Summary Analytics -->
                                <div class="mt-4">
                                    <h5>Submission Analytics</h5>
                                    <table class="table table-bordered w-50">
                                        <tr><th>Total Students</th><td>150</td></tr>
                                        <tr><th>Submitted</th><td>120</td></tr>
                                        <tr><th>Pending</th><td>25</td></tr>
                                        <tr><th>Late Submission</th><td>5</td></tr>
                                    </table>
                                </div>

                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#studentSubmissions').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF',
                        title: 'Submission by Student',
                        exportOptions: {
                            columns: ':visible'
                        },
                        orientation: 'landscape',
                        pageSize: 'A4',
                        customize: function (doc) {
                            doc.styles.tableHeader.fillColor = '#007bff';
                        }
                    }
                ],
                order: [[0, "asc"]],
                pageLength: 5
            });
        });
    </script>
</body>
</html>
