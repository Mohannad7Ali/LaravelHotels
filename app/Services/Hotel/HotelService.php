<?php

namespace App\Services\Hotel;

use App\Models\Hotel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class HotelService
{
    /**
     * Get all hotels (for admin or listing)
     */
    public function getAll(): Collection
    {
        return Hotel::query()
            ->orderBy('stars', 'desc')
            ->get();
    }

    /**
     * Get hotels for map display (select only needed fields)
     */
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
            ->orderBy('stars', 'desc')
            ->get();
    }

    /**
     * Create a hotel
     */
    public function create(array $data): Hotel
    {
        return Hotel::create($data);
    }

    /**
     * Get nearby hotels
     */
    public function getNearby(float $lat, float $lng, float $radiusKm = 50): Collection
    {
        // first sync with external API  to get latest hotels around the location
        $this->syncExternalHotels($lat, $lng, $radiusKm);

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

        // filter hotels based on distance
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

    /**
     * sync hotels from external API (Geoapify) based on location and radius, and store in DB
     */
    private function syncExternalHotels(float $lat, float $lng, float $radiusKm = 150): void
    {
        $apiKey = config('services.geoapify.key');

    if (!$apiKey) {
        info("Geoapify API Key is missing!");
        return ;
    }
        try{
        $cacheKey = "geo_hotels_{$lat}_{$lng}_{$radiusKm}";

        $externalHotels = Cache::remember($cacheKey, 300, function () use ($lat, $lng, $radiusKm) {
            $response = Http::get('https://api.geoapify.com/v2/places', [
                'categories' => 'accommodation.hotel',
                'filter' => "circle:{$lng},{$lat}," . ($radiusKm * 1000),
                'limit' => 20,
                'apiKey' => config('services.geoapify.key'),
            ]);

            if (!$response->successful()) {
                return [];
            }

            $data = $response->json();

            return collect($data['features'] ?? [])
                ->map(fn($item) => [
                    'name' => $item['properties']['name'] ?? 'Hotel',
                    'city' => $item['properties']['city'] ?? 'Unknown',
                    'latitude' => $item['properties']['lat'],
                    'longitude' => $item['properties']['lon'],
                    'stars' => $item['properties']['rank'] ?? 3,
                    'price_per_night' => 1000, // API may not provide price
                ])
                ->toArray();
        });

        // save in db and avoid duplicates based on name and location
        foreach ($externalHotels as $hotel) {
            Hotel::updateOrCreate(
                [
                    'name' => $hotel['name'],
                    'latitude' => $hotel['latitude'],
                    'longitude' => $hotel['longitude'],
                ],
                [
                    'city' => $hotel['city'],
                    'stars' => $hotel['stars'] ?? 3,
                    'price_per_night' => $hotel['price_per_night'] ?? 1000,
                    'source' => 'external'
                ]
            );
        }
        }catch (\Exception $e) {
            info("Failed to sync hotels: " . $e->getMessage());
    }
    }

    /**
     * (Haversine) calc  distance between two lat/lng points in km
     */
    private function distanceKm(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat/2) ** 2 +
             cos(deg2rad($lat1)) *
             cos(deg2rad($lat2)) *
             sin($dLon/2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
