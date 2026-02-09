<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::truncate();
        $hotels = [
            [
                'name' => 'Four Seasons Hotel Damascus',
                'city' => 'Damascus',
                'latitude' => 33.5131,
                'longitude' => 36.2872,
                'stars' => 5,
                'price_per_night' => 250
            ],
            [
                'name' => 'Shahba Palace',
                'city' => 'Aleppo',
                'latitude' => 36.2238,
                'longitude' => 37.1344,
                'stars' => 5,
                'price_per_night' => 120
            ],
            [
                'name' => 'Afamia Resort',
                'city' => 'Latakia',
                'latitude' => 35.5600,
                'longitude' => 35.7500,
                'stars' => 4,
                'price_per_night' => 90
            ],
            [
                'name' => 'Burj Al Arab',
                'city' => 'Dubai',
                'latitude' => 25.1412,
                'longitude' => 55.1852,
                'stars' => 5,
                'price_per_night' => 1500
            ],
            [
                'name' => 'Emirates Palace',
                'city' => 'Abu Dhabi',
                'latitude' => 24.4617,
                'longitude' => 54.3173,
                'stars' => 5,
                'price_per_night' => 600
            ],
            [
                'name' => 'Atlantis The Royal',
                'city' => 'Dubai',
                'latitude' => 25.1381,
                'longitude' => 55.1264,
                'stars' => 5,
                'price_per_night' => 850
            ],
    ];
        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
