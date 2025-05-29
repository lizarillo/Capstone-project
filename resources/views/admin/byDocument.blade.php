@extends('admin.layouts')

@section('content')
<div class="content-wrapper" style="margin-top: 60px;">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Submission by Document</h3>
                        </div>
                        <div class="card-body">
                            @php
                                // Sample document submission data (you can replace with your actual query results)
                                $documents = [
                                    ['name' => 'PSA', 'total' => 120, 'approved' => 100, 'pending' => 10, 'declined' => 8, 'late' => 2],
                                    ['name' => 'Good Moral', 'total' => 110, 'approved' => 95, 'pending' => 8, 'declined' => 5, 'late' => 2],
                                    ['name' => 'Birth Certificate', 'total' => 115, 'approved' => 105, 'pending' => 6, 'declined' => 3, 'late' => 1],
                                    ['name' => 'TOR', 'total' => 100, 'approved' => 90, 'pending' => 5, 'declined' => 4, 'late' => 1],
                                    ['name' => 'Medical Certificate', 'total' => 80, 'approved' => 70, 'pending' => 6, 'declined' => 3, 'late' => 1],
                                ];
                            @endphp

                            <table id="documentSubmissions" class="table table-bordered table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No.</th>
                                        <th>Document Type</th>
                                        <th>Total Submitted</th>
                                        <th>Approved</th>
                                        <th>Pending</th>
                                        <th>Declined</th>
                                        <th>Late</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documents as $index => $doc)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $doc['name'] }}</td>
                                        <td>{{ $doc['total'] }}</td>
                                        <td>{{ $doc['approved'] }}</td>
                                        <td>{{ $doc['pending'] }}</td>
                                        <td>{{ $doc['declined'] }}</td>
                                        <td>{{ $doc['late'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            

                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Required JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables & Buttons -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
    $(document).ready(function () {
        $('#documentSubmissions').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'Export to PDF',
                    title: 'Submission by Document',
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
@endsection
