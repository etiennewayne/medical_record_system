<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'username' => 'admin',
                'lname' => 'ABELLA',
                'fname' => 'LEDA GRACE',
                'mname' => 'P',
                'sex' => 'MALE',
                'province' => 'MISAMIS OCCIDENTAL',
                'city' => 'TANGUB CITY',
                'barangay' => 'CANIANGAN',
                'street' => 'P-6',
                'email' => 'admin@dev.com',
                'contact_no' => '09167789585',
                'role' => 'ADMINISTRATOR',
                'password' => Hash::make('a')
            ],

            //client
            [
                'username' => 'user01',
                'lname' => 'LUMAPAC',
                'fname' => 'RAMONITO',
                'mname' => 'P',
                'sex' => 'MALE',
                'province' => 'MISAMIS OCCIDENTAL',
                'city' => 'TANGUB CITY',
                'barangay' => 'CANIANGAN',
                'street' => 'P-6',
                'email' => 'neri@dev.com',
                'contact_no' => '09167789585',
                'role' => 'USER',
                'password' => Hash::make('a')
            ],

            [
                'username' => 'emp01',
                'lname' => 'SACAN',
                'fname' => 'NIMROD',
                'mname' => 'P',
                'sex' => 'MALE',
                'province' => 'MISAMIS OCCIDENTAL',
                'city' => 'TANGUB CITY',
                'barangay' => 'CANIANGAN',
                'street' => 'P-6',
                'email' => 'sacan@dev.com',
                'contact_no' => '09167789585',
                'role' => 'EMPLOYER',
                'password' => Hash::make('a')
            ],

        ];

        \App\Models\User::insertOrIgnore($data);
    }
}
