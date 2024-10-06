<?php

namespace App\Services;

use App\Models\Flixy;
use Flash;

class VendeurService
{
    private function isEnoughBalance($seller, $amount): bool
    {
        if(get_class($seller) == 'App\Models\User'){
            if($seller->hasRole('dfm_onou'))
                return true;
        }
        return ($seller->balance >= $amount);
    }

    public function execute($seller, $client,$amount)
    {

        try {

            if (!$client)
            {
                Flash::error(__('messages.not_found'));

                return redirect(route('vendeurs.index'));
            };

            if (!$this->isEnoughBalance($seller,$amount))
            {

                Flash::error(__('messages.Enough_balance'));

                return redirect(route('vendeurs.index'));
            };

            return $this->hundle($seller, $client,$amount);

        }catch (\Exception $exception){
            return $this->ErrorMessage($seller,$exception->getMessage());
        }
    }


    private function hundle($seller, $client, $solde)
    {
        try {
            if(get_class($seller) == 'App\Models\User'){
                if ($seller->hasRole('dfm_onou'))
                    return $this->moveSolveOnou($seller, $client, $solde);
            }

            if(get_class($seller) == 'App\Models\Dfm')
                return $this->moveSolveDFM($seller, $client, $solde);

            else
                return $this->moveSolveResller($seller, $client, $solde);

        }catch (\Exception $exception){
            return $this->ErrorMessage($seller,$exception->getMessage());
        }
    }


    private function moveSolveResller($seller, $client, $solde)
    {
        $seller->transfer($client,$solde, ['action' => 'Rechargement du solde','admin_type' => 'vendeur','admin_id' => auth()->user()->id,'owner_type' => 'Client','owner_id' => $client->id]);
        $transaction = Flixy::create([
            'resto_id' => $seller->resto->id,
            'vendeur_id' => $seller->id,
            'client_id' => $client->id,
            'amount' => $solde,
        ]);

        return redirect()->route('vendeurs.index')->with('success', 'تمت العملية بنجاح');
    }

    private function moveSolveDFM($seller, $client, $solde)
    {
        $seller->transfer($client,$solde, ['action' => 'Rechargement du solde','admin_type' => 'daf','admin_id' => auth()->user()->id,'owner_type' => 'Client','owner_id' => $client->id]);
        return redirect()->route('vendeurs.index')->with('success', 'تمت العملية بنجاح');
    }

    private function moveSolveOnou($seller, $client, $solde)
    {
        $seller->forceTransfer($client,$solde, ['action' => 'Rechargement du solde','admin_type' => 'onou','admin_id' => auth()->user()->id,'owner_type' => 'DFM','owner_id' => $client->id]);
        Flash::success(__('messages.success'));
        return redirect()->route('dfms.index');
    }

    /*
  * @return error message
  */
    private function ErrorMessage($client, $message)
    {
        Flash::error($message);
        return redirect(route('vendeurs.index'));

    }



}
