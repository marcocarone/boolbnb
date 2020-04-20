@extends('layouts.app')
@section('content')
<div class="container">

    @foreach ($apartments as $apartment)
    <div class="card mb-3" style="max-width: 100%;">
        <div class="row no-gutters">
            <div class="col-md-2 img_apart_container">
                <img src="{{asset($apartment->cover_img)}}" class="img_apart" alt="">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{$apartment->title}}</h5>
                    <p class="card-text"><small class="text-muted">{{$apartment->address}}</small></p>
                    <p class="card-text">{{$apartment->description}}</p>
                </div>
                <div class="card-body text-secondary">
                    <span class="card-title pr-2">Numero di stanze: {{$apartment->n_rooms}}</span>
                    <span class="card-title pr-2">Numero di bagni: {{$apartment->n_baths}}</span>
                    <span class="card-title pr-2">Metri quadri: {{$apartment->sq_meters}}</span>
                </div>

            </div>
            <div class="col-md-2">
                <div class="btn-group p-2 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Azioni
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route("upr.apartments.show", $apartment)}}">Modifica</a>
                        {{-- <a class="dropdown-item" href="{{route("upr.apartment.show2", $apartment)}}">Galleria immagini</a>
                        <a class="dropdown-item" href="{{route("upr.apartments.edit", $apartment)}}">Modifica</a> --}}
                        <a class="dropdown-item" href="#">Statistiche</a>
                        <a class="dropdown-item" href="#">Sponsorizza</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{route("upr.apartments.destroy", $apartment)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="dropdown-item" type="submit">Elimina</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
    @endforeach

    @endsection
