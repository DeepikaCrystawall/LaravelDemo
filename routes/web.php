<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['admin'])->group(function () {
        Route::resource('/ticket', TicketController::class);
        Route::post('/ticket/{id}/toggle-status', [TicketController::class, 'toggleStatus'])->name('ticket.toggleStatus');
        Route::get('/reply/{ticketid}', [TicketController::class, 'replyticket'])->name('reply');
        Route::post('/replyupdate', [TicketController::class, 'replyupdate'])->name('replyupdate');
        Route::get('/ticketlisting', [TicketController::class, 'ticketlisting'])->name('ticketlist');

        Route::resource('/users', UserController::class);
        Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('delete');
    });

    Route::middleware(['user'])->group(function () {
        Route::resource('/ticket', TicketController::class)->except(['destroy']);
        Route::get('/ticketlisting', [TicketController::class, 'ticketlisting'])->name('ticketlist');
        Route::get('/reply/{ticketid}', [TicketController::class, 'replyticket'])->name('reply');
    });

    // Ensure /ticket and /ticket/create are accessible to both roles
    Route::resource('/ticket', TicketController::class)->only(['index', 'create']);
});
