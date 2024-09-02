<?php

namespace App\Services;

use App\Http\Resources\Client as ResourcesClient;
use App\Models\CardLog;
use App\Models\Client;
use Illuminate\Support\Facades\Redis;

class CardService
{

    public function getBalance($client)
    {
        return response([
            'id'=>$client->id,
            'name'=>$client->name,
            'solde'=>$client->balanceFloat,
        ], 200);
    }

    /*
     * @param $client From Class Client
     * This method wil update the cache by the new balance for the duplicated students
     */
    public function reCacheDuplicatedCards($client): void
    {
        Redis::del('dup_' . $client->card);
        $card2 = Client::where('card', 'like', $client->card)->get();
        if ($card2) {
            $card3 = ResourcesClient::collection($card2);
            Redis::set('dup_' . $client->card, json_encode($card3));
        }
    }


    /*
* @param Model Client $client
* @param String $card Carte Rfid
* returns the list of duplicated clients from cache if cache else from the database.
*/
    public function checkDuplicated($client, $card)
    {
        $cachedup = Redis::get('dup_' . $card);
        if (isset($cachedup)) {
            $card1 = json_decode($cachedup, False);
            return response($card1, 200);
        } else {
            $card2 = Client::where('card', 'like', $card)->get();
            $card3 = ResourcesClient::collection($card2);
            if ($card2) {
                Redis::set('dup_' . $card, json_encode($card3));
            }
            return response($card3, 200);
        }
    }


    /*
 * @param Model Resto $resto
 * @param String $card Carte Rfid
 * returns Log the UnkonCard and return error 402
 */
    public function logUnknownCard($resto, $card)
    {
        $carlog = new CardLog();
        $carlog->resto_id = $resto->id;
        $carlog->status = 'unknown';
        $carlog->card = $card;
        $carlog->save();
        return response([
            'id_message' => 10,
            'message' => 'بطاقة غير صالحة'
        ], 200);
    }

    /*
     * @param String card Rfid number
     * @returns the client from the cache else from the database
     */

    public function getClient($cardd)
    {
        $cachecard = Redis::get('card_' . $cardd);
        if (isset($cachecard)) {
            $card1 = json_decode($cachecard, False);
            $card = Client::findOrFail($card1->id);
            return $card;
        } else {
            $card2 = Client::where('card', 'like', $cardd)->first();
            if ($card2) {
                Redis::set('card_' . $cardd, $card2);
            }
            return $card2;
        }
    }

    public function getClientById($id)
    {
        return Client::where('id', $id)->first();
    }

    public function getClientByUuid(string $uuid)
    {
        return Client::where('uuid', $uuid)->first();
    }


}
