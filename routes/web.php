<?php

use Illuminate\Support\Facades\Route;

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



// Guest User


// Guest Admin
Route::get('/login', 'AdminAuthController@adminLogin');
Route::post('/login', 'AdminAuthController@adminLoginPost');
Route::get('/register', 'AdminAuthController@adminRegister');
Route::post('/register', 'AdminAuthController@adminRegisterPost');

// Admin controller
// Get
Route::get('/', 'AdminController@index');
Route::get('/current', 'AdminController@current');
Route::get('/logout', 'AdminController@logout');
Route::get("/submitted_projects", 'AdminController@submittedProject');
Route::get("/approved_projects", 'AdminController@approvedProjects');
Route::get("/unassigned_projects", 'AdminController@unassignedProjects');
Route::get("/completed_projects", 'AdminController@completedProjects');

Route::get("/ongoing_projects", 'AdminController@ongoingProject');
Route::get("/approve/{id}", 'AdminController@approve');
Route::get("/approve_writer/{id}", 'AdminController@approveWriter');
Route::get("/approve_writers", 'AdminController@approveWriters');
Route::get("/suspend_writer/{id}", 'AdminController@suspendWriter');
Route::get("/suspended_writers", 'AdminController@suspendedWriters');
Route::get("/writers", 'AdminController@writers');
Route::get("/clients", 'AdminController@clients');
Route::get("/addjob/{url}", 'AdminController@addJob');
Route::get("/pastjobs", 'AdminController@pastJobs');
Route::get("/profile", 'AdminController@profile');
Route::get("/edit_profile", function() {
    return view('admin.pages.editprofile');
});
Route::get("/change_password", function() {
    return view('admin.pages.changepassword');
});
Route::get("submitted_withdrawal", "AdminController@submittedWithdrawal");
Route::get("completed_withdrawal", "AdminController@completedWithdrawal");
Route::get("/completed_payment/{id}", "AdminController@completedPayment");
Route::get("/reject_payment/{id}", "AdminController@rejectPayment");
Route::get("/reverse_payment/{id}", "AdminController@reversePayment");
Route::get("/account_details", "AdminController@accoutDetails");
Route::post("/account_details", "AdminController@accoutDetailsPost");

Route::post("/assign", 'AdminController@assign');
Route::post("/edit_profile", 'AdminController@editProfile');
Route::post("/change_password", 'AdminController@changePassword');

// Post
Route::post("/submitfile", 'AdminController@submitFile');
Route::post("/addorder", 'AdminController@addOrder');
Route::post('/changeprofilepicture', 'AdminController@changeProfilePicture');


