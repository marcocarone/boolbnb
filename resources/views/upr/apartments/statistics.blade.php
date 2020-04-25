@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 id="apartment-id" data-id="{{$apartment->id}}">{{$apartment->title}}</h2>
            </div>
            <div class="col-12">
                <canvas id="myChart" max-width="400" max-height="400"></canvas>
            </div>
        </div>
    </div>
@endsection