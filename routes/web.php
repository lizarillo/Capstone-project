<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SuperAdminController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes(['verify' => true]);

Route::get('/', fn() => view('Authentication.register'));

// Registration & Login
Route::get('/register', [AuthenticationController::class, 'ShowRegistration'])->name('myRegistration');
Route::post('/register', [AuthenticationController::class, 'processRegistration'])->name('registerUser');

Route::get('/login', [AuthenticationController::class, 'showLoginPage'])->name('mylogin');
Route::post('/login', [AuthenticationController::class, 'loginProcess'])->name('loginUser');

// Logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('mylogin');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (Requires Authentication + Email Verification)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboards
    
    Route::get('/admin/dashboard', [AdminController::class,'showAdminDashboard'])->name('admin.dashboard');
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'showSuperAdmin'])->name('superadmin.dashboard');

    // Profile Management

    Route::get('/admin/profile/edit', [AdminController::class, 'editProfile'])->name('admin.profileEdit');

    Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');


    // Admin Reports / Logs
    Route::get('/admin/reports', [AdminController::class, 'showAdminList'])->name('reports.admin');
    

/*
    |--------------------------------------------------------------------------
    | Document Management
    |--------------------------------------------------------------------------
    */
    Route::resource('documents', DocumentController::class);
    Route::get('/documents/pdf', [DocumentController::class, 'exportPdf'])->name('documents.pdf');
    Route::patch('/documents/{document}/approve', [DocumentController::class, 'approve'])->name('documents.approve');
    Route::patch('/documents/{document}/status', [DocumentController::class, 'updateStatus'])->name('documents.updateStatus');

    // Alternative redirects
    Route::get('/listOfDocuments', fn() => redirect()->route('documents.index'));
    Route::get('/listDocuments', [DocumentController::class, 'index'])->name('listDocuments');


     // SuperAdminDashboards

     Route::get('/superadmin/dashboard', [SuperAdminController::class, 'showSuperAdmin'])->name('superadmin.dashboard');
     Route::get('/superadmin/admin-roles', [SuperAdminController::class, 'adminRoles'])->name('superadmin.adminroles');
     Route::get('/superadmin/student-submission', [SuperAdminController::class, 'studentSubmission'])
         ->name('superadmin.studentSubmission');
  
    // For showing the edit profile form
Route::get('/profile/edit', [SuperAdminController::class, 'edit'])->name('superadmin.edit');

// For updating the profile (must be POST or PUT)
Route::post('/profile/update', [SuperAdminController::class, 'update'])->name('superadmin.update');











});
