<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\TestResultController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmailBatchController;
use App\Http\Controllers\TestController;

Route::get('/dispatch-emails', [EmailBatchController::class, 'dispatchBatch']);
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return redirect('/home');
});
 
 

Route::get('/test-results', [TestController::class, 'show'])->name('test.results');
Route::get('/test-results1', [TestResultController::class, 'showResults1'])->name('test.results1');

Auth::routes();

// GithubController redirect and callback urls
Route::controller(GithubController::class)->group(function(){
    Route::get('auth/github', 'redirectToGithub')->name('auth.github');
    Route::get('auth/github/callback', 'handleGithubCallback');
});
 
// GoogleLoginController redirect and callback urls
Route::controller(GoogleLoginController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});
 
Route::get('/admin',function(){
    return view('admin-theme.dashboard');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
// Blogs Routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blog_list');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('show_blog');
Route::get('/productlist', [HomeController::class, 'products'])->name('productlist');
Route::get('product-details/{id}', [HomeController::class, 'products_details']);
Route::get('category-products/{id}', [HomeController::class, 'products_with_category']);
Route::get('/user-login', [HomeController::class, 'user_login'])->name('user-login');
Route::get('/user-register', [HomeController::class, 'user_register'])->name('user-register');


Route::get('/test-results', [TestResultController::class, 'index'])->name('test.results');
Route::get('/run-tests', [TestResultController::class, 'readPhpunitXml'])->name('run.tests');
Route::get('/convert-xml-to-json', [TestResultController::class, 'convertXmlToJson']);


Route::get('/contact-us', [HomeController::class, 'contactus'])->name('contact-us');
Route::post('/add-contact',[HomeController::class,'addContact'])->name('addcontact');
Route::middleware(['auth'])->group(function () {
 
    Route::middleware(['admin'])->group(function () {

        Route::resource('/dashboard', DashboardController::class);
        Route::resource('/ticket', TicketController::class);
        Route::post('/ticket/{id}/toggle-status', [TicketController::class, 'toggleStatus'])->name('ticket.toggleStatus');
        Route::get('/reply/{ticketid}', [TicketController::class, 'replyticket'])->name('reply');
        Route::post('/replyupdate', [TicketController::class, 'replyupdate'])->name('replyupdate');
        Route::get('/ticketlisting', [TicketController::class, 'ticketlisting'])->name('ticketlist');
 
        Route::resource('/users', UserController::class);
 
        Route::resource('/posts', 'App\Http\Controllers\PostController');
        Route::get('posts/{id}/delete','App\Http\Controllers\PostController@destroy');
 
        Route::get('/posts/{post}/publish','App\Http\Controllers\PostController@publish');
       
        Route::resource('/category', CategoryController::class);
 
        Route::resource('/products', ProductController::class);
       
 
    });
 
    Route::middleware(['user'])->group(function () {
        // Route::resource('/ticket', TicketController::class)->except(['destroy']);
        Route::get('/ticketlisting', [TicketController::class, 'ticketlisting'])->name('ticketlist');

        
        // Route::get('/my-account', [HomeController::class, 'my_account'])->name('my-account');
        Route::get('/my-account', [HomeController::class, 'my_account'])->name('my-account');
        Route::get('/user-logout', [HomeController::class, 'user_logout'])->name('user-logout');
        Route::post('/profile-update', [HomeController::class, 'profile_update'])->name('profile-update');
        Route::post('/view-tickets', [HomeController::class, 'view_ticket'])->name('view-tickets');
      
        
       

       
    });
    Route::get('/reply/{ticketid}', [TicketController::class, 'replyticket'])->name('reply');
    // Ensure /ticket and /ticket/create are accessible to both roles
    Route::resource('/ticket', TicketController::class);
    //  Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog_list');
   
    
 

    
});
 