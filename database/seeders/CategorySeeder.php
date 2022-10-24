<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'category' => 'SAMPLE CAT 01',
            ],
            [
                'category' => 'SAMPLE CAT 02',
            ],
            [
                'category' => 'SAMPLE CAT 03',
            ],
            [
                'category' => 'SAMPLE CAT 04',
            ],
            [
                'category' => 'SAMPLE CAT 05',
            ],
            [
                'category' => 'SAMPLE CAT 06',
            ],
            [
                'category' => 'SAMPLE CAT 07',
            ],
            [
                'category' => 'SAMPLE CAT 08',
            ],
            [
                'category' => 'SAMPLE CAT 09',
            ],
            [
                'category' => 'SAMPLE CAT 10',
            ],

        ];

        \App\Models\Category::insertOrIgnore($data);


    }
}
