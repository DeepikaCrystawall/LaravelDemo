<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/ticket',TicketController::class);
Route::post('/ticket/{id}/toggle-status', [TicketController::class, 'toggleStatus'])->name('ticket.toggleStatus');
 Route::get('/reply/{ticketid}',[TicketController::class,'replyticket'])->name('reply');
 Route::post('/replyupdate',[TicketController::class,'replyupdate'])->name('replyupdate');
