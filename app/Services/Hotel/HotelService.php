<?php

namespace App\Services\Hotel;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Collection;

class HotelService {

    //hotel-related business logic.
    public function getAll(): Collection
    {
        return Hotel::query()
            ->orderBy('stars', 'desc')
            ->get();
    }

    public function getForMap(): Collection
    {
        return Hotel::query()
            ->select([
                'id',
                'name',
                'city',
                'latitude',
                'longitude',
                'stars',
                'price_per_night'
            ])
            ->orderBy('stars', 'desc')->get()
;
    }

    public function create(array $data): Hotel
    {
        return Hotel::create($data);
    }

    public function getNearby(float $lat, float $lng, float $radiusKm = 50)
    {
        $hotels = Hotel::query()
            ->select([
                'id',
                'name',
                'city',
                'latitude',
                'longitude',
                'stars',
                'price_per_night'
            ])
            ->get();

        return $hotels->filter(function ($hotel) use ($lat, $lng, $radiusKm) {
            $distance = $this->distanceKm(
                $lat,
                $lng,
                $hotel->latitude,
                $hotel->longitude
            );

            return $distance <= $radiusKm;
        })->values();
    }

    private function distanceKm(
        float $lat1,
        float $lon1,
        float $lat2,
        float $lon2
    ): float {

        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a =
            sin($dLat/2) * sin($dLat/2) +
            cos(deg2rad($lat1)) *
            cos(deg2rad($lat2)) *
            sin($dLon/2) *
            sin($dLon/2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}


