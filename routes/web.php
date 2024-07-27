<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleLoginController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmailBatchController;

Route::get('/dispatch-emails', [EmailBatchController::class, 'dispatchBatch']);
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return redirect('/home');
});
 
 
Auth::routes();
Route::controller(GithubController::class)->group(function(){
    Route::get('auth/github', 'redirectToGithub')->name('auth.github');
    Route::get('auth/github/callback', 'handleGithubCallback');
});
 
// GoogleLoginController redirect and callback urls
Route::controller(GoogleLoginController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});
 
Route::get('/admin',function(){
    return view('admin-theme.dashboard');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/blogs', [BlogController::class, 'index'])->name('blog_list');
Route::get('/productlist', [HomeController::class, 'products'])->name('productlist');
Route::get('product-details/{id}', [HomeController::class, 'products_details']);
Route::get('/blog/{id}', [App\Http\Controllers\BlogController::class, 'show'])->name('show_blog');
Route::get('category/{id}', [HomeController::class, 'products_with_category']);


Route::get('/contact-us', [HomeController::class, 'contactus'])->name('contact-us');
Route::post('/add-contact',[HomeController::class,'addContact'])->name('addcontact');
Route::middleware(['auth'])->group(function () {
 
    Route::middleware(['admin'])->group(function () {

        Route::resource('/ticket', TicketController::class);
        Route::post('/ticket/{id}/toggle-status', [TicketController::class, 'toggleStatus'])->name('ticket.toggleStatus');
        Route::get('/reply/{ticketid}', [TicketController::class, 'replyticket'])->name('reply');
        Route::post('/replyupdate', [TicketController::class, 'replyupdate'])->name('replyupdate');
        Route::get('/ticketlisting', [TicketController::class, 'ticketlisting'])->name('ticketlist');
 
        Route::resource('/users', UserController::class);
        Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('delete');
 
        Route::resource('/posts', 'App\Http\Controllers\PostController');
        Route::get('posts/{id}/delete','App\Http\Controllers\PostController@destroy');
 
        Route::get('/posts/{post}/publish','App\Http\Controllers\PostController@publish');
       
        Route::resource('/category', CategoryController::class);
        Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
 
        Route::resource('/products', ProductController::class);
        Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('delete');
       
 
    });
 
    Route::middleware(['user'])->group(function () {
        Route::resource('/ticket', TicketController::class)->except(['destroy']);
        Route::get('/ticketlisting', [TicketController::class, 'ticketlisting'])->name('ticketlist');
       
    });
    Route::get('/reply/{ticketid}', [TicketController::class, 'replyticket'])->name('reply');
    // Ensure /ticket and /ticket/create are accessible to both roles
    Route::resource('/ticket', TicketController::class);
    //  Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog_list');
    Route::resource('/dashboard', DashboardController::class);
 

    
});
 
 
// Route::get('/auth/redirect', function () {
//     return Socialite::driver('github')
//     ->scopes(['read:user', 'public_repo'])
//     ->redirect();
// });
 
// Route::get('/auth/callback', function () {
//     $githubUser = Socialite::driver('github')->user();
 
//     $user = User::updateOrCreate([
//         'github_id' => $githubUser->id,
//     ], [
//         'name' => $githubUser->name,
//         'email' => $githubUser->email,
//         'github_token' => $githubUser->token,
//         'github_refresh_token' => $githubUser->refreshToken,
//     ]);
 
//     Auth::login($user);
//  dd($user);
//     return redirect('/home');
// });
 