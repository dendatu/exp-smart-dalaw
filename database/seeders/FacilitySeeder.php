<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
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
            [
                'name' => 'Manila City Jail',
                'max_visitors_per_hour' => 100,
                'regional_office' => 'BJMP National Headquarters',
                'jail_unit_name' => 'Manila City Jail',
                'badge_image_path' => 'regional-logos/ncr-logo.svg',
            ],
            [
                'name' => 'Quezon City Jail',
                'max_visitors_per_hour' => 80,
                'regional_office' => 'BJMP National Capital Region',
                'jail_unit_name' => 'Quezon City Jail',
                'badge_image_path' => 'regional-logos/ncr-logo.svg',
            ],
            [
                'name' => 'Makati City Jail',
                'max_visitors_per_hour' => 60,
                'regional_office' => 'BJMP National Capital Region',
                'jail_unit_name' => 'Makati City Jail',
                'badge_image_path' => 'regional-logos/ncr-logo.svg',
            ],
            [
                'name' => 'Cebu City Jail',
                'max_visitors_per_hour' => 70,
                'regional_office' => 'BJMP Regional Office No. VII',
                'jail_unit_name' => 'Cebu City Jail',
                'badge_image_path' => 'regional-logos/region7-logo.svg',
            ],
            [
                'name' => 'Davao City Jail',
                'max_visitors_per_hour' => 65,
                'regional_office' => 'BJMP Regional Office No. XI',
                'jail_unit_name' => 'Davao City Jail',
                'badge_image_path' => 'regional-logos/region11-logo.svg',
            ],
            [
                'name' => 'Baguio City Jail',
                'max_visitors_per_hour' => 35,
                'regional_office' => 'BJMP Regional Office No. I',
                'jail_unit_name' => 'Baguio City Jail',
                'badge_image_path' => 'regional-logos/region1-logo.svg',
            ],
            [
                'name' => 'Iloilo City Jail',
                'max_visitors_per_hour' => 55,
                'regional_office' => 'BJMP Regional Office No. VI',
                'jail_unit_name' => 'Iloilo City Jail',
                'badge_image_path' => 'regional-logos/region6-logo.svg',
            ],
        ];

        foreach ($facilities as $facilityData) {
            $facility = Facility::create($facilityData);

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
                [
                    'first_name' => 'Ana',
                    'last_name' => 'Garcia',
                    'cell_block' => 'C-301',
                ],
                [
                    'first_name' => 'Carlos',
                    'last_name' => 'Mendoza',
                    'cell_block' => 'A-103',
                ],
            ]);
        }
    }
}
