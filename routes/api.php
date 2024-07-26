<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\TicketController;
   
// Route::controller(RegisterController::class)->group(function(){
//     Route::post('register', 'register');
//     Route::post('login', 'login');
// });
Route::group([],function(){
    Route::post('register',[RegisterController::class, 'register']);
    Route::post('login', [RegisterController::class,'login']);
});
Route::middleware('auth:sanctum')->group( function () {
     Route::resource('ticket', TicketController::class);
});


?>