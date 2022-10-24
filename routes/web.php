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
    // if(Auth::check()){
    //     $user = Auth::user();
    //     return view('welcome')
    //         ->with('user', $user->only(['lname', 'fname', 'mname', 'suffix', 'role', 'remark', 'office_id']));
    // }
    $categories = Category::all();

    return view('welcome')
        ->with('categories', $categories);
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






/*     ADMINSITRATOR          */

Route::resource('/admin/home', App\Http\Controllers\Administrator\AdminHomeController::class);


Route::resource('/admin/job-types', App\Http\Controllers\Administrator\JobTypeController::class);
Route::get('/admin/get-job-types', [App\Http\Controllers\Administrator\JobTypeController::class, 'getJobTypes']);


Route::resource('/admin/categories', App\Http\Controllers\Administrator\CategoryController::class);
Route::get('/admin/get-categories', [App\Http\Controllers\Administrator\CategoryController::class, 'getCategories']);



Route::resource('/admin/users', App\Http\Controllers\Administrator\UserController::class);
Route::get('/admin/get-users', [App\Http\Controllers\Administrator\UserController::class, 'getUsers']);




// EMPLOYER ROUTES

Route::resource('/employer/signup', App\Http\Controllers\Employer\EmployerSignUpController::class);

Route::resource('/employer/dashboard', App\Http\Controllers\Employer\EmployerDashboardController::class);


Route::get('/employer/company-feed/{cid}', [App\Http\Controllers\Employer\EmployerFeedsController::class, 'index']);

Route::get('/employer/get-my-companies', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'getMyCompanies']);



Route::get('/employer/company-add-edit', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'create']);
Route::post('/employer/company-add-edit', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'store']);
Route::put('/employer/company-add-edit/{id}', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'update']);
Route::get('/employer/company-add-edit/{id}', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'edit']);
Route::get('/employer/company-show/{cid}', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'show']);
Route::delete('/employer/company-delete/{id}', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'destroy']);




// ------------------------------------------------------------------

Route::get('/session', function(){
    return Session::all();
});


Route::get('/before', function(){
    //return Session::all();


    $beforeDay = date('Y-m-d H:i', strtotime('+24 hour', strtotime(date('Y-m-d H:i'))));

    $data = \DB::table('appointments')
        ->where('appoint_date', date('Y-m-d', strtotime($beforeDay)))
        ->where('appoint_time', date('H:i', strtotime($beforeDay)))
        ->where('is_notify', 0)
        ->get();

    foreach($data as $i){

        $user = User::find($i->user_id);

        $msg = 'Hi '.$user->lname . ', ' . $user->fname . ', this is just a reminder that you have an appointment tomorrow. Your ref no. is: ' . $i->qr_code . '.';
        try{
            Http::withHeaders([
                'Content-Type' => 'text/plain'
            ])->post('http://'. env('IP_SMS_GATEWAY') .'/services/api/messaging?Message='.$msg.'&To='.$user->contact_no.'&Slot=1', []);
        }catch(Exception $e){} //just hide the error

        $appoint = Appointment::find($i->appointment_id);
        $appoint->is_notify = 1;
        $appoint->save();
    }

    //$beforeDay = date($today, strtotime('-1 day'));
    return $data;
});




Route::get('/collect', function(){
    return $collection = collect([1, 2, 3]);
});


Route::get('/applogout', function(Request $req){
    \Auth::logout();
    $req->session()->invalidate();
    $req->session()->regenerateToken();


});
