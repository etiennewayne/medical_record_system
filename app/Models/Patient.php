<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;



    
    protected $table = 'patients';
    protected $primaryKey = 'patient_id';

    protected $fillable = [
      'lname',
      'fname',
      'mname',
      'suffix',
      'province',
      'city',
      'barangay',
      'street',
      'contact_no',
      'sex',
      'civil_status',
      'bdate',
      'birthplace',
      'nationality',
      'religion',
      'occupation',
      'employer',
      'employer_address',
      'employer_contact_no',
      'father_name',
      'father_address',
      'mother_maiden_name',
      'mother_address',
      
      'spouse_name',
      'spouse_address',
      'admission_date',
      'family_history'

    ];

}
