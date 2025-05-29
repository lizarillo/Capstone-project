<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubmissionController;
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

        Route::post('/admin/store', [SuperAdminController::class, 'store'])->name('admin.store');

        // Profile Management
        Route::get('/profile/edit', [AdminController::class, 'editProfile'])->name('profileEdit');
        Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('updateProfile');


        // Reports
        Route::get('/reports', [AdminController::class, 'adminReports'])->name('reports');

        //SUbmission
         Route::get('/submission', [AdminController::class, 'showSubmission'])->name('submission');

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


     Route::get('/superadmin/administrators', [SuperAdminController::class, 'showAdministrators'])->name('manageadmin');


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

    
   

});

// Show forgot password form

// Handle sending password reset email
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');



Route::get('/admin/submissions', [SubmissionController::class, 'listOfSubmission'])->name('admin.submissions');

Route::get('/student/history', [AdminController::class, 'studentHistory'])->name('admin.studentHistory');

Route::get('/student/perDay', [AdminController::class, 'perDay'])->name('admin.perDay');

Route::get('/student/byDocument', [AdminController::class, 'byDocument'])->name('admin.byDocument');

Route::get('/student/byStudent', [AdminController::class, 'byStudent'])->name('admin.byStudent');


Route::get('/student/request', [AdminController::class, 'request'])->name('admin.request');

Route::get('/student/request/pending', [AdminController::class, 'pendingRequest'])->name('admin.pendingRequest');

Route::get('/student/request/approved', [AdminController::class, 'approvedRequest'])->name('admin.approvedRequest');

Route::get('/student/request/rejected', [AdminController::class, 'rejectedRequest'])->name('admin.rejectedRequest');


Route::get('/studentActivity', [SuperAdminController::class, 'studentActivity'])->name('superadmin.studentActivity');

Route::get('/studentRequest', [SuperAdminController::class, 'requestActivity'])->name('superadmin.requestActivity');