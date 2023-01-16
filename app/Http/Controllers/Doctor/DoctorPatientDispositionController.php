<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientAdmission;
use Illuminate\Http\Request;

class DoctorPatientDispositionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($admissionId, $patientId){

        return view('doctor.doctor-patient-disposition')
            ->with('admissionId', $admissionId)
            ->with('patientId', $patientId);
    }

    public function getPatientInfo($admissionId, $patientId){

        $data = PatientAdmission::where('patient_id', $patientId)
            ->where('patient_admission_id', $admissionId)
            ->with(['patient', 'doctor_diagnose', 'history'])
            ->first();
        return $data;
    }


}
