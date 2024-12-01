<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::set('fedex_mode', "0");
        Setting::set('fedex_key', "l76b3a109e761a44438f0fb526337d47c3");
        Setting::set('fedex_secret', "ae3b5559ea734d4b86ca734880ccb3c7");
        Setting::set('purolator_development_key', "4a6de7aaf7884bf4a05e5de3c4f4ac5b");
        Setting::set('purolator_development_password', "U7VhLo6b");
        Setting::set('purolator_test_frieght', "F271");
        Setting::set('ups_client_id', "EAv2syrYzGmIgUAD8Gcj9SfVvUZB7mb0xxO9GoJVCvfRJtwW");
        Setting::set('ups_client_secret', "B0Odpid0DNI3tC7rHvMDAnyayrkvD812rh92MQx2YEPpC7e45RzEneenPnACBHw7");
        Setting::set('ups_access_key', "DDCDAB90D23F1DE0");
        Setting::set('ups_account_number', "B3H009");
        Setting::set('loomis_dev_test_acc', "HB4499");
        Setting::set('loomis_test_api_user', "ADMIN@USS.COM");
        Setting::set('loomis_test_api_password', "6gVd3Ln7");
        Setting::set('google_map_key', "AIzaSyCcPP-R81C0aR0ADDKK5QaygN2PPBGqyV8");
        
        Setting::save();
    }
}
