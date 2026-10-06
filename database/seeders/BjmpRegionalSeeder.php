<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class BjmpRegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regionalFacilities = [
            // National Capital Region
            [
                'name' => 'Manila City Jail - Male Dormitory',
                'max_visitors_per_hour' => 60,
                'regional_office' => 'BJMP National Capital Region',
                'jail_unit_name' => 'Manila City Jail',
                'badge_image_path' => 'regional-logos/ncr-logo.svg',
            ],
            [
                'name' => 'Quezon City Jail - Male Dormitory',
                'max_visitors_per_hour' => 50,
                'regional_office' => 'BJMP National Capital Region',
                'jail_unit_name' => 'Quezon City Jail',
                'badge_image_path' => 'regional-logos/ncr-logo.svg',
            ],
            [
                'name' => 'Makati City Jail',
                'max_visitors_per_hour' => 40,
                'regional_office' => 'BJMP National Capital Region',
                'jail_unit_name' => 'Makati City Jail',
                'badge_image_path' => 'regional-logos/ncr-logo.svg',
            ],
            [
                'name' => 'Pasay City Jail',
                'max_visitors_per_hour' => 35,
                'regional_office' => 'BJMP National Capital Region',
                'jail_unit_name' => 'Pasay City Jail',
                'badge_image_path' => 'regional-logos/ncr-logo.svg',
            ],
            [
                'name' => 'Taguig City Jail',
                'max_visitors_per_hour' => 30,
                'regional_office' => 'BJMP National Capital Region',
                'jail_unit_name' => 'Taguig City Jail',
                'badge_image_path' => 'regional-logos/ncr-logo.svg',
            ],

            // Regional Office I (Ilocos Region)
            [
                'name' => 'Baguio City Jail',
                'max_visitors_per_hour' => 35,
                'regional_office' => 'BJMP Regional Office No. I',
                'jail_unit_name' => 'Baguio City Jail',
                'badge_image_path' => 'regional-logos/region1-logo.svg',
            ],
            [
                'name' => 'Laoag City Jail',
                'max_visitors_per_hour' => 25,
                'regional_office' => 'BJMP Regional Office No. I',
                'jail_unit_name' => 'Laoag City Jail',
                'badge_image_path' => 'regional-logos/region1-logo.svg',
            ],

            // Regional Office II (Cagayan Valley)
            [
                'name' => 'Tuguegarao City Jail',
                'max_visitors_per_hour' => 30,
                'regional_office' => 'BJMP Regional Office No. II',
                'jail_unit_name' => 'Tuguegarao City Jail',
                'badge_image_path' => 'regional-logos/region2-logo.svg',
            ],

            // Regional Office III (Central Luzon)
            [
                'name' => 'Mabalacat City Jail',
                'max_visitors_per_hour' => 50,
                'regional_office' => 'BJMP Regional Office No. III',
                'jail_unit_name' => 'Mabalacat City Jail',
                'badge_image_path' => 'regional-logos/region3-logo.svg',
            ],
            [
                'name' => 'Angeles City Jail',
                'max_visitors_per_hour' => 40,
                'regional_office' => 'BJMP Regional Office No. III',
                'jail_unit_name' => 'Angeles City Jail',
                'badge_image_path' => 'regional-logos/region3-logo.svg',
            ],
            [
                'name' => 'San Fernando City Jail',
                'max_visitors_per_hour' => 45,
                'regional_office' => 'BJMP Regional Office No. III',
                'jail_unit_name' => 'San Fernando City Jail',
                'badge_image_path' => 'regional-logos/region3-logo.svg',
            ],

            // Regional Office IV-A (CALABARZON)
            [
                'name' => 'Batangas City Jail',
                'max_visitors_per_hour' => 40,
                'regional_office' => 'BJMP Regional Office No. IV-A',
                'jail_unit_name' => 'Batangas City Jail',
                'badge_image_path' => 'regional-logos/region4a-logo.svg',
            ],
            [
                'name' => 'Lipa City Jail',
                'max_visitors_per_hour' => 35,
                'regional_office' => 'BJMP Regional Office No. IV-A',
                'jail_unit_name' => 'Lipa City Jail',
                'badge_image_path' => 'regional-logos/region4a-logo.svg',
            ],
            [
                'name' => 'Lucena City Jail',
                'max_visitors_per_hour' => 30,
                'regional_office' => 'BJMP Regional Office No. IV-A',
                'jail_unit_name' => 'Lucena City Jail',
                'badge_image_path' => 'regional-logos/region4a-logo.svg',
            ],

            // Regional Office V (Bicol Region)
            [
                'name' => 'Legazpi City Jail',
                'max_visitors_per_hour' => 35,
                'regional_office' => 'BJMP Regional Office No. V',
                'jail_unit_name' => 'Legazpi City Jail',
                'badge_image_path' => 'regional-logos/region5-logo.svg',
            ],
            [
                'name' => 'Naga City Jail',
                'max_visitors_per_hour' => 30,
                'regional_office' => 'BJMP Regional Office No. V',
                'jail_unit_name' => 'Naga City Jail',
                'badge_image_path' => 'regional-logos/region5-logo.svg',
            ],

            // Regional Office VI (Western Visayas)
            [
                'name' => 'Iloilo City Jail',
                'max_visitors_per_hour' => 55,
                'regional_office' => 'BJMP Regional Office No. VI',
                'jail_unit_name' => 'Iloilo City Jail',
                'badge_image_path' => 'regional-logos/region6-logo.svg',
            ],
            [
                'name' => 'Bacolod City Jail',
                'max_visitors_per_hour' => 45,
                'regional_office' => 'BJMP Regional Office No. VI',
                'jail_unit_name' => 'Bacolod City Jail',
                'badge_image_path' => 'regional-logos/region6-logo.svg',
            ],

            // Regional Office VII (Central Visayas)
            [
                'name' => 'Cebu City Jail',
                'max_visitors_per_hour' => 70,
                'regional_office' => 'BJMP Regional Office No. VII',
                'jail_unit_name' => 'Cebu City Jail',
                'badge_image_path' => 'regional-logos/region7-logo.svg',
            ],
            [
                'name' => 'Mandaue City Jail',
                'max_visitors_per_hour' => 40,
                'regional_office' => 'BJMP Regional Office No. VII',
                'jail_unit_name' => 'Mandaue City Jail',
                'badge_image_path' => 'regional-logos/region7-logo.svg',
            ],

            // Regional Office VIII (Eastern Visayas)
            [
                'name' => 'Tacloban City Jail',
                'max_visitors_per_hour' => 35,
                'regional_office' => 'BJMP Regional Office No. VIII',
                'jail_unit_name' => 'Tacloban City Jail',
                'badge_image_path' => 'regional-logos/region8-logo.svg',
            ],

            // Regional Office IX (Zamboanga Peninsula)
            [
                'name' => 'Zamboanga City Jail',
                'max_visitors_per_hour' => 50,
                'regional_office' => 'BJMP Regional Office No. IX',
                'jail_unit_name' => 'Zamboanga City Jail',
                'badge_image_path' => 'regional-logos/region9-logo.svg',
            ],

            // Regional Office X (Northern Mindanao)
            [
                'name' => 'Cagayan de Oro City Jail',
                'max_visitors_per_hour' => 45,
                'regional_office' => 'BJMP Regional Office No. X',
                'jail_unit_name' => 'Cagayan de Oro City Jail',
                'badge_image_path' => 'regional-logos/region10-logo.svg',
            ],

            // Regional Office XI (Davao Region)
            [
                'name' => 'Davao City Jail',
                'max_visitors_per_hour' => 65,
                'regional_office' => 'BJMP Regional Office No. XI',
                'jail_unit_name' => 'Davao City Jail',
                'badge_image_path' => 'regional-logos/region11-logo.svg',
            ],

            // Regional Office XII (SOCCSKSARGEN)
            [
                'name' => 'General Santos City Jail',
                'max_visitors_per_hour' => 40,
                'regional_office' => 'BJMP Regional Office No. XII',
                'jail_unit_name' => 'General Santos City Jail',
                'badge_image_path' => 'regional-logos/region12-logo.svg',
            ],

            // Regional Office XIII (Caraga)
            [
                'name' => 'Butuan City Jail',
                'max_visitors_per_hour' => 30,
                'regional_office' => 'BJMP Regional Office No. XIII',
                'jail_unit_name' => 'Butuan City Jail',
                'badge_image_path' => 'regional-logos/region13-logo.svg',
            ],

            // CAR (Cordillera Administrative Region)
            [
                'name' => 'Baguio City Jail - Female Dormitory',
                'max_visitors_per_hour' => 20,
                'regional_office' => 'BJMP Cordillera Administrative Region',
                'jail_unit_name' => 'Baguio City Jail',
                'badge_image_path' => 'regional-logos/car-logo.svg',
            ],

            // ARMM (Autonomous Region in Muslim Mindanao)
            [
                'name' => 'Cotabato City Jail',
                'max_visitors_per_hour' => 35,
                'regional_office' => 'BJMP Autonomous Region in Muslim Mindanao',
                'jail_unit_name' => 'Cotabato City Jail',
                'badge_image_path' => 'regional-logos/armm-logo.svg',
            ],
        ];

        foreach ($regionalFacilities as $facilityData) {
            $facility = Facility::firstOrCreate(
                ['name' => $facilityData['name']],
                $facilityData
            );

            if (! $facility->pdls()->exists()) {
                $facility->pdls()->createMany([
                    [
                        'first_name' => 'Juan',
                        'last_name' => 'Dela Cruz',
                        'cell_block' => 'A-101',
                    ],
                    [
                        'first_name' => 'Maria',
                        'last_name' => 'Santos',
                        'cell_block' => 'B-205',
                    ],
                    [
                        'first_name' => 'Pedro',
                        'last_name' => 'Reyes',
                        'cell_block' => 'A-102',
                    ],
                ]);
            }
        }
    }
}
