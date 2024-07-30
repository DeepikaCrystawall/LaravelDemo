<?php
namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Bus;
use App\Models\User;

class EmailBatchController extends Controller
{
    public function dispatchBatch()
    {
        $users = User::all();

        $batch = Bus::batch(
            $users->map(function ($user) {
                return new SendEmailJob($user);
            })
        )->then(function ($batch) {
            \Log::info('Batch completed successfully');
        })->catch(function ($batch, $exception) {
            \Log::error('Batch failed', ['exception' => $exception]);
        })->finally(function ($batch) {
            \Log::info('Batch finalization');
        })->dispatch();

        return 'Batch dispatched!';
    }
}
