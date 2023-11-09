<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\RolePageController;
use App\Http\Controllers\TicketPageController;
// models
use App\Http\Controllers\UserPageController;
use Domain\Ticket\Models\Ticket;
use Domain\User\Models\Role;
// controllers
use Domain\User\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::model('user', User::class);
Route::model('role', Role::class);
Route::model('ticket', Ticket::class);
//fallback
Route::fallback(function () {
    return Inertia::render('Welcome');
});

// Artisan
Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    dd('Cache is cleared');
});

// GEL website route list
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/track', function () {
    return Inertia::render('Ticket/Track', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('track');

Route::post('/status', [TicketPageController::class, 'status'])
    ->name('ticket.status');

Route::post('/ticket', [TicketPageController::class, 'store'])
    ->name('ticket.page.store');

// Login as user
Route::get('/user/{user}/login-as-user', [UserPageController::class, 'loginAsUser'])
    ->name('user.page.login-as-user');

// GEL admin panel route list
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::post(
        '/vapor/signed-storage-url',
        [\App\Http\Controllers\SignedStorageUrlController::class, 'store']
    );

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // User domain page routes

    // Users
    Route::get('/user', [UserPageController::class, 'index'])
        ->name('user.page.index')->middleware('permission:View user');
    Route::get('/user/create', [UserPageController::class, 'create'])
        ->name('user.page.create');

    Route::post('/user', [UserController::class, 'store'])->name('user.store');

    Route::post('/user', [UserPageController::class, 'store'])
        ->name('user.page.store');
    Route::get('/user/{user}/edit', [UserPageController::class, 'edit'])
        ->name('user.page.edit');
    Route::get('/user/{user}/show', [UserPageController::class, 'show'])
        ->name('user.page.show');
    Route::get('/user/{user}/log', [UserPageController::class, 'logShow'])
        ->name('user.page.log');
    Route::put('/user/{user}/admin-change-password', [UserPageController::class, 'adminChangePassword'])
        ->name('user.page.adminChangePassword');
    Route::put('/user/{user}/update', [UserPageController::class, 'update'])
        ->name('user.page.update');
    Route::delete('/user/{user}/destroy', [UserPageController::class, 'destroy'])
        ->name('user.page.destroy');
    Route::delete('/user/{user}/image/destroy', [UserPageController::class, 'imageDestroy'])
        ->name('user.page.image.delete');
    Route::get('/user/pdf', [UserPageController::class, 'generatePDF'])
        ->name('user.page.pdf');

    // Ticket domain page routes
    Route::get('/ticket', [TicketPageController::class, 'index'])
        ->name('ticket');
    Route::put('/ticket', [TicketPageController::class, 'update'])
        ->name('ticket.page.update');
    Route::delete('/ticket', [TicketPageController::class, 'destroy'])
        ->name('ticket.page.destroy');
    Route::get('/ticket/resolved-ticket-index', [TicketPageController::class, 'resolvedTicketIndex'])
        ->name('ticket.page.resolvedTicketIndex');
    Route::patch('/ticket/{ticketId}/restore', [TicketPageController::class, 'restore'])
        ->name('ticket.page.restore');
    Route::post('/ticket/reply', [TicketPageController::class, 'sendReply'])
        ->name('ticket.page.reply');

    // Roles
    Route::get('/role', [RolePageController::class, 'index'])
        ->name('role.page.index');
    Route::get('/role/create', [RolePageController::class, 'create'])
        ->name('role.page.create');
    Route::post('/role', [RolePageController::class, 'store'])
        ->name('role.page.store');
    Route::get('/role/{role}/edit', [RolePageController::class, 'edit'])
        ->name('role.page.edit');
    Route::put('/role/{role}/update', [RolePageController::class, 'update'])
        ->name('role.page.update');
    Route::delete('/role/{role}/destroy', [RolePageController::class, 'destroy'])
        ->name('role.page.destroy');

});
