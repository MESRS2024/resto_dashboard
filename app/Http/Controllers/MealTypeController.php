<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMealTypeRequest;
use App\Http\Requests\UpdateMealTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\MealTypeRepository;
use Illuminate\Http\Request;
use Flash;

class MealTypeController extends AppBaseController
{
    /** @var MealTypeRepository $mealTypeRepository*/
    private $mealTypeRepository;

    public function __construct(MealTypeRepository $mealTypeRepo)
    {
        $this->mealTypeRepository = $mealTypeRepo;
    }

    /**
     * Display a listing of the MealType.
     */
    public function index(Request $request)
    {
        return view('meal_types.index');
    }

    /**
     * Show the form for creating a new MealType.
     */
    public function create()
    {
        return view('meal_types.create');
    }

    /**
     * Store a newly created MealType in storage.
     */
    public function store(CreateMealTypeRequest $request)
    {
        $input = $request->all();

        $mealType = $this->mealTypeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/mealTypes.singular')]));

        return redirect(route('meal-types.index'));
    }

    /**
     * Display the specified MealType.
     */
    public function show($id)
    {
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            Flash::error(__('models/mealTypes.singular').' '.__('messages.not_found'));

            return redirect(route('meal-types.index'));
        }

        return view('meal_types.show')->with('mealType', $mealType);
    }

    /**
     * Show the form for editing the specified MealType.
     */
    public function edit($id)
    {
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            Flash::error(__('models/mealTypes.singular').' '.__('messages.not_found'));

            return redirect(route('meal-types.index'));
        }

        return view('meal_types.edit')->with('mealType', $mealType);
    }

    /**
     * Update the specified MealType in storage.
     */
    public function update($id, UpdateMealTypeRequest $request)
    {
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            Flash::error(__('models/mealTypes.singular').' '.__('messages.not_found'));

            return redirect(route('meal-types.index'));
        }

        $mealType = $this->mealTypeRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/mealTypes.singular')]));

        return redirect(route('meal-types.index'));
    }

    /**
     * Remove the specified MealType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            Flash::error(__('models/mealTypes.singular').' '.__('messages.not_found'));

            return redirect(route('meal-types.index'));
        }

        $this->mealTypeRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/mealTypes.singular')]));

        return redirect(route('meal-types.index'));
    }
}
