<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run()
    {
        $provincesData = [
            [
                'country_id' => 1,
                'name' => 'Ontario',
                'status' => 1,
                'created_at' => '2023-07-04 02:05:44',
                'updated_at' => '2023-07-04 02:05:44',
            ],
            [
                'country_id' => 1,
                'name' => 'Quebec',
                'status' => 1,
                'created_at' => '2023-07-04 02:05:44',
                'updated_at' => '2023-07-04 02:05:44',
            ],
            [
                'country_id' => 1,
                'name' => 'Alberta',
                'status' => 1,
                'created_at' => '2023-07-29 05:34:38',
                'updated_at' => '2023-07-29 05:34:38',
            ],
            [
                'country_id' => 1,
                'name' => 'British Columbia',
                'status' => 1,
                'created_at' => '2023-07-29 05:35:02',
                'updated_at' => '2023-07-29 05:35:02',
            ],
            [
                'country_id' => 1,
                'name' => 'Saskatchewan',
                'status' => 1,
                'created_at' => '2023-07-29 05:35:11',
                'updated_at' => '2023-07-29 05:35:11',
            ],
            [
                'country_id' => 1,
                'name' => 'Manitoba',
                'status' => 1,
                'created_at' => '2023-07-29 05:35:22',
                'updated_at' => '2023-07-29 05:35:22',
            ],
            [
                'country_id' => 1,
                'name' => 'Nova Scotia',
                'status' => 1,
                'created_at' => '2023-07-29 05:35:30',
                'updated_at' => '2023-07-29 05:35:30',
            ],
            [
                'country_id' => 1,
                'name' => 'New Brunswick',
                'status' => 1,
                'created_at' => '2023-07-29 05:35:40',
                'updated_at' => '2023-07-29 05:35:40',
            ],
            [
                'country_id' => 1,
                'name' => 'Newfoundland and Labrador',
                'status' => 1,
                'created_at' => '2023-07-29 05:35:52',
                'updated_at' => '2023-07-29 05:35:52',
            ],
            [
                'country_id' => 1,
                'name' => 'Prince Edward Island',
                'status' => 1,
                'created_at' => '2023-07-29 05:36:01',
                'updated_at' => '2023-07-29 05:36:01',
            ],
            [
                'country_id' => 1,
                'name' => 'Québec City',
                'status' => 1,
                'created_at' => '2023-07-29 05:36:40',
                'updated_at' => '2023-07-29 05:36:40',
            ],
            [
                'country_id' => 1,
                'name' => 'Yukon',
                'status' => 1,
                'created_at' => '2023-07-29 05:36:47',
                'updated_at' => '2023-07-29 05:36:47',
            ],
            [
                'country_id' => 1,
                'name' => 'Nunavut',
                'status' => 1,
                'created_at' => '2023-07-29 05:36:55',
                'updated_at' => '2023-07-29 05:36:55',
            ],
            [
                'country_id' => 1,
                'name' => 'Northwest Territories',
                'status' => 1,
                'created_at' => '2023-07-29 05:37:14',
                'updated_at' => '2023-07-29 05:37:14',
            ],
        ];

        // Insert data into the provinces table
        DB::table('provinces')->insert($provincesData);
    }
}
