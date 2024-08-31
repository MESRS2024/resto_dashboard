<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDfmRequest;
use App\Http\Requests\UpdateDfmRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DfmRepository;
use Illuminate\Http\Request;
use Flash;

class DfmController extends AppBaseController
{
    /** @var DfmRepository $dfmRepository*/
    private $dfmRepository;

    public function __construct(DfmRepository $dfmRepo)
    {
        $this->dfmRepository = $dfmRepo;
    }

    /**
     * Display a listing of the Dfm.
     */
    public function index(Request $request)
    {
        return view('dfms.index');
    }

    /**
     * Show the form for creating a new Dfm.
     */
    public function create()
    {
        return view('dfms.create');
    }

    /**
     * Store a newly created Dfm in storage.
     */
    public function store(CreateDfmRequest $request)
    {
        $input = $request->all();

        $dfm = $this->dfmRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/dfms.singular')]));

        return redirect(route('dfms.index'));
    }

    /**
     * Display the specified Dfm.
     */
    public function show($id)
    {
        $dfm = $this->dfmRepository->find($id);

        if (empty($dfm)) {
            Flash::error(__('models/dfms.singular').' '.__('messages.not_found'));

            return redirect(route('dfms.index'));
        }

        return view('dfms.show')->with('dfm', $dfm);
    }

    /**
     * Show the form for editing the specified Dfm.
     */
    public function edit($id)
    {
        $dfm = $this->dfmRepository->find($id);

        if (empty($dfm)) {
            Flash::error(__('models/dfms.singular').' '.__('messages.not_found'));

            return redirect(route('dfms.index'));
        }

        return view('dfms.edit')->with('dfm', $dfm);
    }

    /**
     * Update the specified Dfm in storage.
     */
    public function update($id, UpdateDfmRequest $request)
    {
        $dfm = $this->dfmRepository->find($id);

        if (empty($dfm)) {
            Flash::error(__('models/dfms.singular').' '.__('messages.not_found'));

            return redirect(route('dfms.index'));
        }

        $dfm = $this->dfmRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/dfms.singular')]));

        return redirect(route('dfms.index'));
    }

    /**
     * Remove the specified Dfm from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $dfm = $this->dfmRepository->find($id);

        if (empty($dfm)) {
            Flash::error(__('models/dfms.singular').' '.__('messages.not_found'));

            return redirect(route('dfms.index'));
        }

        $this->dfmRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/dfms.singular')]));

        return redirect(route('dfms.index'));
    }
}
