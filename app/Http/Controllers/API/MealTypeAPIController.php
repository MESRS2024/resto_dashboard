<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMealTypeAPIRequest;
use App\Http\Requests\API\UpdateMealTypeAPIRequest;
use App\Models\MealType;
use App\Repositories\MealTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\MealTypeResource;

/**
 * Class MealTypeAPIController
 */
class MealTypeAPIController extends AppBaseController
{
    /** @var  MealTypeRepository */
    private $mealTypeRepository;

    public function __construct(MealTypeRepository $mealTypeRepo)
    {
        $this->mealTypeRepository = $mealTypeRepo;
    }

    /**
     * Display a listing of the MealTypes.
     * GET|HEAD /meal-types
     */
    public function index(Request $request): JsonResponse
    {
        $mealTypes = $this->mealTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            MealTypeResource::collection($mealTypes),
            __('messages.retrieved', ['model' => __('models/mealTypes.plural')])
        );
    }

    /**
     * Store a newly created MealType in storage.
     * POST /meal-types
     */
    public function store(CreateMealTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $mealType = $this->mealTypeRepository->create($input);

        return $this->sendResponse(
            new MealTypeResource($mealType),
            __('messages.saved', ['model' => __('models/mealTypes.singular')])
        );
    }

    /**
     * Display the specified MealType.
     * GET|HEAD /meal-types/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var MealType $mealType */
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/mealTypes.singular')])
            );
        }

        return $this->sendResponse(
            new MealTypeResource($mealType),
            __('messages.retrieved', ['model' => __('models/mealTypes.singular')])
        );
    }

    /**
     * Update the specified MealType in storage.
     * PUT/PATCH /meal-types/{id}
     */
    public function update($id, UpdateMealTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var MealType $mealType */
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/mealTypes.singular')])
            );
        }

        $mealType = $this->mealTypeRepository->update($input, $id);

        return $this->sendResponse(
            new MealTypeResource($mealType),
            __('messages.updated', ['model' => __('models/mealTypes.singular')])
        );
    }

    /**
     * Remove the specified MealType from storage.
     * DELETE /meal-types/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var MealType $mealType */
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/mealTypes.singular')])
            );
        }

        $mealType->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/mealTypes.singular')])
        );
    }
}
