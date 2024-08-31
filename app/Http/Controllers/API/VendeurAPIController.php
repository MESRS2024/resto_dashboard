<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVendeurAPIRequest;
use App\Http\Requests\API\UpdateVendeurAPIRequest;
use App\Models\Vendeur;
use App\Repositories\VendeurRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\VendeurResource;

/**
 * Class VendeurAPIController
 */
class VendeurAPIController extends AppBaseController
{
    /** @var  VendeurRepository */
    private $vendeurRepository;

    public function __construct(VendeurRepository $vendeurRepo)
    {
        $this->vendeurRepository = $vendeurRepo;
    }

    /**
     * Display a listing of the Vendeurs.
     * GET|HEAD /vendeurs
     */
    public function index(Request $request): JsonResponse
    {
        $vendeurs = $this->vendeurRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            VendeurResource::collection($vendeurs),
            __('messages.retrieved', ['model' => __('models/vendeurs.plural')])
        );
    }

    /**
     * Store a newly created Vendeur in storage.
     * POST /vendeurs
     */
    public function store(CreateVendeurAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $vendeur = $this->vendeurRepository->create($input);

        return $this->sendResponse(
            new VendeurResource($vendeur),
            __('messages.saved', ['model' => __('models/vendeurs.singular')])
        );
    }

    /**
     * Display the specified Vendeur.
     * GET|HEAD /vendeurs/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Vendeur $vendeur */
        $vendeur = $this->vendeurRepository->find($id);

        if (empty($vendeur)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/vendeurs.singular')])
            );
        }

        return $this->sendResponse(
            new VendeurResource($vendeur),
            __('messages.retrieved', ['model' => __('models/vendeurs.singular')])
        );
    }

    /**
     * Update the specified Vendeur in storage.
     * PUT/PATCH /vendeurs/{id}
     */
    public function update($id, UpdateVendeurAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Vendeur $vendeur */
        $vendeur = $this->vendeurRepository->find($id);

        if (empty($vendeur)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/vendeurs.singular')])
            );
        }

        $vendeur = $this->vendeurRepository->update($input, $id);

        return $this->sendResponse(
            new VendeurResource($vendeur),
            __('messages.updated', ['model' => __('models/vendeurs.singular')])
        );
    }

    /**
     * Remove the specified Vendeur from storage.
     * DELETE /vendeurs/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Vendeur $vendeur */
        $vendeur = $this->vendeurRepository->find($id);

        if (empty($vendeur)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/vendeurs.singular')])
            );
        }

        $vendeur->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/vendeurs.singular')])
        );
    }
}
