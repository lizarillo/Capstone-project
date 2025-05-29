<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Requests</title>
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
                                <h5 class="mb-4"> List of Approved Requests</h5>
                                <div class="table-responsive">
                                    <table id="approvedTable" class="table table-bordered table-hover">
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
                                                <td>STU2025002</td>
                                                <td>Maria Santos</td>
                                                <td>BSBA</td>
                                                <td>Certificate of Good Moral (COG)</td>
                                                <td>2025-05-26</td>
                                                <td><span class="badge bg-success">Approved</span></td>
                                                <td>2025-05-29</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025005</td>
                                                <td>John Torres</td>
                                                <td>BSED</td>
                                                <td>Certificate of Registration (COR)</td>
                                                <td>2025-05-23</td>
                                                <td><span class="badge bg-success">Approved</span></td>
                                                <td>2025-05-28</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025009</td>
                                                <td>Angela Lim</td>
                                                <td>BSIT</td>
                                                <td>Certificate of Enrollment (COE)</td>
                                                <td>2025-05-22</td>
                                                <td><span class="badge bg-success">Approved</span></td>
                                                <td>2025-05-27</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025010</td>
                                                <td>Gabriel Cruz</td>
                                                <td>BSCS</td>
                                                <td>Transcript of Records (TOR)</td>
                                                <td>2025-05-21</td>
                                                <td><span class="badge bg-success">Approved</span></td>
                                                <td>2025-05-26</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025011</td>
                                                <td>Catherine Diaz</td>
                                                <td>BSA</td>
                                                <td>Certificate of Registration (COR)</td>
                                                <td>2025-05-20</td>
                                                <td><span class="badge bg-success">Approved</span></td>
                                                <td>2025-05-25</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025012</td>
                                                <td>Mark Dizon</td>
                                                <td>BSED</td>
                                                <td>Certificate of Good Moral (COG)</td>
                                                <td>2025-05-19</td>
                                                <td><span class="badge bg-success">Approved</span></td>
                                                <td>2025-05-24</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025013</td>
                                                <td>Patricia Uy</td>
                                                <td>BSBA</td>
                                                <td>Transcript of Records (TOR)</td>
                                                <td>2025-05-18</td>
                                                <td><span class="badge bg-success">Approved</span></td>
                                                <td>2025-05-23</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025014</td>
                                                <td>Kevin Navarro</td>
                                                <td>BSIT</td>
                                                <td>Certificate of Registration (COR)</td>
                                                <td>2025-05-17</td>
                                                <td><span class="badge bg-success">Approved</span></td>
                                                <td>2025-05-22</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025015</td>
                                                <td>Ella Ramos</td>
                                                <td>BSCS</td>
                                                <td>Certificate of Good Moral (COG)</td>
                                                <td>2025-05-16</td>
                                                <td><span class="badge bg-success">Approved</span></td>
                                                <td>2025-05-21</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025016</td>
                                                <td>Jomar Vega</td>
                                                <td>BSA</td>
                                                <td>Certificate of Enrollment (COE)</td>
                                                <td>2025-05-15</td>
                                                <td><span class="badge bg-success">Approved</span></td>
                                                <td>2025-05-20</td>
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
            $('#approvedTable').DataTable();
        });
    </script>
</body>
</html>
