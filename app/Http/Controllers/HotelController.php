<?php

namespace App\Http\Controllers;

use App\Http\Requests\Hotel\StoreHotelRequest;
use Illuminate\Http\Request;
use App\Services\Hotel\HotelService;
use Illuminate\Http\JsonResponse;

class HotelController extends Controller
{
    public function __construct(
        private HotelService $hotelService
    ) {}
    public function index(): JsonResponse
    {
        return response()->json(
            $this->hotelService->getAll()
        );
    }

    public function mapData(): JsonResponse
    {
        return response()->json(
            $this->hotelService->getForMap()
        );
    }

    public function store(StoreHotelRequest $request): JsonResponse
    {
        $hotel = $this->hotelService->create(
            $request->validated()
        );

        return response()->json($hotel, 201);
    }
    public function nearby(): JsonResponse
    {
        $lat = (float) request('lat');
        $lng = (float) request('lng');

        $hotels = $this->hotelService->getNearby($lat, $lng, 50);

        return response()->json($hotels);
    }

}
