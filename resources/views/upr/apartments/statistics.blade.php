@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 d-flex justify-content-center">
				<h2 id="apartment-id" data-id="{{$apartment->id}}">{{$apartment->title}}</h2>
			</div>
			<div class="col-12 d-flex justify-content-center mt-5">
				<h3 class="mr-5 mb-0">Intervallo:</h3>
				<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 250px">
					<i class="fa fa-calendar"></i>&nbsp;
					<span></span> <i class="fa fa-caret-down"></i>
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-12">
				<canvas id="myChart" width="100%"></canvas>
			</div>
		</div>
	</div>
@endsection