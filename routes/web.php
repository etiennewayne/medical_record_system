<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


use App\Models\User;
use App\Models\Category;


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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes([
    'login' => 'false'
]);

Route::get('/load-user', function(){
    if(Auth::check()){
        return Auth::user();
    }
});




Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/sample',[App\Http\Controllers\SampleController::class,'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sign-up', [App\Http\Controllers\SignUpController::class, 'index']);
Route::post('/sign-up', [App\Http\Controllers\SignUpController::class, 'store']);


Route::get('/get-user/{id}', [App\Http\Controllers\OpenUserController::class, 'getUser']);




//ADDRESS
Route::get('/load-provinces', [App\Http\Controllers\AddressController::class, 'loadProvinces']);
Route::get('/load-cities', [App\Http\Controllers\AddressController::class, 'loadCities']);
Route::get('/load-barangays', [App\Http\Controllers\AddressController::class, 'loadBarangays']);



// -----------------------ADMINSITRATOR-------------------------------------------

Route::get('/admin-home', [App\Http\Controllers\Administrator\AdminHomeController::class, 'index']);


Route::resource('/accounts', App\Http\Controllers\Administrator\AccountController::class);
Route::get('/get-accounts', [App\Http\Controllers\Administrator\AccountController::class, 'getAccounts']);


Route::resource('/designations', App\Http\Controllers\Administrator\DesignationController::class);
Route::get('/get-designations', [App\Http\Controllers\Administrator\DesignationController::class, 'getDesignations']);




Route::get('/manage-patient', [App\Http\Controllers\Administrator\ManagePatientController::class, 'index']);

// -----------------------ADMINSITRATOR-------------------------------------------



// -----------------------NURSE-------------------------------------------
Route::resource('/nurse-home', App\Http\Controllers\Nurse\NurseHomeController::class);

Route::resource('/nurse-patient', App\Http\Controllers\Nurse\NursePatientController::class);
Route::get('/get-nurse-patients',[App\Http\Controllers\Nurse\NursePatientController::class, 'getNursePatients']);



Route::get('/nurse-patient-diagnoses/{id}',[App\Http\Controllers\Nurse\NursePatientDiagnoseController::class, 'index']);
Route::get('/get-nurse-patient-diagnoses/{id}',[App\Http\Controllers\Nurse\NursePatientDiagnoseController::class, 'getPatientDiagnoses']);

Route::post('/nurse-patient-submit-diagnose',[App\Http\Controllers\Nurse\NursePatientDiagnoseController::class, 'store']);


Route::get('/nurse-patient-diagnose-doctor-orders/{id}',[App\Http\Controllers\Nurse\NursePatientDiagnoseDoctorOrderController::class, 'index']);
Route::get('/get-nurse-patient-diagnose-doctor-orders/{id}',[App\Http\Controllers\Nurse\NursePatientDiagnoseDoctorOrderController::class, 'getDoctorOrders']);
Route::post('/nurse-patient-diagnose-doctor-orders-detail-update/{id}',[App\Http\Controllers\Nurse\NursePatientDiagnoseDoctorOrderController::class, 'updateOrderDetail']);



// -----------------------NURSE-------------------------------------------



// -----------------------DOCTOR-------------------------------------------
Route::resource('/doctor-home', App\Http\Controllers\Doctor\DoctorHomeController::class);



Route::resource('/doctor-patients', App\Http\Controllers\Doctor\DoctorPatientController::class);
Route::get('/get-doctor-patients', [App\Http\Controllers\Doctor\DoctorPatientController::class, 'getDoctorPatients']);

Route::get('/doctor-patient-diagnoses/{id}', [App\Http\Controllers\Doctor\PatientDiagnoseController::class, 'index']);

Route::post('/doctor-patient-diagnose-submit', [App\Http\Controllers\Doctor\PatientDiagnoseController::class, 'store']);

// -----------------------DOCTOR-------------------------------------------














Route::get('/session', function(){
    return Session::all();
});



Route::get('/applogout', function(Request $req){
    \Auth::logout();
    $req->session()->invalidate();
    $req->session()->regenerateToken();


});
