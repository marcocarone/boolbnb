@extends('layouts.app')
@section('content')
<div class="container">

    <form class="input-group mb-3 " action="{{route('search.index')}}" method="post">
    	@csrf
    	@method('POST')
      <input id="address" class="form-control @error("address") is-invalid @enderror" placeholder="Cerca appartamento" type="text" name="address" autocomplete="off" required minlength="4" maxlength="255">
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
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Ricerca</button>
      </div>
    </form>



<div class="row d-flex justify-content-between">
    @foreach ($apartments as $apartment)
    <div class="card-deck col-md-4 mb-4">
        <div class="card">
            <div class="imgdiv">
                <a href="{{route("apartment.show", $apartment)}}" class="stretched-link"><img class="image_home" src="{{asset('storage/' . $apartment->cover_img)}}" class="card-img-top" alt="{{$apartment->title}}"></a>
            </div>

            <div class="card-body">
              <a href="{{route("apartment.show", $apartment)}}"><h5 class="card-title">{{$apartment->title}}</h5></a>
                <p class="card-text"><small class="text-muted">{{$apartment->address}}</small></p>

            </div>
            <div class="card-footer">
                <small class="text-muted">Numero di stanze: {{$apartment->n_rooms}}</small>
                <small class="text-muted">Numero di bagni: {{$apartment->n_baths}}</small>
                <small class="text-muted">Metri quadri: {{$apartment->sq_meters}}</small>
            </div>
        </div>
    </div>
    @endforeach
</div>


@endsection
