<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Requests</title>
    <link rel="icon" href="{{ asset('img/dssc_logo_official.png') }}" type="image/png">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    @include('admin.layouts')

    <div class="content-wrapper" style="margin-top: 60px;">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card compact-card">
                            <div class="card-body">
                                <h5 class="mb-4">List of Pending Requests</h5>
                                <div class="table-responsive">
                                    <table id="pendingTable" class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Full Name</th>
                                                <th>Program</th>
                                                <th>Requested Document</th>
                                                <th>Request Date</th>
                                                <th>Status</th>
                                                <th>Possible Release Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>STU2025001</td>
                                                <td>Juan Dela Cruz</td>
                                                <td>BSIT</td>
                                                <td>Certificate of Registration (COR)</td>
                                                <td>2025-05-27</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>2025-05-30</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025004</td>
                                                <td>Ana Lopez</td>
                                                <td>BSIT</td>
                                                <td>Certificate of Good Moral (COG)</td>
                                                <td>2025-05-24</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>2025-05-31</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025006</td>
                                                <td>Eliza Monteverde</td>
                                                <td>BSA</td>
                                                <td>Transcript of Records (TOR)</td>
                                                <td>2025-05-28</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>2025-06-02</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025007</td>
                                                <td>Ronald Rivera</td>
                                                <td>BSCS</td>
                                                <td>Certificate of Enrollment (COE)</td>
                                                <td>2025-05-26</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>2025-05-31</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025008</td>
                                                <td>Jennylyn Cruz</td>
                                                <td>BSBA</td>
                                                <td>Certificate of Registration (COR)</td>
                                                <td>2025-05-25</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>2025-05-30</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function () {
            $('#pendingTable').DataTable();
        });
    </script>
</body>
</html>
