<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRestoRequest;
use App\Http\Requests\UpdateRestoRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\RestoRepository;
use Illuminate\Http\Request;
use Flash;

class RestoController extends AppBaseController
{
    /** @var RestoRepository $restoRepository*/
    private $restoRepository;

    public function __construct(RestoRepository $restoRepo)
    {
        $this->restoRepository = $restoRepo;
    }

    /**
     * Display a listing of the Resto.
     */
    public function index(Request $request)
    {
        return view('restos.index');
    }

    /**
     * Show the form for creating a new Resto.
     */
    public function create()
    {
        return view('restos.create');
    }

    /**
     * Store a newly created Resto in storage.
     */
    public function store(CreateRestoRequest $request)
    {
        $input = $request->all();

        $resto = $this->restoRepository->create($input);



        Flash::success(__('messages.saved', ['model' => __('models/restos.singular')]));

        return redirect(route('restos.index'));
    }

    /**
     * Display the specified Resto.
     */
    public function show($id)
    {
        $resto = $this->restoRepository->find($id);

        if (empty($resto)) {
            Flash::error(__('models/restos.singular').' '.__('messages.not_found'));

            return redirect(route('restos.index'));
        }

        return view('restos.show')->with('resto', $resto);
    }

    /**
     * Show the form for editing the specified Resto.
     */
    public function edit($id)
    {
        $resto = $this->restoRepository->find($id);

        if (empty($resto)) {
            Flash::error(__('models/restos.singular').' '.__('messages.not_found'));

            return redirect(route('restos.index'));
        }

        return view('restos.edit')->with('resto', $resto);
    }

    /**
     * Update the specified Resto in storage.
     */
    public function update($id, UpdateRestoRequest $request)
    {
        $resto = $this->restoRepository->find($id);

        if (empty($resto)) {
            Flash::error(__('models/restos.singular').' '.__('messages.not_found'));

            return redirect(route('restos.index'));
        }

        $resto = $this->restoRepository->update($request->all(), $id);



        Flash::success(__('messages.updated', ['model' => __('models/restos.singular')]));

        return redirect(route('restos.index'));
    }

    /**
     * Remove the specified Resto from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $resto = $this->restoRepository->find($id);

        if (empty($resto)) {
            Flash::error(__('models/restos.singular').' '.__('messages.not_found'));

            return redirect(route('restos.index'));
        }

        $this->restoRepository->delete($id);



        Flash::success(__('messages.deleted', ['model' => __('models/restos.singular')]));

        return redirect(route('restos.index'));
    }


    public function editPassword($id)
    {
        $resto = $this->restoRepository->find($id);

        if (empty($resto)) {
            Flash::error(__('models/restos.singular').' '.__('messages.not_found'));

            return redirect(route('restos.index'));
        }

        return view('restos.editPassword')->with('resto', $resto);
    }

    public function editPasswordStore($id, Request $request)
    {
        $resto = $this->restoRepository->find($id);

        if (empty($resto)) {
            Flash::error(__('models/restos.singular').' '.__('messages.not_found'));

            return redirect(route('restos.index'));
        }
        $resto->password = bcrypt($request->password);
        $resto->save();

        Flash::success(__('messages.updated', ['model' => __('models/restos.singular')]));

        return redirect(route('restos.index'));
    }
}
