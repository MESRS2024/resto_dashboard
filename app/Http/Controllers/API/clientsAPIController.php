<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateclientsAPIRequest;
use App\Http\Requests\API\UpdateclientsAPIRequest;
use App\Models\clients;
use App\Repositories\clientsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\clientsResource;

/**
 * Class clientsAPIController
 */
class clientsAPIController extends AppBaseController
{
    /** @var  clientsRepository */
    private $clientsRepository;

    public function __construct(clientsRepository $clientsRepo)
    {
        $this->clientsRepository = $clientsRepo;
    }

    /**
     * Display a listing of the clients.
     * GET|HEAD /clients
     */
    public function index(Request $request): JsonResponse
    {
        $clients = $this->clientsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            clientsResource::collection($clients),
            __('messages.retrieved', ['model' => __('models/clients.plural')])
        );
    }

    /**
     * Store a newly created clients in storage.
     * POST /clients
     */
    public function store(CreateclientsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $clients = $this->clientsRepository->create($input);

        return $this->sendResponse(
            new clientsResource($clients),
            __('messages.saved', ['model' => __('models/clients.singular')])
        );
    }

    /**
     * Display the specified clients.
     * GET|HEAD /clients/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var clients $clients */
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/clients.singular')])
            );
        }

        return $this->sendResponse(
            new clientsResource($clients),
            __('messages.retrieved', ['model' => __('models/clients.singular')])
        );
    }

    /**
     * Update the specified clients in storage.
     * PUT/PATCH /clients/{id}
     */
    public function update($id, UpdateclientsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var clients $clients */
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/clients.singular')])
            );
        }

        $clients = $this->clientsRepository->update($input, $id);

        return $this->sendResponse(
            new clientsResource($clients),
            __('messages.updated', ['model' => __('models/clients.singular')])
        );
    }

    /**
     * Remove the specified clients from storage.
     * DELETE /clients/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var clients $clients */
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/clients.singular')])
            );
        }

        $clients->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/clients.singular')])
        );
    }
}
