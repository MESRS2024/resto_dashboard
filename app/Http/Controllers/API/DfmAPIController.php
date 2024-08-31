<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDfmAPIRequest;
use App\Http\Requests\API\UpdateDfmAPIRequest;
use App\Models\Dfm;
use App\Repositories\DfmRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\DfmResource;

/**
 * Class DfmAPIController
 */
class DfmAPIController extends AppBaseController
{
    /** @var  DfmRepository */
    private $dfmRepository;

    public function __construct(DfmRepository $dfmRepo)
    {
        $this->dfmRepository = $dfmRepo;
    }

    /**
     * Display a listing of the Dfms.
     * GET|HEAD /dfms
     */
    public function index(Request $request): JsonResponse
    {
        $dfms = $this->dfmRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            DfmResource::collection($dfms),
            __('messages.retrieved', ['model' => __('models/dfms.plural')])
        );
    }

    /**
     * Store a newly created Dfm in storage.
     * POST /dfms
     */
    public function store(CreateDfmAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $dfm = $this->dfmRepository->create($input);

        return $this->sendResponse(
            new DfmResource($dfm),
            __('messages.saved', ['model' => __('models/dfms.singular')])
        );
    }

    /**
     * Display the specified Dfm.
     * GET|HEAD /dfms/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Dfm $dfm */
        $dfm = $this->dfmRepository->find($id);

        if (empty($dfm)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/dfms.singular')])
            );
        }

        return $this->sendResponse(
            new DfmResource($dfm),
            __('messages.retrieved', ['model' => __('models/dfms.singular')])
        );
    }

    /**
     * Update the specified Dfm in storage.
     * PUT/PATCH /dfms/{id}
     */
    public function update($id, UpdateDfmAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Dfm $dfm */
        $dfm = $this->dfmRepository->find($id);

        if (empty($dfm)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/dfms.singular')])
            );
        }

        $dfm = $this->dfmRepository->update($input, $id);

        return $this->sendResponse(
            new DfmResource($dfm),
            __('messages.updated', ['model' => __('models/dfms.singular')])
        );
    }

    /**
     * Remove the specified Dfm from storage.
     * DELETE /dfms/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Dfm $dfm */
        $dfm = $this->dfmRepository->find($id);

        if (empty($dfm)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/dfms.singular')])
            );
        }

        $dfm->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/dfms.singular')])
        );
    }
}
