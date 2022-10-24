<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $primaryKey = 'company_id';

    protected $fillable = [
        'user_id', 'company', 
        'owner', 'overview',
        'company_size', 'industry',
        'benefits_others', 'phone_contact',
        'fb_contact', 'twitter_contact', 'insta_contact',
        'viber_contact', 'whatsapp_contact', 'email', 'province',
        'city', 'barangay', 'street', 'company_logo'
    ];


    public function owner_account(){
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    
    public function province(){
        return $this->hasOne(Province::class, 'provCode', 'province');
    }

    public function city(){
        return $this->hasOne(City::class, 'citymunCode', 'city');
    }

}
