@extends('layouts.app')

@section('content')
	<div class="container mt-5">
		<div class="row">
			<div class="col-xl-12">
				<p>{{$apartment->title}}</p>
				<form method="post" id="payment-form" action="{{route('upr.payment.confirmation', $apartment)}}">
					@method('POST')
					@csrf
					<label for="price">
						<div>
							<strong>Migliora la tua visibilità del tuo annuncio scegliendo fra i seguenti pacchetti:</strong>
							@foreach ($packages as $package)
								<div>
									<input class="radio" type="radio" id="price" name="price" min="1" placeholder="Price" value="{{$package->price}}">
									<strong>{{$package->name}}: </strong>
									<span>Questo pacchetto ha una durata di
									@if ($package->id == 1) 
										24 ore
									@else
										{{$package->duration / 24}} giorni 
									@endif
									per {{$package->price}}&euro;</span> 
									<input type="hidden" name="package_id" value="{{$package->id}}">
								</div>
							@endforeach
						</div>
					</label>
					<div>
						<div id="bt-dropin"></div>
					</div>
				<input id="nonce" name="payment_method_nonce" type="hidden"/>
				<button class="btn btn-primary" type="submit">Paga</button>
				</form>
			<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
			<script >
			var form = document.querySelector('#payment-form');
			var client_token = "{{$token}}";
			braintree.dropin.create({
					authorization: client_token,
					selector: '#bt-dropin'
				}, function (createErr, instance) {
				if (createErr) {
					console.log('Create Error', createErr);
					return;
				}
				form.addEventListener('submit', function (event) {
					event.preventDefault();
					instance.requestPaymentMethod(function (err, payload) {
						if (err) {
							console.log('Request Payment Method Error', err);
							return;
						}
						document.querySelector('#nonce').value = payload.nonce;
						form.submit();
					});
				});
			});
			</script>
		</div>
	</div>
@endsection
