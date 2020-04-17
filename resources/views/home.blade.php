@extends('layouts.app')
@section('content')
<div class="container">

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
