@extends('admin.layouts')

@section('content')
<div class="container mt-4">
    <!-- Filters -->
    <form method="GET" action="{{ route('documents.index') }}" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by last name" value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('documents.create') }}" class="btn btn-success">
                + New Entry
            </a>
        </div>
    </form>

    <!-- Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Documents</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>{{ $document->firstname }} {{ $document->lastname }}</td>
                <td>{{ $document->email }}</td>
                <td>
                    @foreach(json_decode($document->documents) ?? [] as $doc)
                        <span class="badge bg-secondary">{{ $doc }}</span>
                    @endforeach
                </td>
                <td>
                    <span class="badge {{ $document->status === 'Approved' ? 'bg-success' : 'bg-warning' }}">
                        {{ $document->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{ route('documents.export', $document->id) }}" class="btn btn-sm btn-success">Export PDF</a>
                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this document?')">Delete</button>
                    </form>
                </td>

                <!-- Display status with label -->
                <td>
    <span class="badge bg-{{ $document->status === \App\Enums\DocumentStatus::Approved ? 'success' : 'warning' }}">
        {{ $document->status->label() }}
    </span>
</td>

<select name="status" class="form-select">
    @foreach(\App\Enums\DocumentStatus::cases() as $status)
    <option value="{{ $status->value }}" {{ $document->status === $status->value ? 'selected' : '' }}>
        {{ $status->label() }}
    </option>
    @endforeach
</select>

            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $documents->appends(request()->query())->links() }}
    </div>
</div>
@endsection
