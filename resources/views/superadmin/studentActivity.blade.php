@extends('superadmin.layout')

@section('content')
<div class="content-wrapper" style="margin-top: 60px;">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">All Student Submissions</h3>
                        </div>
                        <div class="card-body">
                            <table id="allSubmissions" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Student ID</th>
                                        <th>Full Name</th>
                                        <th>Submission Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Sample data for all submissions
                                        $submissions = [
                                            ['id' => '2021001', 'name' => 'Juan Dela Cruz', 'date' => '2025-05-01', 'status' => 'Approved'],
                                            ['id' => '2021002', 'name' => 'Maria Santos', 'date' => '2025-05-02', 'status' => 'Pending'],
                                            ['id' => '2021003', 'name' => 'Carlos Reyes', 'date' => '2025-05-03', 'status' => 'Declined'],
                                            ['id' => '2021004', 'name' => 'Ana Lopez', 'date' => '2025-05-04', 'status' => 'Approved'],
                                            ['id' => '2021001', 'name' => 'Juan Dela Cruz', 'date' => '2025-05-05', 'status' => 'Pending'],
                                            ['id' => '2021005', 'name' => 'Pedro Garcia', 'date' => '2025-05-06', 'status' => 'Late'],
                                            ['id' => '2021006', 'name' => 'Luz Delgado', 'date' => '2025-05-07', 'status' => 'Approved'],
                                            ['id' => '2021002', 'name' => 'Maria Santos', 'date' => '2025-05-08', 'status' => 'Approved'],
                                            ['id' => '2021007', 'name' => 'Ramon Santos', 'date' => '2025-05-09', 'status' => 'Declined'],
                                            ['id' => '2021008', 'name' => 'Elena Torres', 'date' => '2025-05-10', 'status' => 'Pending'],
                                            // Add more data as needed
                                        ];
                                    @endphp

                                    @foreach ($submissions as $index => $sub)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $sub['id'] }}</td>
                                            <td>{{ $sub['name'] }}</td>
                                            <td>{{ $sub['date'] }}</td>
                                            <td>
                                                @php
                                                    $statusClass = match(strtolower($sub['status'])) {
                                                        'approved' => 'badge bg-success',
                                                        'pending' => 'badge bg-warning text-dark',
                                                        'declined' => 'badge bg-danger',
                                                        'late' => 'badge bg-secondary',
                                                        default => 'badge bg-info'
                                                    };
                                                @endphp
                                                <span class="{{ $statusClass }}">{{ $sub['status'] }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Optional summary or analytics can go here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
    $(document).ready(function () {
        $('#allSubmissions').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'Export to PDF',
                    title: 'All Student Submissions',
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
            order: [[3, 'desc']], // Order by submission date descending
            pageLength: 10
        });
    });
</script>
@endsection
