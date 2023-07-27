<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Sponsor;
use App\Models\Admin\Apartment;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BraintreeController extends Controller
{
    public function token(Request $request)
    {
        $apartment_id = $request->input('apartment_id');

        $sponsors = Sponsor::all();

        $apartment_id = $request->input('apartment_id');
        $sponsor_id = $request->input('sponsor_id');
        $duration = $request->input('duration');

        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);

        $price = $request->input('price') ?? 0;

        if ($request->input('nonce') != null) {
            $nonceFromTheClient = $request->input('nonce');

            $gateway->transaction()->sale([
                'amount' => $price,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            $apartment = Apartment::find($apartment_id);
            $sponsor = $apartment->sponsors->sortByDesc('pivot.end_date')->first();
            if ($sponsor) {
                $end_date = Carbon::parse($sponsor->pivot->end_date, 'Europe/Rome');
            } else {
                $end_date = now()->setTimezone('Europe/Rome');
            }
            DB::table('apartment_sponsor')->insert([
                'apartment_id' => $apartment_id,
                'sponsor_id' => $sponsor_id,
                'start_date' => $end_date,
                'end_date' => (clone $end_date)->addHours($duration),
            ]);
            return view('dashboard');
        } else {
            $clientToken = $gateway->clientToken()->generate();
            return view('admin.braintree', ['token' => $clientToken, 'price' => $price, 'sponsors' => $sponsors, 'apartment_id' => $apartment_id]);
        }
    }
}
