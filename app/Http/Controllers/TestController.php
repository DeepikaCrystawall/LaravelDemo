<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show()
    {
        $resultsFile = storage_path('test-results.txt');

        // Read the results file
        $results = file_exists($resultsFile) ? file_get_contents($resultsFile) : 'No test results available.';

        return view('test.test-results', ['results' => $results]);
    }
}
