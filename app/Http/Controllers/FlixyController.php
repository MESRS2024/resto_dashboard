<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Http\Requests\FlixyRequests\{clientBalanceRequest,
    CountTransactionPerDouRequest,
    CountTransactionRequest,
    FlixyByCardRequest,
    FlixyByIdRequest,
    FlixyByPhoneRequest};
use App\Services\CardService;
use App\Services\DfmService;
use App\Services\VendeurService;
use App\Models\Flixy;
use Carbon\Carbon;
use Flash;

class FlixyController extends Controller
{


    public function clientBalance(clientBalanceRequest $request)
    {
        $client =  (new CardService())->getClient($request->input('card'));

        if(!$client)  return response(['message' => 'مستعمل غير موجود'], 200);

        if  ($client->duplicate) return (new CardService())->checkDuplicated($client, $request->input('card'));

        return (new CardService())->getBalance($client);
    }

    public function moveSoldByRfid(FlixyByCardRequest $request)
    {
        $solde =$request->input('solde') * 100;

        $seller = auth()->user();

        $client =  (new CardService())->getClient($request->input('card'));

        if(!$client)
        {
            return response(['message' => 'مستعمل غير موجود'], 200);
        }

        if ($client->duplicate) return (new CardService())->checkDuplicated($client, $request->input('card'));

        return (new VendeurService())->execute($seller, $client, $solde);

    }

    public function moveSoldeId(FlixyByIdRequest $request)
    {
        $solde =$request->input('solde') *100;

        $seller = auth()->user();

        $client =  (new CardService())->getClientById($request->input('id'));

        if(!$client)  return response(['message' => 'مستعمل غير موجود'], 402);

        $responce = (new VendeurService())->execute($seller, $client, $solde);

        if($responce->status()===200)

            (new CardService())->reCacheDuplicatedCards($client);

        return $responce;

    }

    public function moveSoleToSellerCreate(){
        return view('flixy.create');
    }
    public function moveSoleToSeller(FlixyByPhoneRequest $request)
    {
        $solde =$request->input('solde') * 100;


        $reSeller = (
                new DfmService())->getSeller($request->input('phone'),
                auth()->user()->code_dou
            );

        if(!$reSeller)
            {
                Flash::error(__('models/clients.singular').' '.__('messages.not_found'));

                return redirect(route('vendeurs.index'));
            };

        return (new VendeurService())->execute(auth()->user(), $reSeller, $solde);

    }
    public function countTransactions(CountTransactionRequest $request)
    {
        $data = Flixy::byVendeur($request->input('vendeure'))->byDate($request->input('date'))->get();

        return response()->json(collect([
                        'date' => $request->input('date'),
                        'Number_of_transactions'=>$data->count(),
                        'Somme'=>$data->sum('amount')/100 . ' DZD',
                    ]));
    }

    public function countMyTransactions()
    {
        $currentDate = Carbon::now()->format('Y-m-d');

        $data = Flixy::byVendeur(auth()->user()->id)->byDate($currentDate)->get();

        return response()->json(collect([
                        'date' => $currentDate,
                        'Number_of_transactions'=>$data->count(),
                        'Somme'=>$data->sum('amount')/100 . ' DZD',
                    ]));
    }



    public function transactionsPerDateDou(CountTransactionPerDouRequest $request)
    {
        return response()->json(
            collect(
                Flixy::byGroupeDate($request->input('dou_code'))->get()
            )
        );
    }

    public function transactionsPerDateDouDFM()
    {
        return response()->json(
            collect(
                Flixy::byGroupeDate(auth()->user()->dou_code)->get()
            )
        );
    }


}