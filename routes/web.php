<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TimezoneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AccountSettingController;
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
    Route::post('employees.getStateByCountry', [EmployeeController::class, 'getStateByCountry'])->name('employees.getStateByCountry');

    //Role & Permissions
    Route::resource('roles', RoleController::class);
    Route::get('roles.getRole/{id}', [RoleController::class, 'getRole'])->name('roles.getRole');
    Route::patch('roles.updateRole/{id}', [RoleController::class, 'updateRole'])->name('roles.updateRole');
    Route::post('roles.syncRolePermission', [RoleController::class, 'syncRolePermission'])->name('roles.syncRolePermission');

    //Designations
    Route::resource('designations', DesignationController::class);

    //Customer Sources
    Route::resource('customer-sources', CustomerSourceController::class);

    //Customer Businesses
    Route::resource('customer-businesses', CustomerBusinessController::class);

    //Currencies
    Route::resource('currencies', CurrencyController::class);

    //Languages
    Route::resource('languages', LanguageController::class);

    //Timezones
    Route::resource('timezones', TimezoneController::class);

    //admin-Settings
    Route::get('admin-settings', [AdminSettingController::class, 'index'])->name('admin-settings');
    Route::get('admin-settings.getVerticalMenu', [AdminSettingController::class, 'getVerticalMenu'])->name('admin-settings.getVerticalMenu');
    Route::post('admin-settings.saveVerticalMenu', [AdminSettingController::class, 'saveVerticalMenu'])->name('admin-settings.saveVerticalMenu');
    Route::get('admin-settings.getHorizontalMenu', [AdminSettingController::class, 'getHorizontalMenu'])->name('admin-settings.getHorizontalMenu');
    Route::post('admin-settings.saveHorizontalMenu', [AdminSettingController::class, 'saveHorizontalMenu'])->name('admin-settings.saveHorizontalMenu');

    //account-Settings
    //account
    Route::get('account-settings/account', [AccountSettingController::class, 'account'])->name('account-settings.account');
    Route::post('account-settings.saveAccount', [AccountSettingController::class, 'saveAccount'])->name('account-settings.saveAccount');
    Route::get('account-settings/security', [AccountSettingController::class, 'security'])->name('account-settings.security');
    Route::post('account-settings.getStateByCountry', [AccountSettingController::class, 'getStateByCountry'])->name('account-settings.getStateByCountry');
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
