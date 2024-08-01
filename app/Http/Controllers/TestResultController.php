<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Storage;

class TestResultController extends Controller
{
    //
    public function index()
    {
        // Fetch the stored test results from the session or database
        $testResults = session('testResults', []);

        return view('test-results', compact('testResults'));
    }
    function readPhpunitXml()
    {
        $xmlFilePath = storage_path('logs/phpunit.xml');
    
        if (!file_exists($xmlFilePath)) {
            throw new \Exception("XML file not found at: $xmlFilePath");
        }
    
        $xmlContent = file_get_contents($xmlFilePath);
        $xml = simplexml_load_string($xmlContent);
    
        if ($xml === false) {
            throw new \Exception("Failed to parse XML file.");
        }
        // Example: Extracting basic test results
        $test_res =[];

        function extractTestCaseDetails($testSuite, &$testCases)
    {
        // Check if there are test cases in the current test suite
        if (isset($testSuite->testcase)) {
            foreach ($testSuite->testcase as $testcase) {
                $testCases[] = [
                    'name' => (string) $testcase['name'],
                    'status' => isset($testcase['failure']) ? 'Failed' : 'Passed',
                    'message' => isset($testcase['failure']) ? (string) $testcase['failure'] : '',
                    'time' => (string) $testcase['time']
                ];
            }
    }
    if (isset($testSuite->testsuite)) {
        foreach ($testSuite->testsuite as $nestedSuite) {
            extractTestCaseDetails($nestedSuite, $testCases);
        }
    }
}
    extractTestCaseDetails($xml, $testCases);
       
        // print_r($test_res); exit;
        return view('test-results', ['testResults' => $testCases]);
    }
    
    public function showResults()
    {
        try {
            $testResults = readPhpunitXml();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return view('test-results', ['testResults' => $testResults]);
    }
    public function runTests()
    {
        // Run the PHPUnit tests using the Symfony Process component
        $process = new Process(['vendor/bin/phpunit']);
        $process->setWorkingDirectory(base_path());
        $process->run();

        // Handle the process result
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Store the test results in the session or database
        $output = $process->getOutput();
        session(['testResults' => $output]);

        return redirect()->route('test.results');
    }

    public function showResults1()
    {
        $xmlFile = storage_path('logs/phpunit.xml');
        $xml = simplexml_load_file($xmlFile);

       
        $testCases = $this->extractTestCases($xml);
       // dd($testCases);
        return view('test-results1', ['testCases' => $testCases]);

       // return view('test-results1', ['xml' => $xml]);
    }

    private function extractTestCases($xml)
    {
        $testCases = [];

        // Helper function to extract test cases from a testsuite
        $extractFromSuite = function ($suite) use (&$testCases, &$extractFromSuite) {
            foreach ($suite->testsuite as $innerSuite) {
                $extractFromSuite($innerSuite);
            }

            foreach ($suite->testcase as $case) {
                $testCases[] = [
                    'name' => (string) $case['name'],
                    'status' => $case->failure ? 'Failed' : ($case->error ? 'Error' : 'Passed'),
                    'file' => (string) $case['file'],
                    'line' => (string) $case['line']
                ];
            }
        };

        $extractFromSuite($xml);

        return $testCases;
    }
}
