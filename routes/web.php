<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CustomerSourceController;
use App\Http\Controllers\CustomerBusinessController;

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
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

// Route::middleware('auth')->group(function () {
    //Dashboard
    Route::resource('dashboard', DashboardController::class);

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Employees
    Route::resource('employees', EmployeeController::class);

    //Role & Permissions
    Route::resource('roles', RoleController::class);
    Route::get('roles.getRole/{id}', [RoleController::class, 'getRole'])->name('roles.getRole');
    Route::patch('roles.updateRole/{id}', [RoleController::class, 'updateRole'])->name('roles.updateRole');

    //Designations
    Route::resource('designations', DesignationController::class);

    //Customer
    Route::resource('customer-sources', CustomerSourceController::class);

    //Customer
    Route::resource('customer-businesses', CustomerBusinessController::class);

    //Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::get('settings.getVerticalMenu', [SettingController::class, 'getVerticalMenu'])->name('settings.getVerticalMenu');
    Route::post('settings.saveVerticalMenu', [SettingController::class, 'saveVerticalMenu'])->name('settings.saveVerticalMenu');
    Route::get('settings.getHorizontalMenu', [SettingController::class, 'getHorizontalMenu'])->name('settings.getHorizontalMenu');
    Route::post('settings.saveHorizontalMenu', [SettingController::class, 'saveHorizontalMenu'])->name('settings.saveHorizontalMenu');
// });








//dfgdfjhgfjkhgkjdfhg kdfgdfgdfg
/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
}); */
