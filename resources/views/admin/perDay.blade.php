@extends('admin.layouts')

@section('content')
<div class="content-wrapper" style="margin-top: 60px;">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Submitted Per Day</h3>
                        </div>
                        <div class="card-body">
                            <table id="submissionPerDay" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Date</th>
                                        <th>Number of Submissions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $startDate = \Carbon\Carbon::today()->subDays(19);
                                        $rows = [];
                                        for ($i = 0; $i < 20; $i++) {
                                            $date = $startDate->copy()->addDays($i)->format('Y-m-d');
                                            $submissions = rand(5, 24);
                                            $rows[] = ['date' => $date, 'submissions' => $submissions];
                                        }

                                        $totalSubmissions = array_sum(array_column($rows, 'submissions'));
                                        $avgSubmissions = number_format($totalSubmissions / count($rows), 2);

                                        // Max and min submissions with dates
                                        $maxSubmissions = max(array_column($rows, 'submissions'));
                                        $minSubmissions = min(array_column($rows, 'submissions'));

                                        $maxDay = collect($rows)->firstWhere('submissions', $maxSubmissions)['date'];
                                        $minDay = collect($rows)->firstWhere('submissions', $minSubmissions)['date'];
                                    @endphp

                                    @foreach ($rows as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row['date'] }}</td>
                                        <td>{{ $row['submissions'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Improved Analytics Summary -->
                            <div class="mt-4 w-75">
                                <h5>Submission Analytics</h5>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <div class="card text-white bg-primary mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Total Days Recorded</h6>
                                                <p class="card-text fs-4">{{ count($rows) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card text-white bg-success mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Total Submissions</h6>
                                                <p class="card-text fs-4">{{ $totalSubmissions }}</p>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
    $(document).ready(function () {
        $('#submissionPerDay').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'Export to PDF',
                    title: 'Submitted Per Day',
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
