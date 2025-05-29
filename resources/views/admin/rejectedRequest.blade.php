<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unclaimed Requests</title>
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
                                <h5 class="mb-4">List of Unclaimed Requests</h5>
                                <div class="table-responsive">
                                    <table id="rejectedTable" class="table table-bordered table-hover">
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
                                                <td>STU2025003</td>
                                                <td>Carlos Reyes</td>
                                                <td>BSCS</td>
                                                <td>Certificate of Registration (COR)</td>
                                                <td>2025-05-25</td>
                                                <td><span class="badge bg-danger">Unclaimed</span></td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025017</td>
                                                <td>Marvin Castro</td>
                                                <td>BSED</td>
                                                <td>Transcript of Records (TOR)</td>
                                                <td>2025-05-20</td>
                                                <td><span class="badge bg-danger">Unclaimed</span></td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025018</td>
                                                <td>Kim Alvarado</td>
                                                <td>BSBA</td>
                                                <td>Certificate of Good Moral (COG)</td>
                                                <td>2025-05-19</td>
                                                <td><span class="badge bg-danger">Unclaimed</span></td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025019</td>
                                                <td>Rica Fernandez</td>
                                                <td>BSIT</td>
                                                <td>Certificate of Enrollment (COE)</td>
                                                <td>2025-05-18</td>
                                                <td><span class="badge bg-danger">Unclaimed</span></td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025020</td>
                                                <td>Joshua Lim</td>
                                                <td>BSCS</td>
                                                <td>Certificate of Registration (COR)</td>
                                                <td>2025-05-17</td>
                                                <td><span class="badge bg-danger">Unclaimed</span></td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025021</td>
                                                <td>Lara Mendoza</td>
                                                <td>BSA</td>
                                                <td>Transcript of Records (TOR)</td>
                                                <td>2025-05-16</td>
                                                <td><span class="badge bg-danger">Unclaimed</span></td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025022</td>
                                                <td>Eric Santos</td>
                                                <td>BSBA</td>
                                                <td>Certificate of Good Moral (COG)</td>
                                                <td>2025-05-15</td>
                                                <td><span class="badge bg-danger">Unclaimed</span></td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025023</td>
                                                <td>Joan Villanueva</td>
                                                <td>BSIT</td>
                                                <td>Certificate of Enrollment (COE)</td>
                                                <td>2025-05-14</td>
                                                <td><span class="badge bg-danger">Unclaimed</span></td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025024</td>
                                                <td>Leo Garcia</td>
                                                <td>BSED</td>
                                                <td>Certificate of Registration (COR)</td>
                                                <td>2025-05-13</td>
                                                <td><span class="badge bg-danger">Unclaimed</span></td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>STU2025025</td>
                                                <td>Nina Robles</td>
                                                <td>BSCS</td>
                                                <td>Certificate of Good Moral (COG)</td>
                                                <td>2025-05-12</td>
                                                <td><span class="badge bg-danger">Unclaimed</span></td>
                                                <td>N/A</td>
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
            $('#rejectedTable').DataTable();
        });
    </script>
</body>
</html>
