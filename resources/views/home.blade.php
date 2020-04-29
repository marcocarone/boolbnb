@extends('layouts.layout01')
@section('content')


<div class="preloader"></div>


<div class="home-apartment">

	<div class="max-w center">
		<h3>Cerca in modo più intelligente</h3>
		<p>Cerca un appartamento, in qualsiasi momento, tra migliaia di annunci immobiliari.</p>
	</div>
	<div class="home-apartment__wrapper">


<div class="search__box">
	<form class="search__flex" action="{{route('search.index')}}" method="post">
		<div class="prova01">
			@csrf
			@method('POST')
			<input id="address" class="form-control @error("address") is-invalid @enderror" placeholder="Cerca per città o per indirizzo" type="text" name="address" autocomplete="off" required minlength="4" maxlength="255">
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

	</div>
</div>

{{-- lista appartamenti sposorizzati--}}
<div class="home-apartment bg-grey">
	<div class="home-apartment__wrapper">
		<div class="home-apartment__heading">
			<h3>In evidenza</h3>
			<p>Ti presentiamo gli appartamenti che abbiamo selezionato per te</p>
		</div>

		  <div class="swiper-container">
		    <div class="swiper-wrapper">

					@foreach ($advApt as $apartment)

					<div class="swiper-slide home-apartment__container">
						<div class="home-apartment__box">
							<a class="stretched-link" href="{{route("apartment.show", $apartment)}}">
								<div class="thumb">
									<div class="thumb_container">
										<img class="img-whp" src="{{($apartment->cover_img == "storage/") ? asset("storage/images/asset/nophoto.png") : asset($apartment->cover_img) }}" alt="{{$apartment->title}}">
									</div>

									<div class="thmb_cntnt">
										<ul class="tag">
											<li class="list-inline-item">Sponsorizzato</li>
										</ul>
										<p class="fp_price">{{$apartment->price}}<small> euro</small></p>
									</div>
								</div>
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

		    <div class="swiper-pagination"></div>
		  </div>

	</div>
</div>

{{-- ---- --}}

{{-- lista appartamenti --}}
<div class="home-apartment">

	<div class="max-w">
		<h3>Ultimi inseriti</h3>
		<p>Ti presentiamo gli ultimi appartamenti</p>
	</div>
	<div class="home-apartment__wrapper">

		@foreach ($noAdvApt as $apartment)

		<div class="home-apartment__container">
			<div class="home-apartment__box">
				<a class="stretched-link" href="{{route("apartment.show", $apartment)}}">
					<div class="thumb">
						<div class="thumb_container">
								<img class="img-whp" src="{{($apartment->cover_img == "storage/") ? asset("storage/images/asset/nophoto.png") : asset($apartment->cover_img) }}" alt="{{$apartment->title}}">
						</div>
						<div class="thmb_cntnt">
							<p class="fp_price">{{$apartment->price}}<small> euro</small></p>
						</div>
					</div>
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
</div>
{{-- ---- --}}

@endsection

@section('script')

   <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>


	 <script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 10,

      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
			autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
				900: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
				1600: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
      }
    });
  </script>
 @endsection
