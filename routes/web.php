<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
// Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');

// Route::post('/authenticate',[LoginController::class,'authenticate'])->name('authenticate');
// Route::post('logout',[LoginController::class,'logout'])->name('logout');


Route::middleware(['admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

     Route::resource('/ticket',TicketController::class);
     Route::post('/ticket/{id}/toggle-status', [TicketController::class, 'toggleStatus'])->name('ticket.toggleStatus');
     Route::get('/reply/{ticketid}',[TicketController::class,'replyticket'])->name('reply');
     Route::post('/replyupdate',[TicketController::class,'replyupdate'])->name('replyupdate');  
     Route::get('/ticketlisting', [TicketController::class, 'ticketlisting'])->name('ticketlist');

     Route::resource('/users', '\App\Http\Controllers\UserController');
     Route::get('/users/delete/{id}', '\App\Http\Controllers\UserController@delete')->name('delete');
});
Route::middleware(['user'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/ticket',TicketController::class);
    // Route::post('/ticket/{id}/toggle-status', [TicketController::class, 'toggleStatus'])->name('ticket.toggleStatus');
    // Route::get('/reply/{ticketid}',[TicketController::class,'replyticket'])->name('reply');
    // Route::post('/replyupdate',[TicketController::class,'replyupdate'])->name('replyupdate');
    Route::get('/ticketlisting', [TicketController::class, 'ticketlisting'])->name('ticketlist');
});







// Route to display the list of tickets
// Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');

// // Route to show the form for creating a new ticket
// Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');

// // Route to store a newly created ticket
// Route::post('/ticket', [TicketController::class, 'store'])->name('ticket.store');
// Route::get('/ticket/{ticket}', [TicketController::class, 'show'])->name('ticket.show');

// // Route to show the form for editing a specific ticket
// Route::get('/ticket/{ticket}/edit', [TicketController::class, 'edit'])->name('ticket.edit');

//     // Route to delete a specific ticket
//     Route::delete('/ticket/{ticket}', [TicketController::class, 'destroy'])->name('ticket.destroy');

//     // Route to update a specific ticket
//     Route::patch('/ticket/{ticket}', [TicketController::class, 'update'])->name('ticket.update');
