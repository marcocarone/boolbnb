@extends('layouts.layout01')

@section('content')

@if (session('message'))
<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12">
			<div class="alert alert-alert">
				<p>{{session('message')}}.</p>
			</div>
		</div>
	</div>
</div>
@endif




<div class="ap-show apartment-show">
	<div class="ap-show__wrapper">
		<div class="menu-left">
			<a class="btn__menu" href="{{route("upr.apartments.index")}}"><i class="lni lni-chevron-left"></i>Indietro</a>
		</div>
		<div class="menu-right">
		</div>
	</div>
</div>


{{-- Titolo--}}
<div class="ap-create-show__title bg-grey">
    <div class="wrapper">
        <div class="ap-title-price">
            <div class="left">
                <h3>Migliora la tua visibilità del tuo annuncio</h3>
                <p>Scegli tra queste offerte</p>
            </div>
            <div class="right">

            </div>
        </div>

    </div>
</div>

{{-- ---- --}}

<div class="payment__content">
	<div class="wrapper">
			<div class="left">


@if (!$apartment->packages->isEmpty())
	<h4>Sponsorizzazioni attive</h4>
	<div class="table-package">

		<table class="customTable">
			<thead >
				<tr >
					<th >Pacchetto</th>
					<th >Prezzo</th>
					<th >Durata</th>
					<th >Inizio promo</th>
					<th >Fine promo</th>
				</tr>
			</thead>
			@foreach ($packageActives as  $packageActive)

			<tbody>
				<tr >
					<td>{{$packageActive->name}}</td>
					<td>{{$packageActive->price}} Euro</td>
					<td>{{$packageActive->duration}} ore</td>
					<td>{{$packageActive->start}}</td>
					<td>{{$packageActive->end}}</td>
				</tr>
			</tbody>
				@endforeach
		</table>
	</div>
@endif


				<form method="post" id="payment-form" action="{{route('upr.payment.confirmation', $apartment)}}">
					@method('POST')
					@csrf
				<div class="box box-flex">
					@foreach ($packages as $package)
					<div class="box-spec">
						<h4 >{{$package->name}}</h4>
						<h2 >{{$package->price}}&euro;</h2>
						<p>Questo pacchetto ha una durata di
							@if ($package->id == 1)
							24 ore
							@else
							{{$package->duration / 24}} giorni
							@endif
						</p>
						<div class="pretty p-icon p-round p-pulse">
							<input class="payment-box-checked" id="package_id" type="radio"  name="package_id" min="1" placeholder="package_id" value="{{$package->id}}"/>
							<div class="state p-primary">
								<i class="icon mdi mdi-check"></i>
								<label></label>
							</div>
						</div>

					</div>
					@endforeach
				</div>

				<div class="">
					<div id="bt-dropin"></div>
					<input id="nonce" name="payment_method_nonce" type="hidden" />
					<button class="form-create__btn" type="submit">Paga</button>
				</div>
				</form>
			</div>


			<div class="right ">
				<div class="upr-show-sticky">



					<div class="home-apartment__container">
						<div class="home-apartment__box">
								<div class="thumb">
									<div class="thumb_container">
										<img class="img-whp" src="{{($apartment->cover_img == "storage/") ? asset("storage/images/asset/nophoto.png") : asset($apartment->cover_img) }}" alt="{{$apartment->title}}">
									</div>
									<div class="thmb_cntnt">
										<ul class="tag">
											<li class="list-inline-item">Sponsorizzato</li>
										</ul>
										<p id="price-append" class="fp_price">{{$apartment->price}}</p>
										<small>€</small>
									</div>
								</div>
								<div class="details">
									<div class="tc_content">
										<div class="tc_content__height">
												<h4 id="title-append" >{{$apartment->title}}</h4>
										</div>
										<p id="address-append"><span></span>{{$apartment->address}}</p>
										<ul class="prop_details">
											<li>Stanze: <strong id="room-append">{{$apartment->n_rooms}}</strong> </li>
											<li>Bagni: <strong id="bath-append">{{$apartment->n_baths}}</strong> </li>
											<li>Mq: <strong id="mq-append">{{$apartment->sq_meters}}</strong> </li>
										</ul>
									</div>
								</div>
						</div>
					</div>


				</div>
			</div>
	</div>
</div>
@endsection

@section('script')
<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>



<script>
	var form = document.querySelector('#payment-form');
	var client_token = "{{$token}}";
	braintree.dropin.create({
		authorization: client_token,
		selector: '#bt-dropin'
	}, function(createErr, instance) {
		if (createErr) {
			console.log('Create Error', createErr);
			return;
		}
		form.addEventListener('submit', function(event) {
			event.preventDefault();
			instance.requestPaymentMethod(function(err, payload) {
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
@endsection
