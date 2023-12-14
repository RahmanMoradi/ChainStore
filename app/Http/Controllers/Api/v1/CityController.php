<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\City\StoreCityAction;
use App\Actions\City\UpdateCityAction;
use App\Http\Requests\City\StoreCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Repositories\City\CityRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(City::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CityRepositoryInterface $cityRepository): JsonResponse
    {
        return $this->successResponse(
            CityResource::collection(
                $cityRepository->paginate($request->input('page_limit'))
            ),
            trans("city.success_index")
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request): JsonResponse
    {
        $city = StoreCityAction::run($request->validated());
        return $this->successResponse(
            CityResource::make($city),
            trans("city.success_store")
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city): JsonResponse
    {
        return $this->successResponse(
            CityResource::make($city),
            trans("city.success_show"),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city): JsonResponse
    {
        $city = UpdateCityAction::run($city, $request->validated());
        return $this->successResponse(
            CityResource::make($city),
            trans("city.success_update"),
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city): JsonResponse
    {
        $city->delete();
        return $this->successResponse(
            "True",
            trans("city.success_destroy")
        );
    }

    public function forceDelete(City $city)
    {
        $city->forceDelete();
        return $this->successResponse(
            "True",
            trans("city.success_force_delete")
        );
    }

    public function restore(City $city)
    {
        $city->restore();
        return $this->successResponse(
            "True",
            trans("city.success_restore")
        );
    }
}
