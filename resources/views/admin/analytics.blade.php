<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Analytics</title>
</head>
<body>
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
                        <div class="text-uppercase small font-weight-500">User Registrations</div>
                        <div class="text-xs opacity-75 mt-1">+8% last month</div>
                    </div>
                </div>
            </div>

            <!-- Analytics Section -->
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="card compact-card">
                        <div class="card-body">
                            <div class="chart-toolbar">
                                <h5 class="mb-0">Document Analytics</h5>
                                <div>
                                    <button class="date-filter-btn active" data-filter="day">Day</button>
                                    <button class="date-filter-btn" data-filter="week">Week</button>
                                    <button class="date-filter-btn" data-filter="month">Month</button>
                                    <button class="date-filter-btn" data-filter="year">Year</button>
                                </div>
                            </div>
                            <canvas class="analytics-chart" id="docChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card compact-card mb-4">
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
                        </div>

                        <div class="col-12">
                            <div class="card compact-card">
                                <div class="card-body">
                                    <h5 class="mb-4">Student Gender Distribution</h5>
                                    <div class="chart-container">
                                        <canvas id="genderChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card compact-card mb-4">
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

                        <div class="col-12">
                            <div class="card compact-card">
                                <div class="card-body">
                                    <h5 class="mb-4">Document Submissions by Day</h5>
                                    <div class="chart-container">
                                        <canvas id="dayChart"></canvas>
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
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const genderData = {
        labels: ['Male', 'Female'],
        datasets: [{
            data: [60, 90],
            backgroundColor: ['#36A2EB', '#FF6384'],
            hoverOffset: 4
        }]
    };

    new Chart(document.getElementById('genderChart'), {
        type: 'pie',
        data: genderData
    });

    const docData = {
        labels: ['Approved', 'Pending', 'Declined'],
        datasets: [{
            label: 'Document Status',
            data: [357, 75, 65],
            backgroundColor: ['#4CAF50', '#FFC107', '#F44336'],
        }]
    };

    new Chart(document.getElementById('docChart'), {
        type: 'bar',
        data: docData,
    });

    const dayData = {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
        datasets: [{
            label: 'Documents Submitted',
            data: [50, 30, 40, 60, 80],
            backgroundColor: '#FFC107',
        }]
    };

    new Chart(document.getElementById('dayChart'), {
        type: 'line',
        data: dayData,
    });
</script>





@endsection