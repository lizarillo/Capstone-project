<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Document Submission</title>
    <link rel="icon" href="{{ asset('img/dssc_logo_official.png') }}" type="image/png" />

   <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <!-- jsPDF and jsPDF-AutoTable for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
                                <h3 class="card-title">Document Submission</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Document Type</th>
                                            <th>Date Submitted</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                            <th style="width: 220px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Mock-up Data with 10 rows -->
                                        <tr>
                                            <td>1</td>
                                            <td>2021001</td>
                                            <td>Juan</td>
                                            <td>Dela Cruz</td>
                                            <td>juan.delacruz@gmail.com</td>
                                            <td>Enrollment Form</td>
                                            <td>2025-05-25</td>
                                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                                            <td>Waiting for approval</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary flex-grow-1">View</button>
                                                    <button class="btn btn-sm btn-success flex-grow-1">Approve</button>
                                                    <button class="btn btn-sm btn-danger flex-grow-1">Decline</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2021002</td>
                                            <td>Maria</td>
                                            <td>Santos</td>
                                            <td>maria.santos@gmail.com</td>
                                            <td>Transcript of Records</td>
                                            <td>2025-05-26</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                            <td>Verified and approved</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary flex-grow-1">View</button>
                                                    <button class="btn btn-sm btn-success flex-grow-1" disabled>Approve</button>
                                                    <button class="btn btn-sm btn-danger flex-grow-1">Decline</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2021003</td>
                                            <td>Carlos</td>
                                            <td>Reyes</td>
                                            <td>carlos.reyes@gmail.com</td>
                                            <td>Good Moral Certificate</td>
                                            <td>2025-05-27</td>
                                            <td><span class="badge bg-danger">Declined</span></td>
                                            <td>Document incomplete</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary flex-grow-1">View</button>
                                                    <button class="btn btn-sm btn-success flex-grow-1">Approve</button>
                                                    <button class="btn btn-sm btn-danger flex-grow-1" disabled>Decline</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>2021004</td>
                                            <td>Ana</td>
                                            <td>Lopez</td>
                                            <td>ana.lopez@gmail.com</td>
                                            <td>Certificate of Residency</td>
                                            <td>2025-05-24</td>
                                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                                            <td>Incomplete fields</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary flex-grow-1">View</button>
                                                    <button class="btn btn-sm btn-success flex-grow-1">Approve</button>
                                                    <button class="btn btn-sm btn-danger flex-grow-1">Decline</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>2021005</td>
                                            <td>Pedro</td>
                                            <td>Garcia</td>
                                            <td>pedro.garcia@gmail.com</td>
                                            <td>Enrollment Form</td>
                                            <td>2025-05-23</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                            <td>Verified and approved</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary flex-grow-1">View</button>
                                                    <button class="btn btn-sm btn-success flex-grow-1" disabled>Approve</button>
                                                    <button class="btn btn-sm btn-danger flex-grow-1">Decline</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>2021006</td>
                                            <td>Luz</td>
                                            <td>Delgado</td>
                                            <td>luz.delgado@gmail.com</td>
                                            <td>Transcript of Records</td>
                                            <td>2025-05-22</td>
                                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                                            <td>Waiting for approval</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary flex-grow-1">View</button>
                                                    <button class="btn btn-sm btn-success flex-grow-1">Approve</button>
                                                    <button class="btn btn-sm btn-danger flex-grow-1">Decline</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>2021007</td>
                                            <td>Ramon</td>
                                            <td>Santos</td>
                                            <td>ramon.santos@gmail.com</td>
                                            <td>Good Moral Certificate</td>
                                            <td>2025-05-21</td>
                                            <td><span class="badge bg-danger">Declined</span></td>
                                            <td>Invalid document</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary flex-grow-1">View</button>
                                                    <button class="btn btn-sm btn-success flex-grow-1">Approve</button>
                                                    <button class="btn btn-sm btn-danger flex-grow-1" disabled>Decline</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>2021008</td>
                                            <td>Elena</td>
                                            <td>Torres</td>
                                            <td>elena.torres@gmail.com</td>
                                            <td>Certificate of Residency</td>
                                            <td>2025-05-20</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                            <td>Verified and approved</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary flex-grow-1">View</button>
                                                    <button class="btn btn-sm btn-success flex-grow-1" disabled>Approve</button>
                                                    <button class="btn btn-sm btn-danger flex-grow-1">Decline</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>2021009</td>
                                            <td>Mario</td>
                                            <td>Fernandez</td>
                                            <td>mario.fernandez@gmail.com</td>
                                            <td>Enrollment Form</td>
                                            <td>2025-05-19</td>
                                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                                            <td>Waiting for approval</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary flex-grow-1">View</button>
                                                    <button class="btn btn-sm btn-success flex-grow-1">Approve</button>
                                                    <button class="btn btn-sm btn-danger flex-grow-1">Decline</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>2021010</td>
                                            <td>Gloria</td>
                                            <td>Marquez</td>
                                            <td>gloria.marquez@gmail.com</td>
                                            <td>Transcript of Records</td>
                                            <td>2025-05-18</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                            <td>Verified and approved</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary flex-grow-1">View</button>
                                                    <button class="btn btn-sm btn-success flex-grow-1" disabled>Approve</button>
                                                    <button class="btn btn-sm btn-danger flex-grow-1">Decline</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function () {
            $('#example2').DataTable({
                "order": [[ 0, "asc" ]],  // Order by No. ascending by default
                "pageLength": 5 // Optional: show 5 rows per page (you can adjust)
            });
        });

         $(document).ready(function () {
            $('#example2').DataTable({
                dom: 'Bfrtip',  // Needed for buttons placement
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF',
                        title: 'Student Document Submission',
                        exportOptions: {
                            columns: ':visible:not(:last-child)' // Export all columns except last Actions column
                        },
                        orientation: 'landscape',
                        pageSize: 'A4',
                        customize: function (doc) {
                            doc.styles.tableHeader.fillColor = '#007bff'; // Bootstrap primary color header
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
