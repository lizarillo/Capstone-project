<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login History</title>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student Login History</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Program</th>
                                            <th>Registered Date</th>
                                            <th>Last Login</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Mock-up Data for Display Only -->
                                        <tr>
                                            <td>1</td>
                                            <td>2021001</td>
                                            <td>Juan</td>
                                            <td>Dela Cruz</td>
                                            <td>BSIT</td>
                                            <td>2022-08-15</td>
                                            <td>2025-05-28 14:32</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2021002</td>
                                            <td>Maria</td>
                                            <td>Santos</td>
                                            <td>BSCS</td>
                                            <td>2022-08-16</td>
                                            <td>2025-05-28 09:20</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2021003</td>
                                            <td>Carlos</td>
                                            <td>Reyes</td>
                                            <td>BSIT</td>
                                            <td>2022-09-01</td>
                                            <td>2025-05-27 16:10</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>2021004</td>
                                            <td>Ana</td>
                                            <td>Lopez</td>
                                            <td>BSIS</td>
                                            <td>2022-09-05</td>
                                            <td>2025-05-26 11:45</td>
                                        </tr>
                                        <!-- Add more rows as needed -->
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
            $('#example2').DataTable();
        });
    </script>
</body>
</html>
