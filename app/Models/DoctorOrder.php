<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorOrder extends Model
{
    use HasFactory;


    protected $table = 'doctor_orders';
    protected $primaryKey = 'doctor_order_id';

    protected $fillable = [
        'patient_id',
        'patient_diagnose_id',
        'date_order_created',
        'doctor_id',

    ];
    

    public function patient(){
        return $this->hasOne(Patient::class, 'patient_id', 'patient_id');
    }

    public function patient_diagnose(){
        return $this->hasOne(PatientDiagnose::class, 'patient_diagnose_id', 'patient_diagnose_id');
    }

    public function doctor_order_details(){
        return $this->hasMany(DoctorOrderDetail::class, 'doctor_order_id', 'doctor_order_id')
        ->with('nurse');
    }



}
