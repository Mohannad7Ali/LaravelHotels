<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        Hotel::truncate();

        $hotels = [
            // Asia
            ['name'=>'Burj Al Arab','city'=>'Dubai','latitude'=>25.1412,'longitude'=>55.1852,'stars'=>5,'price_per_night'=>1500],
            ['name'=>'Raffles Singapore','city'=>'Singapore','latitude'=>1.2834,'longitude'=>103.8607,'stars'=>5,'price_per_night'=>700],
            ['name'=>'Taj Mahal Palace','city'=>'Mumbai','latitude'=>18.9220,'longitude'=>72.8330,'stars'=>5,'price_per_night'=>400],
            ['name'=>'Shangri-La Beijing','city'=>'Beijing','latitude'=>39.9150,'longitude'=>116.4010,'stars'=>5,'price_per_night'=>350],

            // Europe
            ['name'=>'The Dolder Grand','city'=>'Zurich','latitude'=>47.3769,'longitude'=>8.5417,'stars'=>5,'price_per_night'=>600],
            ['name'=>'Baur au Lac','city'=>'Zurich','latitude'=>47.3708,'longitude'=>8.5450,'stars'=>5,'price_per_night'=>550],
            ['name'=>'Ritz Paris','city'=>'Paris','latitude'=>48.8686,'longitude'=>2.3285,'stars'=>5,'price_per_night'=>1200],
            ['name'=>'Hotel Excelsior Rome','city'=>'Rome','latitude'=>41.9110,'longitude'=>12.4550,'stars'=>4,'price_per_night'=>300],
            ['name'=>'Grand Hotel Vienna','city'=>'Vienna','latitude'=>48.2100,'longitude'=>16.3738,'stars'=>4,'price_per_night'=>250],

            // North America
            ['name'=>'The Plaza','city'=>'New York','latitude'=>40.7648,'longitude'=>-73.9742,'stars'=>5,'price_per_night'=>900],
            ['name'=>'Fairmont Banff Springs','city'=>'Banff','latitude'=>51.1784,'longitude'=>-115.5708,'stars'=>5,'price_per_night'=>500],
            ['name'=>'Hotel Vancouver','city'=>'Vancouver','latitude'=>49.2827,'longitude'=>-123.1207,'stars'=>4,'price_per_night'=>200],

            // South America
            ['name'=>'Belmond Copacabana Palace','city'=>'Rio de Janeiro','latitude'=>-22.9711,'longitude'=>-43.1822,'stars'=>5,'price_per_night'=>600],
            ['name'=>'Hotel Fasano','city'=>'Buenos Aires','latitude'=>-34.5974,'longitude'=>-58.3633,'stars'=>5,'price_per_night'=>550],
            ['name'=>'JW Marriott Lima','city'=>'Lima','latitude'=>-12.1230,'longitude'=>-77.0300,'stars'=>4,'price_per_night'=>250],

            // Africa
            ['name'=>'One&Only Cape Town','city'=>'Cape Town','latitude'=>-33.9258,'longitude'=>18.4232,'stars'=>5,'price_per_night'=>700],
            ['name'=>'Kempinski Hotel','city'=>'Marrakech','latitude'=>31.6295,'longitude'=>-7.9811,'stars'=>5,'price_per_night'=>350],
            ['name'=>'Serena Hotel Nairobi','city'=>'Nairobi','latitude'=>-1.2864,'longitude'=>36.8172,'stars'=>4,'price_per_night'=>200],

            // Australia
            ['name'=>'Park Hyatt Sydney','city'=>'Sydney','latitude'=>-33.8688,'longitude'=>151.2093,'stars'=>5,'price_per_night'=>800],
            ['name'=>'Crown Metropol Melbourne','city'=>'Melbourne','latitude'=>-37.8136,'longitude'=>144.9631,'stars'=>4,'price_per_night'=>300],
            ['name'=>'QT Perth','city'=>'Perth','latitude'=>-31.9505,'longitude'=>115.8605,'stars'=>4,'price_per_night'=>220],

            // Middle East (Extra for demo)
            ['name'=>'Four Seasons Hotel Damascus','city'=>'Damascus','latitude'=>33.5131,'longitude'=>36.2872,'stars'=>5,'price_per_night'=>250],
            ['name'=>'Shahba Palace','city'=>'Aleppo','latitude'=>36.2238,'longitude'=>37.1344,'stars'=>5,'price_per_night'=>120],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
