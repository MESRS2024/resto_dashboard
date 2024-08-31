<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateclientsRequest;
use App\Http\Requests\UpdateclientsRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ClientsRepository;
use Illuminate\Http\Request;
use Flash;

class ClientsController extends AppBaseController
{
    /** @var clientsRepository $clientsRepository*/
    private ClientsRepository $clientsRepository;

    public function __construct(clientsRepository $clientsRepo)
    {
        $this->clientsRepository = $clientsRepo;
    }

    /**
     * Display a listing of the clients.
     */
    public function index(Request $request)
    {
        return view('clients.index');
    }

    /**
     * Show the form for creating a new clients.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created clients in storage.
     */
    public function store(CreateclientsRequest $request)
    {
        $input = $request->all();

        $clients = $this->clientsRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/clients.singular')]));

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified clients.
     */
    public function show($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            Flash::error(__('models/clients.singular').' '.__('messages.not_found'));

            return redirect(route('clients.index'));
        }

        return view('clients.show')->with('clients', $clients);
    }

    /**
     * Show the form for editing the specified clients.
     */
    public function edit($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            Flash::error(__('models/clients.singular').' '.__('messages.not_found'));

            return redirect(route('clients.index'));
        }

        return view('clients.edit')->with('clients', $clients);
    }

    /**
     * Update the specified clients in storage.
     */
    public function update($id, UpdateclientsRequest $request)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            Flash::error(__('models/clients.singular').' '.__('messages.not_found'));

            return redirect(route('clients.index'));
        }

        $clients = $this->clientsRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/clients.singular')]));

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified clients from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            Flash::error(__('models/clients.singular').' '.__('messages.not_found'));

            return redirect(route('clients.index'));
        }

        $this->clientsRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/clients.singular')]));

        return redirect(route('clients.index'));
    }
}
