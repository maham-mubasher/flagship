<?php

namespace Database\Seeders;

use App\Models\AddressGroup;
use App\Models\Country;
use App\Models\MeasurementUnit;
use App\Models\Province;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            SettingSeeder::class
            // PermissionsSeeder::class,
            // RolesSeeder::class,
        ]);

        //Country::factory(100)->has(Province::factory(20))->create();

        $countries = [
            "Canada" => [
                "Alberta",
                "Colombie Britannique",
                "Manitoba",
                "Nouveau-Brunswick",
                "Terre-Neuve-et-Labrador",
                "Territoires du Nord-Ouest",
                "Nouvelle-Écosse",
                "Nunavut",
                "Ontario",
                "Île du Prince-Édouard",
                "Quebec",
                "Saskatchewan",
                "Territoire du Yukon",
            ],
            "United States" => ["California", "New York"],
            "United Kingdom" => ["England", "Scotland"],
            "Australia" => ["New South Wales", "Victoria"],
            "Germany" => ["Bavaria", "North Rhine-Westphalia"],
            "France" => ["Île-de-France", "Provence-Alpes-Côte d'Azur"],
            "Spain" => ["Catalonia", "Andalusia"],
            "Italy" => ["Lombardy", "Sicily"],
            "Japan" => ["Tokyo", "Osaka"],
            "China" => ["Beijing", "Shanghai"],
            "India" => ["Maharashtra", "Uttar Pradesh"],
            "Mexico" => ["Mexico City", "Jalisco"],
            "Brazil" => ["São Paulo", "Rio de Janeiro"],
            "Argentina" => ["Buenos Aires", "Córdoba"],
            "Russia" => ["Moscow", "Saint Petersburg"],
            "South Africa" => ["Gauteng", "Western Cape"],
            "Nigeria" => ["Lagos", "Kano"],
            "Egypt" => ["Cairo", "Alexandria"],
            "Kenya" => ["Nairobi", "Mombasa"],
            "Saudi Arabia" => ["Riyadh", "Jeddah"],
            "United Arab Emirates" => ["Dubai", "Abu Dhabi"],
            "South Korea" => ["Seoul", "Busan"],
            "Thailand" => ["Bangkok", "Phuket"],
            "Vietnam" => ["Ho Chi Minh City", "Hanoi"],
            "Indonesia" => ["Jakarta", "Bali"],
            "Turkey" => ["Istanbul", "Ankara"],
            "Greece" => ["Attica", "Thessaloniki"],
            "Sweden" => ["Stockholm", "Skåne"],
            "Norway" => ["Oslo", "Rogaland"],
            "Denmark" => ["Copenhagen", "Jutland"],
        ];

        foreach ($countries as $countryName => $provinces) {

            $country = Country::create(['name' => $countryName]);
            foreach ($provinces as $province) {

                $country->provinces()->create([
                    'name' => $province
                ]);
            }
        }

        $addressGroups = [
            "Freight Addresses",
            "Pickup Addresses",
            "Shipping Addresses",
            "Your Company Addresses",
        ];

        foreach ($addressGroups as $name) {

            $addressGroup = AddressGroup::create([
                'user_id' =>  1,
                'name' => $name
            ]);

            $addressGroup->addresses()->create([
                'company_name' => 'Urwa Technologies',
                'attention' => 'Ameer',
                'address' => 'Sialkot',
                'suite' => '',
                'department' => 'nullable',
                'country_id' => '1',
                'postal_code' => 51310,
                'city' => 'Sialkot',
                'province' => 'Punjab',
                'is_residential_address' => true,
                'phone' => '091191919',
                'ext' => null,
                'tax_id' => null,
                'shipping_account' => null,
                'email' => null,
            ]);
        }

        Unit::factory(100)->create();

        MeasurementUnit::factory(100)->create();
    }
}
