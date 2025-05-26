<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ForgotPasswordController;

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

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'showAdminDashboard'])->name('dashboard');

        // Profile Management
        Route::get('/profile/edit', [AdminController::class, 'editProfile'])->name('profileEdit');
        Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('updateProfile');




        // Reports
        Route::get('/reports', [AdminController::class, 'adminReports'])->name('reports');

        // Document Management (alternative access for admin if needed)
        Route::resource('documents', DocumentController::class)->only(['index', 'show']);
    });

   Route::prefix('superadmin')->name('superadmin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [SuperAdminController::class, 'showSuperAdmin'])->name('dashboard');

    // Admin Management
    Route::get('/admin-roles', [SuperAdminController::class, 'adminRoles'])->name('adminroles');
    Route::post('/admin/store', [SuperAdminController::class, 'store'])->name('admin.store');
    
    Route::post('/admin/restore/{id}', [SuperAdminController::class, 'restore'])->name('admin.restore');
    Route::get('/admin/users', [SuperAdminController::class, 'index'])->name('admin.index');
    Route::get('/admin-management', [AdminController::class, 'index'])->name('admin.management');
    Route::post('/users/restore/{id}', [SuperAdminController::class, 'restoreUser'])
     ->name('superadmin.users.restore');


     Route::get('/superadmin/administrators', [SuperAdminController::class, 'showAdministrators'])->name('administrators');
    Route::put('/admin/update/{id}', [SuperAdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete/{id}', [SuperAdminController::class, 'destroy'])->name('admin.delete');



    Route::get('/admin/login-history', [AdminController::class, 'showLoginHistory']);

    // Student submission & export PDF
    Route::get('/student-submission', [SuperAdminController::class, 'studentSubmission'])->name('studentSubmission');
    Route::get('/export/pdf', [SuperAdminController::class, 'exportPdf'])->name('export.pdf');

    // Superadmin profile management
    Route::get('/profile/edit', [SuperAdminController::class, 'editAdmin'])->name('profile.edit');
    Route::post('/profile/update', [SuperAdminController::class, 'updateAdmin'])->name('profile.update');
});

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

});

// Show forgot password form

// Handle sending password reset email
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
