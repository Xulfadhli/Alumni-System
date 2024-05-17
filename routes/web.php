<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//Admin -- Event route
Route::get('/admin/event-list', [\App\Http\Controllers\EventController::class, 'getEventList'])->name('admin.event-list');
Route::get('/admin/event-form', [\App\Http\Controllers\EventController::class, 'getEventForm'])->name('admin.event-form');
Route::post('/admin/add-event', [\App\Http\Controllers\EventController::class, 'postAddEvent'])->name('admin.add-event');
Route::get('/admin/edit-event-form/{id}', [\App\Http\Controllers\EventController::class, 'getEditEventForm'])->name('admin.edit-event-form');
Route::put('/admin/edit-event/{id}', [\App\Http\Controllers\EventController::class, 'putEditEvent'])->name('admin.edit-event');
Route::delete('/admin/delete-event/{id}', [\App\Http\Controllers\EventController::class, 'deleteEvent'])->name('admin.delete-event');

//User -- Event route
Route::get('/user/event-list', [\App\Http\Controllers\EventRegisterController::class, 'getEventList'])->name('user.event-list');
Route::get('/user/registration-form/{id}', [\App\Http\Controllers\EventRegisterController::class, 'getRegistrationForm'])->name('user.registration-form');
Route::post('/user/register-event', [\App\Http\Controllers\EventRegisterController::class, 'postRegisterEvent'])->name('user.register-event');

//Admin -- Donation route
Route::get('/admin/donation-list', [\App\Http\Controllers\DonationController::class, 'getDonationList'])->name('admin.donation-list');

//Admin -- Report route
Route::get('/admin/report-list', [\App\Http\Controllers\ReportController::class, 'getReportList'])->name('admin.report-list');

require __DIR__.'/auth.php';
