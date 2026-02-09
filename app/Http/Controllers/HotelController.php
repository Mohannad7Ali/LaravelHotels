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
}
