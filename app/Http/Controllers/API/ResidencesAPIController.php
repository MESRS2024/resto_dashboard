<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateResidencesAPIRequest;
use App\Http\Requests\API\UpdateResidencesAPIRequest;
use App\Models\Residences;
use App\Repositories\ResidencesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ResidencesResource;

/**
 * Class ResidencesAPIController
 */
class ResidencesAPIController extends AppBaseController
{
    /** @var  ResidencesRepository */
    private $residencesRepository;

    public function __construct(ResidencesRepository $residencesRepo)
    {
        $this->residencesRepository = $residencesRepo;
    }

    /**
     * Display a listing of the Residences.
     * GET|HEAD /residences
     */
    public function index(Request $request): JsonResponse
    {
        $residences = $this->residencesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            ResidencesResource::collection($residences),
            __('messages.retrieved', ['model' => __('models/residences.plural')])
        );
    }

    /**
     * Store a newly created Residences in storage.
     * POST /residences
     */
    public function store(CreateResidencesAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $residences = $this->residencesRepository->create($input);

        return $this->sendResponse(
            new ResidencesResource($residences),
            __('messages.saved', ['model' => __('models/residences.singular')])
        );
    }

    /**
     * Display the specified Residences.
     * GET|HEAD /residences/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Residences $residences */
        $residences = $this->residencesRepository->find($id);

        if (empty($residences)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/residences.singular')])
            );
        }

        return $this->sendResponse(
            new ResidencesResource($residences),
            __('messages.retrieved', ['model' => __('models/residences.singular')])
        );
    }

    /**
     * Update the specified Residences in storage.
     * PUT/PATCH /residences/{id}
     */
    public function update($id, UpdateResidencesAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Residences $residences */
        $residences = $this->residencesRepository->find($id);

        if (empty($residences)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/residences.singular')])
            );
        }

        $residences = $this->residencesRepository->update($input, $id);

        return $this->sendResponse(
            new ResidencesResource($residences),
            __('messages.updated', ['model' => __('models/residences.singular')])
        );
    }

    /**
     * Remove the specified Residences from storage.
     * DELETE /residences/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Residences $residences */
        $residences = $this->residencesRepository->find($id);

        if (empty($residences)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/residences.singular')])
            );
        }

        $residences->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/residences.singular')])
        );
    }
}
