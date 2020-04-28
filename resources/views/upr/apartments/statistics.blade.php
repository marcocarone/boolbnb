@extends('layouts.layout01')
@section('content')


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
	                <h3>Statistiche per l'alloggio</h3>
	                <p id="apartment-id" data-id="{{$apartment->id}}">{{$apartment->title}}</p>
	            </div>
	            <div class="right">
								<h4 class="">Intervallo</h4>

								<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 250px">
									<i class="fa fa-calendar"></i>&nbsp;
									<span></span> <i class="fa fa-caret-down"></i>
								</div>
	            </div>
	        </div>

	    </div>
	</div>

	{{-- ---- --}}

	<div class="statistic__wrapper">
			<div class="messageResult "></div>
			<canvas id="myChart"></canvas>
</div>

@endsection
