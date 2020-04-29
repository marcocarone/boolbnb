@extends('layouts.layout01')
@section('content')


<div class="preloader"></div>



{{-- lista appartamenti --}}
<div class="home-apartment">

    <div class="max-w">
        <h3>I tuoi annunci</h3>
        <p>Visualizza, modifica o cancella gli annunci che hai inserito</p>
    </div>
    <div class="home-apartment__wrapper">


        @foreach ($apartments as $apartment)
        <div class="home-apartment__container">
            <div class="home-apartment__box">

                <div class="thumb">
                    <div class="thumb_container">
                        <img class="img-whp" src="{{($apartment->cover_img == "storage/") ? asset("storage/images/asset/nophoto.png") : asset($apartment->cover_img) }}" alt="{{$apartment->title}}">
                    </div>



                    <div class="thmb_cntnt">
                      @foreach ($apartment->packages as $sponsored)

                      @if (!empty($sponsored->id))
                      <ul class="tag ">
                          <li class="list-inline-item">Sponsorizzato</li>
                      </ul>
                      @endif
                      @endforeach
                        <div class="action">

                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Azioni
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{route("upr.apartments.show", $apartment)}}">Modifica</a>
                                <form action="{{route("upr.apartment.statistics", $apartment)}}" method="post">
                    							@csrf
                    							@method('POST')
                    							<button class="dropdown-item" type="submit">Statistiche</button>
                    						</form>
                                <form action="{{route("upr.payment.process", $apartment)}}" method="post">
                    							@csrf
                    							@method('POST')
                    							<button class="dropdown-item" type="submit">Sponsorizza</button>
                    						</form>
                                <div class="dropdown-divider"></div>
                                <form action="{{route("upr.apartments.destroy", $apartment)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item" type="submit">Elimina</button>
                                </form>
                            </div>

                        </div>
                        <p class="fp_price">{{$apartment->price}}<small> euro</small></p>
                    </div>
                </div>
                <div class="details">
                    <div class="tc_content">
                        <div class="tc_content__height">
                            <a href="{{route("upr.apartments.show", $apartment)}}">
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

            </div>
        </div>
        @endforeach
    </div>
</div>
{{-- ---- --}}




@endsection
