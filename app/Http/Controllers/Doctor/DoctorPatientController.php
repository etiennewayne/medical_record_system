<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientDiagnose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorPatientController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
        return view('doctor.doctor-patients');
    }

    public function getDoctorPatients(Request $req){
        $user = Auth::user();

        $sort = explode('.', $req->sort_by);

        $data = DB::table('patient_diagnoses as a')
            ->join('patients as b', 'a.patient_id', 'b.patient_id')
            ->where('b.lname', 'like', $req->lname . '%')
            ->where('b.fname', 'like', $req->fname . '%')
            ->where('a.doctor_id', $user->user_id)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
        return $data;
    }
}
