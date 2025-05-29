@extends('admin.layouts')

@section('content')
<style>
    .compact-card {
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease-in-out;
    }

    .compact-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        font-size: 1.8rem;
        opacity: 0.8;
        margin-bottom: 0.5rem;
    }

    .small-stat {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .analytics-chart {
        height: 300px;
        margin: 1rem 0;
    }

    .status-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
    }

    .list-group-item {
        border-radius: 8px!important;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        padding: 1rem;
        border: none;
        background-color: #f8f9fa;
    }

    .chart-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .date-filter-btn {
        background: #f8f9fa;
        border-radius: 6px;
        padding: 0.25rem 0.75rem;
        font-size: 0.9rem;
        border: 1px solid #dee2e6;
        margin: 0 2px;
        cursor: pointer;
    }

    .date-filter-btn.active {
        background: #e9ecef;
        border-color: #ced4da;
    }

    .badge-soft {
        padding: 0.35em 0.65em;
        border-radius: 8px;
    }

    .small-column {
        padding: 0.5rem;
        font-size: 0.9rem;
    }

    .chart-container {
        height: 250px;
    }
</style>

<div class="content-wrapper" style="padding-top: 70px;">
    <section class="content">
        <div class="container-fluid">
            <!-- Stats Row -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="compact-card bg-warning text-white">
                        <i class="fas fa-file-upload stat-icon"></i>
                        <div class="small-stat">75</div>
                        <div class="text-uppercase small font-weight-500">Pending Documents</div>
                        <div class="text-xs opacity-75 mt-1">+4% last month</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="compact-card bg-success text-white">
                        <i class="fas fa-check-circle stat-icon"></i>
                        <div class="small-stat">357</div>
                        <div class="text-uppercase small font-weight-500">Approved Documents</div>
                        <div class="text-xs opacity-75 mt-1">+12% last month</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="compact-card bg-danger text-white">
                        <i class="fas fa-times-circle stat-icon"></i>
                        <div class="small-stat">65</div>
                        <div class="text-uppercase small font-weight-500">Declined Documents</div>
                        <div class="text-xs opacity-75 mt-1">-5% last month</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="compact-card bg-info text-white">
                        <i class="fas fa-users stat-icon"></i>
                        <div class="small-stat">{{ $GetName }}</div>
                        <div class="text-uppercase small font-weight-500">Student Registrations</div>
                        <div class="text-xs opacity-75 mt-1">+8% last month</div>
                    </div>
                </div>
            </div>

            <!-- Document Analytics -->
            <div class="row mt-4">
                <div class="col-md-9">
                    <div class="card compact-card">
                        <div class="card-body">
                            <div class="chart-toolbar">
                                <h5 class="mb-0">Document Analytics</h5>
                                <div>
                                      <button class="date-filter-btn active">Document Types</button>
                                </div>
                            </div>
                             <canvas class="analytics-chart" id="docTypeChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 d-flex flex-column gap-3">
                    <!-- Document Status -->
                    <div class="card compact-card">
                        <div class="card-body">
                            <h5 class="mb-4">Document Status</h5>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <span class="status-dot bg-success"></span>
                                    Approved
                                    <span class="ms-auto badge bg-success-soft badge-soft">357</span>
                                </div>
                                <div class="list-group-item">
                                    <span class="status-dot bg-danger"></span>
                                    Declined
                                    <span class="ms-auto badge bg-danger-soft badge-soft">65</span>
                                </div>
                                <div class="list-group-item">
                                    <span class="status-dot bg-warning"></span>
                                    Pending
                                    <span class="ms-auto badge bg-warning-soft badge-soft">75</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Student Submissions -->
                    <div class="card compact-card">
                        <div class="card-body">
                            <h5 class="mb-4">Student Submissions</h5>
                            <div class="list-group">
                                <div class="list-group-item small-column">
                                    <span class="status-dot bg-primary"></span>
                                    Total Students
                                    <span class="ms-auto badge bg-primary-soft badge-soft">150</span>
                                </div>
                                <div class="list-group-item small-column">
                                    <span class="status-dot bg-success"></span>
                                    Submitted
                                    <span class="ms-auto badge bg-success-soft badge-soft">120</span>
                                </div>
                                <div class="list-group-item small-column">
                                    <span class="status-dot bg-danger"></span>
                                    Pending
                                    <span class="ms-auto badge bg-danger-soft badge-soft">25</span>
                                </div>
                                <div class="list-group-item small-column">
                                    <span class="status-dot bg-warning"></span>
                                    Late Submission
                                    <span class="ms-auto badge bg-warning-soft badge-soft">5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Login History -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card compact-card">
                        <div class="card-body">
                            <h5 class="mb-4">Student Login History</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Program</th>
                                            <th>Registered Date</th>
                                            <th>Last Login</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>STU2025001</td>
                                            <td>Juan</td>
                                            <td>Dela Cruz</td>
                                            <td>BSIT</td>
                                            <td>2025-01-10</td>
                                            <td>2025-05-28 08:23 AM</td>
                                        </tr>
                                        <tr>
                                            <td>STU2025002</td>
                                            <td>Maria</td>
                                            <td>Santos</td>
                                            <td>BSBA</td>
                                            <td>2025-02-03</td>
                                            <td>2025-05-27 04:15 PM</td>
                                        </tr>
                                        <tr>
                                            <td>STU2025003</td>
                                            <td>Carlos</td>
                                            <td>Reyes</td>
                                            <td>BSCS</td>
                                            <td>2025-01-22</td>
                                            <td>2025-05-26 10:11 AM</td>
                                        </tr>
                                        <tr>
                                            <td>STU2025004</td>
                                            <td>Ana</td>
                                            <td>Lopez</td>
                                            <td>BSIT</td>
                                            <td>2025-03-12</td>
                                            <td>2025-05-25 02:47 PM</td>
                                        </tr>
                                        <tr>
                                            <td>STU2025005</td>
                                            <td>John</td>
                                            <td>Torres</td>
                                            <td>BSED</td>
                                            <td>2025-02-18</td>
                                            <td>2025-05-28 09:00 AM</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            

                         <!-- Submission Count Per Student -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card compact-card">
            <div class="card-body">
                <h5 class="mb-4">Submission Count Per Student</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Program</th>
                                <th>Total Submissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>STU2025001</td>
                                <td>Juan Dela Cruz</td>
                                <td>BSIT</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>STU2025002</td>
                                <td>Maria Santos</td>
                                <td>BSBA</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>STU2025003</td>
                                <td>Carlos Reyes</td>
                                <td>BSCS</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>STU2025004</td>
                                <td>Ana Lopez</td>
                                <td>BSIT</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>STU2025005</td>
                                <td>John Torres</td>
                                <td>BSED</td>
                                <td>9</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


                             <div class="row mt-4">
                <div class="col-12">
                    <div class="card compact-card">
                        <div class="card-body">
                            <h5 class="mb-4">Document Request Table</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
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
                                            <td>STU2025002</td>
                                            <td>Maria Santos</td>
                                            <td>BSBA</td>
                                            <td>Certificate of Good Moral (COG)</td>
                                            <td>2025-05-26</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                            <td>2025-05-29</td>
                                        </tr>
                                        <tr>
                                            <td>STU2025003</td>
                                            <td>Carlos Reyes</td>
                                            <td>BSCS</td>
                                            <td>Certificate of Registration (COR)</td>
                                            <td>2025-05-25</td>
                                            <td><span class="badge bg-danger">Declined</span></td>
                                            <td>N/A</td>
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
                                            <td>STU2025005</td>
                                            <td>John Torres</td>
                                            <td>BSED</td>
                                            <td>Certificate of Registration (COR)</td>
                                            <td>2025-05-23</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                            <td>2025-05-28</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

  

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Document Analytics - Bar chart by document type (submitted vs unsubmitted)
    const docTypeData = {
        labels: ['PSA', 'Good Moral', 'Birth Certificate', 'TOR'],
        datasets: [
            {
                label: 'Submitted',
                data: [45, 38, 52, 60, 48],
                backgroundColor: '#4CAF50'
            },
            {
                label: 'Unsubmitted',
                data: [10, 12, 5, 7, 15],
                backgroundColor: '#F44336'
            }
        ]
    };

    new Chart(document.getElementById('docTypeChart'), {
        type: 'bar',
        data: docTypeData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Submissions'
                    }
                }
            }
        }
    });

    // Daily Submission Trends
    const dailyTrendData = {
        labels: ['May 24', 'May 25', 'May 26', 'May 27', 'May 28'],
        datasets: [{
            label: 'Submissions',
            data: [12, 19, 10, 14, 20],
            fill: false,
            borderColor: '#17a2b8',
            tension: 0.1
        }]
    };

    new Chart(document.getElementById('dailyTrendChart'), {
        type: 'line',
        data: dailyTrendData,
        options: {
            responsive: true
        }
    });

   

    new Chart(document.getElementById('requestDocChart'), {
        type: 'bar',
        data: requestDocData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Requests'
                    }
                }
            }
        }
    });
</script>

@endsection
