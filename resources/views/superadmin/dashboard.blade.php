@extends('superadmin.layout')

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
                <!-- Cards for stats -->
                <div class="col-lg-3 col-6">
                    <div class="compact-card bg-primary text-white">
                        <i class="fas fa-university stat-icon"></i>
                        <div class="small-stat">{{ $totalInstitutions }}</div>
                        <div class="text-uppercase small font-weight-500">Total Institutions</div>
                        <div class="text-xs opacity-75 mt-1">+5% last quarter</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="compact-card bg-success text-white">
                        <i class="fas fa-users stat-icon"></i>
                        <div class="small-stat">{{ $registeredStudents }}</div>
                        <div class="text-uppercase small font-weight-500">Registered Students</div>
                        <div class="text-xs opacity-75 mt-1">+15% last month</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="compact-card bg-warning text-white">
                        <i class="fas fa-user-shield stat-icon"></i>
                        <div class="small-stat">{{ $registeredAdmins }}</div>
                        <div class="text-uppercase small font-weight-500">System Admins</div>
                        <div class="text-xs opacity-75 mt-1">+2 new admins</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="compact-card bg-info text-white">
                        <i class="fas fa-file-alt stat-icon"></i>
                        <div class="small-stat">{{ $submittedCount }}</div>
                        <div class="text-uppercase small font-weight-500">Total Submissions</div>
                        <div class="text-xs opacity-75 mt-1">+24% last week</div>
                    </div>
                </div>
            </div>

            <!-- Analytics and Table Section -->
            <div class="row mt-4">
                <div class="col-md-8">
                    <!-- Institution Analytics -->
                    <div class="card compact-card">
                        <div class="card-body">
                            <div class="chart-toolbar">
                                <h5 class="mb-0">Institution Analytics</h5>
                                <div>
                                    <button class="date-filter-btn active" data-filter="day">Day</button>
                                    <button class="date-filter-btn" data-filter="week">Week</button>
                                    <button class="date-filter-btn" data-filter="month">Month</button>
                                    <button class="date-filter-btn" data-filter="year">Year</button>
                                </div>
                            </div>
                            <canvas class="analytics-chart" id="instChart"></canvas>
                        </div>
                    </div>

                  @php use Illuminate\Support\Str; @endphp

<!-- Admin Login History -->
<div class="card compact-card mt-4">
    <div class="card-body">
        <h5 class="mb-3"><i class="fas fa-history me-2"></i>Admin Login History</h5>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Admin ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Login Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($adminLoginHistory as $login)
    <tr>
        <td>{{ $login->admin_id }}</td>
        <td>{{ $login->firstname ?? '' }} {{ $login->lastname ?? '' }}</td>



        <td>{{ $login->email }}</td>
        <td>
            <span class="badge {{ $login->is_active ? 'bg-success' : 'bg-secondary' }}">
                {{ $login->is_active ? 'Active' : 'Inactive' }}
            </span>
        </td>
        <td>{{ $login->ip_address ?? 'N/A' }}</td>
        <td>
            <span title="{{ $login->user_agent }}">
                {{ Str::limit($login->user_agent, 50) }}
            </span>
        </td>
        <td>{{ \Carbon\Carbon::parse($login->created_at)->format('M d, Y h:i A') }}</td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center">No login history found.</td>
    </tr>
@endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>


                    <!-- Student Login History (directly below Admin) -->
                    <div class="card compact-card mt-4">
                        <div class="card-body">
                            <h5 class="mb-3"><i class="fas fa-user-clock me-2"></i>Student Login History</h5>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Login Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($studentLoginHistory as $login)
                                        <tr>
                                            <td>{{ $login->student_id }}</td>
                                            <td>{{ $login->first_name }} {{ $login->last_name }}</td>
                                            <td>{{ $login->course }}</td>
                                            <td>{{ \Carbon\Carbon::parse($login->login_at)->format('M d, Y h:i A') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-md-8 -->

                <div class="col-md-4">
                    <!-- Institution Pie -->
                    <div class="card compact-card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">Institution Distribution</h5>
                            <div class="chart-container">
                                <canvas id="instPieChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Submission Status -->
                    <div class="card compact-card">
                        <div class="card-body">
                            <h5 class="mb-4">Submission Status</h5>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <span class="status-dot bg-success"></span>
                                    Submitted
                                    <span class="ms-auto badge bg-success-soft badge-soft">{{ $submittedCount }}</span>
                                </div>
                                <div class="list-group-item">
                                    <span class="status-dot bg-warning"></span>
                                    Pending
                                    <span class="ms-auto badge bg-warning-soft badge-soft">{{ $pendingCount }}</span>
                                </div>
                                <div class="list-group-item">
                                    <span class="status-dot bg-danger"></span>
                                    Unsubmitted
                                    <span class="ms-auto badge bg-danger-soft badge-soft">{{ $unsubmittedCount }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Timeline -->
                    <div class="card compact-card mt-4">
                        <div class="card-body">
                            <h5 class="mb-4">Activity Timeline</h5>
                            <div class="chart-container">
                                <canvas id="activityChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-md-4 -->
            </div> <!-- end row -->
        </div> <!-- end container-fluid -->
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Institution Chart
    new Chart(document.getElementById('instChart'), {
        type: 'bar',
        data: {
            labels: ['ICET', 'IBEG', 'IARS', 'ITED', 'IMAS'],
            datasets: [{
                label: 'Total Submissions',
                data: [{{ $institutionStats['ICET'] }}, {{ $institutionStats['IBEG'] }}, {{ $institutionStats['IARS'] }}, {{ $institutionStats['ITED'] }}, {{ $institutionStats['IMAS'] }}],
                backgroundColor: '#36A2EB'
            }]
        }
    });

    // Institution Pie Chart
    new Chart(document.getElementById('instPieChart'), {
        type: 'pie',
        data: {
            labels: ['ICET', 'IBEG', 'IARS', 'ITED', 'IMAS'],
            datasets: [{
                data: [{{ $institutionStats['ICET'] }}, {{ $institutionStats['IBEG'] }}, {{ $institutionStats['IARS'] }}, {{ $institutionStats['ITED'] }}, {{ $institutionStats['IMAS'] }}],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
            }]
        }
    });

    // Activity Timeline Chart
    new Chart(document.getElementById('activityChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'System Activity',
                data: [65, 59, 80, 81, 56, 55],
                borderColor: '#4CAF50',
                tension: 0.4
            }]
        }
    });
</script>
@endsection
