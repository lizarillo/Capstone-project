<!DOCTYPE html>
<html>
<head>
    <title>Analytics Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 1rem; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Analytics Summary</h2>
    <p><strong>Total Submitted:</strong> {{ $totalSubmitted }}</p>
    <p><strong>Total Unsubmitted:</strong> {{ $totalUnsubmitted }}</p>
    <p><strong>Total Pending:</strong> {{ $totalPending }}</p>

    <h3>Submissions per Institution</h3>
    <table>
        <thead>
            <tr>
                <th>Institution</th>
                <th>Submitted</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submissionsPerInstitution as $institution => $count)
                <tr>
                    <td>{{ $institution }}</td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
