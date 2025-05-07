<!-- resources/views/documents/pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents List</title>
</head>
<body>
    <h1>Documents List</h1>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Program</th>
                <th>Institution</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{ $document->first_name }}</td>
                    <td>{{ $document->last_name }}</td>
                    <td>{{ $document->program }}</td>
                    <td>{{ $document->institution }}</td>
                    <td>{{ $document->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
