@extends('layouts.layoutSearch')
<div class="preloader"></div>

@section('content')

<div class="search-container">
	<div class="left">
		<div class="search__box">
			<form class="search__flex" action="{{route('search.index')}}" method="post">
				<div class="prova01">
					@csrf
					@method('POST')
					<input id="address" class="form-control @error("address") is-invalid @enderror" value="{{$address}}" placeholder="Cerca per città o per indirizzo" type="text" name="address" autocomplete="off" required minlength="4" maxlength="255">
						@error("address")
							<span class="invalid-feedback d-block" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
						<button id="ricerca" class="search__btn-disabled" type="submit" disabled ><i class="icon lni lni-search-alt"></i>Cerca</button>
				</div>
				<div class="dropdown-address hidden">
					<ul class="list-unstyled"></ul>
				</div>
				<input type="hidden" id="latitude" name="latitude" value="">
				<input type="hidden" id="longitude" name="longitude" value="">
				<div class="input-group-append">
				</div>
			</form>
		</div>

{{-- filtri --}}
<a class="btn__filter" data-toggle="collapse" data-target="#collapse-filter" aria-expanded="false" aria-controls="collapse-filter" href=""><i class="lni lni-plus"></i>Filtri</a>

<div class="collapse" id="collapse-filter">
	{{-- servizi --}}
	<div class="search-services">
		<h4>Servizi</h4>
		<div class="collapse-service">
			<div class="box-service">
				@foreach ($services as $service)
				<div class="service">
					<div class="pretty p-default  p-round p-fill ">
						<input type="checkbox" class=" checkbox change-filter" name="services[]" value="{{$service->id}}" />
						<div class="state p-primary">
							<label>{{$service->title}}</label>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

	{{-- ricerca raggio --}}

		<div class="range-filter">
			<label for="distance">Raggio di ricerca <strong id="distance-value">20</strong> Km</label>
			<input type="range" class="custom-range change-filter" min="20" max="100" step="1" value="20" id="distance">
		</div>


	{{-- ricerca stanze bagni --}}
	<div class="box-filter-room-bath">
		<div class="d-flex justify-content-between">
			<div class="left-box">
				<p class="box-title">Numero minimo di stanze</p>
			</div>
			<div id="rooms_counter" class="btn-counter d-flex justify-content-center align-items-center">
				<button class="btn btn-circle rooms_minus" disabled>-</button>
				<span class="span_number_counter"><strong id="rooms_number">1</strong></span>
				<button class="btn btn-circle rooms_plus">+</button>
			</div>
		</div>

		<div class="d-flex justify-content-between">
			<div class="left-box">
				<p class="">Numero minimo di bagni</p>
			</div>
			<div id="baths_number" class="btn-counter d-flex justify-content-center align-items-center">
				<button class="btn btn-circle baths_minus" disabled>-</button>
				<span class="span_number_counter"><strong id="baths_counter">1</strong></span>
				<button class="btn btn-circle baths_plus">+</button>
			</div>
		</div>
	</div>
</div>

{{-- risultato handlebar --}}
<div class="home-apartment__container messageResult"></div>



{{-- stampa appartamenti --}}

