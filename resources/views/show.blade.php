@extends('layouts.app')

@section('content')
<div class="container">

	<div>
		<a class="btn btn-secondary mb-3" href="{{route("home")}}">Indietro</a>
	</div>
	<div class="apartment-show card m-2">
		<div class="card-body">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active slider">
						<img class="card-img-top" src="{{$apartment->cover_img)}}" alt="{{$apartment->title}}">
					</div>
					@foreach ($apartment->images as $image)
					<div class="carousel-item slider">
						<img src="{{asset('images/' . $image->img_path)}}" class="d-block w-100" alt="...">
					</div>
					@endforeach
				</div>
				<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			<div class="d-flex justify-content-between">
				<h2 class="card-title mt-3"> {{$apartment->title}}</h2>
				<h2 class="card-title mt-3 text-primary"> {{$apartment->price}} Euro</h2>
			</div>
			<p class="card-text"> {{$apartment->description}}</p>
			<div class="btn-toolbar col-md-12  mt-4 mb-2">
				<h3 class="card-text"> Servizi Aggiuntivi:</h3>
				@forelse ($apartment->services as $service)
					<h3 class="badge badge-primary m-2">{{$service->title}}</h3>
				@empty
					<p>Nessun servizio aggiuntivo</p>
				@endforelse
			</div>
		</div>
	</div>
	<div class="d-flex flex-row ">
		<div class="card m-2 col-md-2">
			<div class="card-body">
				<h4 class="card-title mt-3 text-center"> Numero stanze</h4>
				<p class="card-text text-center"> {{$apartment->n_rooms}}</p>
			</div>
		</div>
		<div class="card m-2 col-md-2">
			<div class="card-body">
				<h4 class="card-title mt-3 text-center"> Numero Bagni</h4>
				<p class="card-text text-center"> {{$apartment->n_baths}}</p>
			</div>
		</div>
		<div class="card m-2 col-md-2">
			<div class="card-body">
				<h4 class="card-title mt-3 text-center"> Metri quadri</h4>
				<p class="card-text text-center"> {{$apartment->sq_meters}}</p>
			</div>
		</div>
		<div class=" m-2 col-md-5">
			<div class="card-body coordinates" data-lat="{{$apartment->latitude}}" data-lon="{{$apartment->longitude}}">
				<h4 class="card-title mt-3 text-center"> Indirizzo</h4>
				<p class="card-text text-center"> {{$apartment->address}}</p>
			</div>
		</div>
	</div>

	<div id="map" class='map card m-2 col-md-12' data-lat="{{$apartment->latitude}}" data-lon="{{$apartment->longitude}}"></div>

	@if ( $apartment->user->id !== Auth::id())
	<div class="card m-2">
		<div class="card-body">
			<form action="{{(Auth::user()) ? route('upr.message.store') : route('guest.message.store')}}" method="post">
				@csrf
				@method('POST')
				<div class="form-group">
					<label for="exampleInputEmail1">Email</label>
					<input type="email" class="form-control " name="email"  value="{{(Auth::user()) ? Auth::user()->email : ''}}" required maxlength="90"   {{(Auth::user()) ? "readonly='readonly'" : ''}} id="exampleInputEmail1" aria-describedby="emailHelp">
					<label for="message">Messaggio</label>
					<textarea class="form-control" name="message" required minlength="10" maxlength="700" id="message" cols="30" rows="10"></textarea>
				</div>
				<input type="hidden" name="apartment_id" value="{{$apartment->id}}">
				<button class="btn btn-success" type="submit">Invia</button>
			</form>
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
			@endif
		</div>
	</div>
	@endif

	@endsection
