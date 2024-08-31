<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRestoAPIRequest;
use App\Http\Requests\API\UpdateRestoAPIRequest;
use App\Models\Resto;
use App\Repositories\RestoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\RestoResource;

/**
 * Class RestoAPIController
 */
class RestoAPIController extends AppBaseController
{
    /** @var  RestoRepository */
    private $restoRepository;

    public function __construct(RestoRepository $restoRepo)
    {
        $this->restoRepository = $restoRepo;
    }

    /**
     * Display a listing of the Restos.
     * GET|HEAD /restos
     */
    public function index(Request $request): JsonResponse
    {
        $restos = $this->restoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            RestoResource::collection($restos),
            __('messages.retrieved', ['model' => __('models/restos.plural')])
        );
    }

    /**
     * Store a newly created Resto in storage.
     * POST /restos
     */
    public function store(CreateRestoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $resto = $this->restoRepository->create($input);

        return $this->sendResponse(
            new RestoResource($resto),
            __('messages.saved', ['model' => __('models/restos.singular')])
        );
    }

    /**
     * Display the specified Resto.
     * GET|HEAD /restos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Resto $resto */
        $resto = $this->restoRepository->find($id);

        if (empty($resto)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/restos.singular')])
            );
        }

        return $this->sendResponse(
            new RestoResource($resto),
            __('messages.retrieved', ['model' => __('models/restos.singular')])
        );
    }

    /**
     * Update the specified Resto in storage.
     * PUT/PATCH /restos/{id}
     */
    public function update($id, UpdateRestoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Resto $resto */
        $resto = $this->restoRepository->find($id);

        if (empty($resto)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/restos.singular')])
            );
        }

        $resto = $this->restoRepository->update($input, $id);

        return $this->sendResponse(
            new RestoResource($resto),
            __('messages.updated', ['model' => __('models/restos.singular')])
        );
    }

    /**
     * Remove the specified Resto from storage.
     * DELETE /restos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Resto $resto */
        $resto = $this->restoRepository->find($id);

        if (empty($resto)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/restos.singular')])
            );
        }

        $resto->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/restos.singular')])
        );
    }
}