<div id="apartments" class="home-apartment__container">

	@foreach ($sponsoredApartments as $apartment)
		<div class="apartment home-apartment__box" data-id="{{$apartment->id}}">
			<div class="thumb">
				<div class="thumb_container imgdiv">
					<a href="{{route("apartment.show", $apartment)}}" class="stretched-link">
						<img class="img-whp image_home card-img-top" src="{{($apartment->cover_img == "storage/") ? asset("storage/images/asset/nophoto.png") : asset($apartment->cover_img) }}" alt="{{$apartment->title}}">
					</a>
				</div>

				<div class="thmb_cntnt">
					<ul class="tag ">
							<li class="list-inline-item">Sponsorizzato</li>
					</ul>
					<p class="fp_price">{{$apartment->price}}<small> euro</small></p>
				</div>
			</div>
			<div class=" coordinates" data-lat="{{$apartment->latitude}}" data-lon="{{$apartment->longitude}}">
				<a class="stretched-link" href="{{route("apartment.show", $apartment)}}">

					<div class="details">
						<div class="tc_content">
							<div class="tc_content__height">
								<a href="{{route("apartment.show", $apartment)}}">
									<h4>{{$apartment->title}}</h4>
								</a>

							</div>

							<p><span></span> {{$apartment->address}}</p>
							<ul class="prop_details">
								<li>Stanze: {{$apartment->n_rooms}}</li>
								<li>Bagni: {{$apartment->n_baths}}</li>
								<li>Mq: {{$apartment->sq_meters}}</li>
							</ul>
						</div>
					</div>

				</a>
			</div>
		</div>


	@endforeach

	@foreach ($apartmentsInRadius as $apartment)

	<div class="apartment home-apartment__box" data-id="{{$apartment->id}}">

		<div class="thumb">
			<div class="thumb_container imgdiv">
				<a href="{{route("apartment.show", $apartment)}}" class="stretched-link">
					<img class="img-whp image_home card-img-top" src="{{($apartment->cover_img == "storage/") ? asset("storage/images/asset/nophoto.png") : asset($apartment->cover_img) }}" alt="{{$apartment->title}}">
				</a>
			</div>

			<div class="thmb_cntnt">

				<p class="fp_price">{{$apartment->price}}<small> euro</small></p>
			</div>
		</div>



		<div class=" coordinates" data-lat="{{$apartment->latitude}}" data-lon="{{$apartment->longitude}}">
			<a class="stretched-link" href="{{route("apartment.show", $apartment)}}">

				<div class="details">
					<div class="tc_content">
						<div class="tc_content__height">
							<a href="{{route("apartment.show", $apartment)}}">
								<h4>{{$apartment->title}}</h4>
							</a>

						</div>

						<p><span></span> {{$apartment->address}}</p>
						<ul class="prop_details">
							<li>Stanze: {{$apartment->n_rooms}}</li>
							<li>Bagni: {{$apartment->n_baths}}</li>
							<li>Mq: {{$apartment->sq_meters}}</li>
						</ul>
					</div>
				</div>

			</a>
		</div>
	</div>
	@endforeach
</div>

<script id="entry-template" type="text/x-handlebars-template">
	<div class="apartment home-apartment__box" data-id="@{{id}}">

		<div class="thumb">
			<div class="thumb_container imgdiv">
				<a href="@{{show_route}}" class="stretched-link">
					<img class="img-whp image_home card-img-top" src="@{{cover_img}}" alt="@{{title}}">
				</a>
			</div>

			<div class="thmb_cntnt">

				@{{#if sponsored}}
					<ul class="tag">
						<li class="list-inline-item">Sponsorizzato</li>
					</ul>
				@{{/if}}

				<p class="fp_price">@{{price}}<small> euro</small></p>
			</div>
		</div>

		<div class=" coordinates" data-lat="@{{latitude}}" data-lon="@{{longitude}}">
			<a class="stretched-link" href="@{{show_route}}">

				<div class="details">
					<div class="tc_content">
						<div class="tc_content__height">
							<a href="@{{show_route}}">
								<h4>@{{title}}</h4>
							</a>

						</div>

						<p><span></span>@{{address}}</p>
						<ul class="prop_details">
							<li>Stanze: @{{n_rooms}}</li>
							<li>Bagni: @{{n_baths}}</li>
							<li>Mq: @{{sq_meters}}</li>
						</ul>
					</div>
				</div>

			</a>
		</div>
	</div>
	</script>



{{-- --- --}}
	</div>

	<div class="right hidden-map">
		<div id="map" class='map' data-lat="{{$centerLatitude}}" data-lon="{{$centerLongitude}}"></div>
	</div>
</div>

	@endsection
