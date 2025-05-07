@include('admin.index')

<div class="container-fluid py-4 d-flex flex-column min-vh-100 justify-content-center">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="card shadow-sm mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Search Section -->
                    <div class="mb-4 border p-3 rounded bg-light">
                        <h5 class="mb-3 text-center text-dark">Search Documents</h5>
                        <form method="GET" action="{{ route('documents.index') }}" class="row g-2 justify-content-center">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control form-control-sm text-center" 
                                       placeholder="Search by ID or Name" value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="document_type" class="form-select form-select-sm text-center">
                                    <option value="">All Types</option>
                                    <option value="report_card" {{ request('document_type')=='report_card'?'selected':'' }}>Report Card</option>
                                    <option value="birth_certificate" {{ request('document_type')=='birth_certificate'?'selected':'' }}>Birth Certificate</option>
                                    <option value="recommendation_letter" {{ request('document_type')=='recommendation_letter'?'selected':'' }}>Recommendation Letter</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex flex-wrap justify-content-center gap-2">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-search me-1"></i> Search
                                </button>
                                <a href="{{ route('documents.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-sync me-1"></i> Reset
                                </a>
                                <a href="{{ route('documents.pdf') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-pdf me-1"></i> Export PDF
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Documents Table -->
                    <div class="table-responsive rounded-3 mb-4">
                        <table id="documents-table" class="table table-hover table-bordered align-middle text-center mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Student ID</th>
                                    <th>Type</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Program</th>
                                    <th>Institution</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($documents as $document)
                                    <tr>
                                        <td>DOC-{{ str_pad($document->id,5,'0',STR_PAD_LEFT) }}</td>
                                        <td>STU-{{ str_pad($document->student_id,6,'0',STR_PAD_LEFT) }}</td>
                                        <td>
                                            <span class="badge rounded-pill bg-info bg-opacity-25 text-info">
                                                {{ ucwords(str_replace('_',' ',$document->document_type)) }}
                                            </span>
                                        </td>
                                        <td>{{ $document->first_name }}</td>
                                        <td>{{ $document->last_name }}</td>
                                        <td>{{ $document->program }}</td>
                                        <td>{{ $document->institution }}</td>
                                        <td>{{ $document->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge rounded-pill {{ $document->status=='approved'?'bg-success':'bg-warning' }}">
                                                {{ ucfirst($document->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <!-- action buttons -->
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="py-4">No documents found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $documents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Center and constrain main container */
    .container-fluid {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Card styling */
    .card {
        border-radius: 0.75rem;
    }
    .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem;
    }

    /* Search box */
    .border.p-3 {
        max-width: 800px;
        width: 100%;
        margin: 0 auto 2rem;
    }

    /* Table centering & sizing */
    .table-responsive {
        max-width: 100%;
        margin: 0 auto 2rem;
        overflow-x: auto;
    }
    .table {
        font-size: 0.9rem;
        width: auto;
        margin: 0 auto;
    }
    .table th, .table td {
        vertical-align: middle !important;
        text-align: center;
    }

    /* Buttons */
    .btn-sm {
        min-width: 85px;
    }

    /* Pagination */
    .pagination {
        justify-content: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .col-md-3, .col-md-4 {
            width: 100%;
            margin-bottom: 1rem;
        }
        .table-responsive {
            padding: 0 10px;
        }
        .btn-sm {
            width: 100%;
            margin-bottom: 0.5rem;
        }
    }
</style>
@endsection

@section('scripts')
<!-- your existing scripts -->
@endsection
