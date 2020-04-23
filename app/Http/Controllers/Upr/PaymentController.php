<?php

namespace App\Http\Controllers\upr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Braintree;
use App\Apartment;
use App\Package;
use App\ApartmentPackage;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
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

	public function process(Apartment $apartment) {

		if (empty($apartment)) {
			abort(400);
		}

		if ($apartment->user->id != Auth::user()->id) {
			abort(401);
		}

		$gateway = new Braintree\Gateway($this->braintreeConfig);

		return view('upr.payments.payment', [
			'token' => $gateway->ClientToken()->generate(),
			'packages' => Package::all(),
			'apartment' => $apartment,
		]);
	}

	public function confirmation(Apartment $apartment, Request $request) {
		$data = $request->all();
		dd($apartment);
		$gateway = new Braintree\Gateway($this->braintreeConfig);
		$result = $gateway->transaction()->sale([
			'amount' => $data['price'],
			'paymentMethodNonce' => $request->payment_method_nonce,
			'customer' => [
				'firstName' => 'Name',
				'lastName' => 'Surname',
				'email' => 'test@test.it',
			],
			'options' => [
				'submitForSettlement' => true,
			],
		]);
		if ($result->success) {
			$transaction = $result->transaction;
			$subscription = new Subscription();
			$subscription->apartament_id = $data['apartament_id'];
			$subscription->package_id = $data['package_id'];

			$subscription->start = Carbon::now();
			$hours = Package::where('id', $data['package_id'])->first();
			$subscription->end = Carbon::now()->addHours($hours->duration);
			$subscription->save();
			$message = 'La transazione con ID: ' . $transaction->id . ' è avvenuta con successo';
			return view('payments.result', compact('message'));

		} else {
			$message = 'Non è stato possibile effettuare la transazione';
			return back()->with('message', $message);
		}
	}
}
