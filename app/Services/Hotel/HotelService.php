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

}
