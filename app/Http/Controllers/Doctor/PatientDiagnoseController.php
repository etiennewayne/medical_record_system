<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\PatientDiagnose;
use Illuminate\Http\Request;
use Auth;
use App\Models\DoctorOrder;
use App\Models\DoctorMedication;
use App\Models\DoctorOrderDetail;
use App\Models\DoctorMedicationDetail;



class PatientDiagnoseController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($id){
        $data = PatientDiagnose::with(['patient'])->find($id);

        return view('doctor.doctor-patient-diagnose')
            ->with('data', $data);
    }

    public function store(Request $req){
        $user = Auth::user();
        //return $req;

        $order = DoctorOrder::create([
            'patient_id' => $req->patient_id,
            'patient_diagnose_id' => $req->patient_diagnose_id,
            'date_order_created' => date('Y-m-d'),
            'doctor_id' => $user->user_id,
        ]);

        foreach($req->orders as $or){
            DoctorOrderDetail::create([
                'doctor_order_id' => $order->doctor_order_id,
                'doctor_date_time_created' => date('Y-m-d H:i:s'),
                'progress_notes' => $or['progress_notes'],
                'order' => $or['order'],
            ]);
        }

        $medication = DoctorMedication::create([
            'patient_id' => $req->patient_id,
            'patient_diagnose_id' => $req->patient_diagnose_id,
            'doctor_id' => $user->user_id,
        ]);

        foreach($req->medications as $med){
            DoctorMedicationDetail::create([
                'doctor_medication_id' => $medication->doctor_medication_id,
                'name_of_drugs' => $med['name_of_drugs'],
                'instruction' => $med['instruction']
            ]);
        }

        return response()->json([
            'status' => 'saved'
        ], 200);
    }
}
