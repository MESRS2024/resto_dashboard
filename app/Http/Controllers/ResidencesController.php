<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResidencesRequest;
use App\Http\Requests\UpdateResidencesRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ResidencesRepository;
use Illuminate\Http\Request;
use Flash;

class ResidencesController extends AppBaseController
{
    /** @var ResidencesRepository $residencesRepository*/
    private $residencesRepository;

    public function __construct(ResidencesRepository $residencesRepo)
    {
        $this->residencesRepository = $residencesRepo;
    }

    /**
     * Display a listing of the Residences.
     */
    public function index(Request $request)
    {
        return view('residences.index');
    }

    /**
     * Show the form for creating a new Residences.
     */
    public function create()
    {
        return view('residences.create');
    }

    /**
     * Store a newly created Residences in storage.
     */
    public function store(CreateResidencesRequest $request)
    {
        $input = $request->all();

        $residences = $this->residencesRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/residences.singular')]));

        return redirect(route('residences.index'));
    }

    /**
     * Display the specified Residences.
     */
    public function show($id)
    {
        $residences = $this->residencesRepository->find($id);

        if (empty($residences)) {
            Flash::error(__('models/residences.singular').' '.__('messages.not_found'));

            return redirect(route('residences.index'));
        }

        return view('residences.show')->with('residences', $residences);
    }

    /**
     * Show the form for editing the specified Residences.
     */
    public function edit($id)
    {
        $residences = $this->residencesRepository->find($id);

        if (empty($residences)) {
            Flash::error(__('models/residences.singular').' '.__('messages.not_found'));

            return redirect(route('residences.index'));
        }

        return view('residences.edit')->with('residences', $residences);
    }

    /**
     * Update the specified Residences in storage.
     */
    public function update($id, UpdateResidencesRequest $request)
    {
        $residences = $this->residencesRepository->find($id);

        if (empty($residences)) {
            Flash::error(__('models/residences.singular').' '.__('messages.not_found'));

            return redirect(route('residences.index'));
        }

        $residences = $this->residencesRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/residences.singular')]));

        return redirect(route('residences.index'));
    }

    /**
     * Remove the specified Residences from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $residences = $this->residencesRepository->find($id);

        if (empty($residences)) {
            Flash::error(__('models/residences.singular').' '.__('messages.not_found'));

            return redirect(route('residences.index'));
        }

        $this->residencesRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/residences.singular')]));

        return redirect(route('residences.index'));
    }
}
