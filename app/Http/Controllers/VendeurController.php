<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVendeurRequest;
use App\Http\Requests\UpdateVendeurRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\VendeurRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;

class VendeurController extends AppBaseController
{
    /** @var VendeurRepository $vendeurRepository*/
    private $vendeurRepository;

    public function __construct(VendeurRepository $vendeurRepo)
    {
        $this->vendeurRepository = $vendeurRepo;
    }

    /**
     * Display a listing of the Vendeur.
     */
    public function index(Request $request)
    {
        return view('vendeurs.index');
    }

    /**
     * Show the form for creating a new Vendeur.
     */
    public function create()
    {
        return view('vendeurs.create');
    }

    /**
     * Store a newly created Vendeur in storage.
     */
    public function store(CreateVendeurRequest $request)
    {
        $input = $request->all();

        $vendeur = $this->vendeurRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/vendeurs.singular')]));

        return redirect(route('vendeurs.index'));
    }

    /**
     * Display the specified Vendeur.
     */
    public function show($id)
    {
        $vendeur = $this->vendeurRepository->find($id);

        if (empty($vendeur)) {
            Flash::error(__('models/vendeurs.singular').' '.__('messages.not_found'));

            return redirect(route('vendeurs.index'));
        }

        return view('vendeurs.show')->with('vendeur', $vendeur);
    }

    /**
     * Show the form for editing the specified Vendeur.
     */
    public function edit($id)
    {
        $vendeur = $this->vendeurRepository->find($id);

        if (empty($vendeur)) {
            Flash::error(__('models/vendeurs.singular').' '.__('messages.not_found'));

            return redirect(route('vendeurs.index'));
        }

        return view('vendeurs.edit')->with('vendeur', $vendeur);
    }

    /**
     * Update the specified Vendeur in storage.
     */
    public function update($id, UpdateVendeurRequest $request)
    {
        $vendeur = $this->vendeurRepository->find($id);

        if (empty($vendeur)) {
            Flash::error(__('models/vendeurs.singular').' '.__('messages.not_found'));

            return redirect(route('vendeurs.index'));
        }

        $vendeur = $this->vendeurRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/vendeurs.singular')]));

        return redirect(route('vendeurs.index'));
    }

    /**
     * Remove the specified Vendeur from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vendeur = $this->vendeurRepository->find($id);

        if (empty($vendeur)) {
            Flash::error(__('models/vendeurs.singular').' '.__('messages.not_found'));

            return redirect(route('vendeurs.index'));
        }

        $this->vendeurRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/vendeurs.singular')]));

        return redirect(route('vendeurs.index'));
    }

    public function stats(Request $request)
    {
        return view('vendeurs.stats.index');
    }

    public function editPassword($id)
    {
        $vendeur = $this->vendeurRepository->find($id);

        if (empty($vendeur)) {
            Flash::error(__('models/vendeurs.singular').' '.__('messages.not_found'));

            return redirect(route('vendeurs.index'));
        }

        return view('vendeurs.editPassword')->with('vendeur', $vendeur);
    }

    public function editPasswordStore($id, Request $request)
    {
        $vendeur = $this->vendeurRepository->find($id);

        if (empty($vendeur)) {
            Flash::error(__('models/vendeurs.singular').' '.__('messages.not_found'));

            return redirect(route('vendeurs.index'));
        }

        DB::transaction(function () use ($request, $vendeur) {
            $vendeur->password = bcrypt($request->password);
            $vendeur->save();
            $user = User::where('email', $vendeur->phone)->first();
            $user->password = bcrypt($request->password);
            $user->save();
        });

        Flash::success(__('messages.updated', ['model' => __('models/vendeurs.singular')]));

        return redirect(route('vendeurs.index'));
    }
}
