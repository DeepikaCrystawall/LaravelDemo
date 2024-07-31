<!DOCTYPE html>
<html>
<head>
    <title>Test Case Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .passed { color: green; }
        .failed { color: red; }
        .skipped { color: orange; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Test Case Results</h1>
        <a href="{{ route('run.tests') }}" class="btn btn-primary mb-3">Run Tests</a>
        <div class="test-results">
            @if(!empty($errorOutput))
                <div class="alert alert-danger">
                    <h4>Error Output</h4>
                    <pre>{{ $errorOutput }}</pre>
                </div>
            @endif

            @if(empty($testResults))
                <p>No test results to display.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Test Case</th>
                            <th>Status</th>
                            <!-- <th>Message</th>
                            <th>Time</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($testResults as $test)
                            <tr>
                                <td>{{$test['name']}}</td>
                                <td>{{$test['status']}}</td>
                              
                                <td>{{$test['time']}}</td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>