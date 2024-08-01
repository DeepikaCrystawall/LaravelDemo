<!DOCTYPE html>
<html>
<head>
    <title>Test Results</title>
</head>
<body>
    <h1>Test Results</h1>

    <h2>JUnit XML Results</h2>
   

    @if(isset($testCases) && !empty($testCases))
        <table border="1">
            <thead>
                <tr>
                    <th>Test Case</th>
                    <th>Status</th>
                    <th>File</th>
                    <th>Line</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($testCases as $testCase)
                    <tr>
                        <td>{{ $testCase['name'] }}</td>
                        <td>{{ $testCase['status'] }}</td>
                        <td>{{ $testCase['file'] }}</td>
                        <td>{{ $testCase['line'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No test cases found or the XML format is invalid.</p>
    @endif
</body>
</html>
