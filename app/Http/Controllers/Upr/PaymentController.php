<?php

namespace App\Http\Controllers\upr;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\GetViews;

use Carbon\Carbon;
use Braintree;
use App\Apartment;
use App\Package;
use App\ApartmentPackage;
use DB;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use GetViews;
    private $braintreeConfig;

    public function __construct()
    {
        $this->braintreeConfig = [
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ];
    }

    public function process(Apartment $apartment)
    {
        if (empty($apartment)) {
            abort(400);
        }

        if ($apartment->user->id != Auth::user()->id) {
            abort(401);
        }

        $gateway = new Braintree\Gateway($this->braintreeConfig);

        $packageActive = DB::table('packages')
            ->join('apartment_package', 'packages.id', '=', 'apartment_package.package_id')
            ->where('apartment_id', $apartment->id)
            ->get();



        return view('upr.payments.payment', [
            'token' => $gateway->ClientToken()->generate(),
            'packages' => Package::all(),
            "packageActives" => $packageActive,
            'apartment' => $apartment,
        ]);
    }

    public function confirmation(Apartment $apartment, Request $request)
    {
        if (empty($apartment)) {
            abort(400);
        }

        if ($apartment->user->id != Auth::user()->id) {
            abort(401);
        }

        $request->validate([
            'package_id' => 'numeric|required',
            'payment_method_nonce' => 'string|required',
        ]);

        $data = $request->all();

        $gateway = new Braintree\Gateway($this->braintreeConfig);
        $result = $gateway->transaction()->sale([
            'amount' => Package::find($data['package_id'])->price,
            'paymentMethodNonce' => $data['payment_method_nonce'],
            'customer' => [
                'firstName' => Auth::user()->name,
                'lastName' => Auth::user()->surname,
                'email' => Auth::user()->email,
            ],
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);
        if ($result->success) {
            $transaction = $result->transaction;
            $subscription = new ApartmentPackage();
            $subscription->apartment_id = $apartment->id;
            $subscription->package_id = $data['package_id'];
            $subscription->start = Carbon::now();
            if (ApartmentPackage::where('apartment_id', $apartment->id)->latest()->first()) {
                $checkSubscription = ApartmentPackage::where('apartment_id', $apartment->id)->latest()->first()->end;
                $endOfPrevSub = Carbon::parse($checkSubscription);
                if ($endOfPrevSub->gt(Carbon::now())) {
                    $subscription->start = $endOfPrevSub;
                }
            }
            $hours = Package::where('id', $data['package_id'])->first()->duration;
            $subscription->end = Carbon::parse($subscription->start)->addHours($hours);
            $subscription->transaction_id = $transaction->id;
            $subscription->save();
            $data = [
                'message' => 'La transazione con ID: ' . $transaction->id . ' è avvenuta con successo',
                'apartment' => $apartment,
                'views' => $this->GetViews($apartment->id)
            ];
            return view('upr.apartments.show', $data);
        } else {
            $message = 'Non è stato possibile effettuare la transazione';
            return back()->with('message', $message);
        }
    }
}
