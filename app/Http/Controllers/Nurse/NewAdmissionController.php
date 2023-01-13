<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewAdmissionController extends Controller
{
    //

    public function index(){
        return view('nurse.new-admission');
    }

    

}
