<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDiagnose extends Model
{
    use HasFactory;


    protected $table = 'patient_diagnoses';
    protected $primaryKey = 'patient_diagnose_id';

    protected $fillable = [
      'patient_id',
      'date_admission',
      'present_complain',
      'admission_diagnose',
      'principal_diagnose',
      'doctor_id',
      'skin', 
      'head_eent',
      'lymp_notes',
      'chest',
      'lungs',
      'cardiovascular',
      'breast',
      'abdoment',
      'rectum',
      'genetalia',
      'musculoskeletal',
      'extremities',
      'neurological',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id', 'patient_id');
    }
    
}
