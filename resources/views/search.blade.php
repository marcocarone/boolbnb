@extends('layouts.app')

@section('content')
<div class="container">
	<form class="input-group mb-3" action="{{route('search.index')}}" method="post">
		@csrf
		@method('POST')
		<input id="address" class="form-control @error("address") is-invalid @enderror" value="{{$address}}" placeholder="Via, numero civico, città" type="text" name="address" autocomplete="off" required minlength="4" maxlength="255">
			@error("address")
		<span class="invalid-feedback d-block" role="alert">
			<strong>{{ $message }}</strong>
		</span>
			@enderror
		<div class="dropdown-address hidden">
			<ul class="list-unstyled m-0"></ul>
		</div>
		<input type="hidden" id="latitude" name="latitude" value="">
		<input type="hidden" id="longitude" name="longitude" value="">
		<div class="input-group-append">
			<button id="ricerca" class="btn btn-outline-secondary" type="submit" disabled id="button-addon2">Ricerca</button>
		</div>
	</form>
	<div class="filter_box">
		<div class="form-group col-md-12 d-flex justify-content-between services">
		<label for="services">Servizi Aggiuntivi</label>
		@foreach ($services as $service)
			<div class="m-1">
				<input class="checkbox change-filter" type="checkbox" name="checkbox" value="{{$service->id}}">
				<span>{{$service->title}}</span>
			</div>
		@endforeach
		</div>
		<div class="form-group col-md-12 d-flex justify-content-center">
			<div class="flex-grow-1">
				<label for="distance">Raggio di ricerca (Km) - </label>
				<span><strong id="distance-value">20</strong></span>
				<input type="range" class="custom-range change-filter" min="20" max="100" step="1" value="20" id="distance">
			</div>
		</div>
		<div class="form-group col-md-12 d-flex justify-content-center align-items-center">
			<p class="mb-0 mr-4">Numero minimo di stanze:</p>
			<div id="rooms_counter" class="btn-counter d-flex justify-content-center align-items-center">
				<button class="btn btn-circle rooms_minus" disabled>-</button>
				<span class="span_number_counter"><strong id="rooms_number">1</strong></span>
				<button class="btn btn-circle rooms_plus">+</button>
			</div>
			<p class="mb-0 mr-4 ml-5">Numero minimo di bagni:</p>
			<div id="baths_number" class="btn-counter d-flex justify-content-center align-items-center">
				<button class="btn btn-circle baths_minus" disabled>-</button>
				<span class="span_number_counter"><strong id="baths_counter">1</strong></span>
				<button class="btn btn-circle baths_plus">+</button>
			</div>
		</div>
	</div>
	<div class="d-flex justify-content-center messageResult"></div>
	<div id="apartments" class="row d-flex justify-content-between">
		@foreach ($apartmentsInRadius as $apartment)
		<div class="apartment card-deck col-md-4 mb-4" data-id="{{$apartment->id}}">
			<div class="card">
				<div class="imgdiv">
					<a href="{{route("apartment.show", $apartment)}}" class="stretched-link">
						<img class="image_home" src="{{asset($apartment->cover_img)}}" class="card-img-top" alt="{{$apartment->title}}">
					</a>
				</div>
				<div class="card-body coordinates" data-lat="{{$apartment->latitude}}" data-lon="{{$apartment->longitude}}">
					<a href="{{route("apartment.show", $apartment)}}">
						<h5 class="card-title">{{$apartment->title}}</h5>
					</a>
					<p class="card-text">
						<small class="text-muted">{{$apartment->address}}</small>
					</p>
				</div>
				<div class="card-footer">
					<small class="text-muted">Numero di stanze: {{$apartment->n_rooms}}</small>
					<small class="text-muted">Numero di bagni: {{$apartment->n_baths}}</small>
					<small class="text-muted">Metri quadri: {{$apartment->sq_meters}}</small>
					<small class="text-muted">Prezzo: {{$apartment->price}}€</small>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<div id="map" class='map card m-2 col-md-12' data-lat="{{$centerLatitude}}" data-lon="{{$centerLongitude}}"></div>
</div>

<script id="entry-template" type="text/x-handlebars-template">
	<div class="apartment card-deck col-md-4 mb-4" data-id="@{{id}}">
		<div class="card">
			<div class="imgdiv">
				<a href="@{{show_route}}" class="stretched-link">
					<img class="image_home" src="@{{cover_img}}" class="card-img-top" alt="@{{title}}">
				</a>
			</div>
			<div  class="card-body coordinates" data-lat="@{{latitude}}" data-lon="@{{longitude}}">
				<a href="@{{show_route}}">
					<h5 class="card-title">@{{title}}</h5>
				</a>
				<p class="card-text">
					<small class="text-muted">@{{address}}</small>
				</p>
			</div>
			<div class="card-footer">
				<small class="text-muted">Numero di stanze: @{{n_rooms}}</small>
				<small class="text-muted">Numero di bagni: @{{n_baths}}</small>
				<small class="text-muted">Metri quadri: @{{sq_meters}}</small>
				<small class="text-muted">Prezzo: @{{price}}€</small>
			</div>
		</div>
	</div>
</script>

@endsection