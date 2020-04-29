@extends('layouts.layout01')

@section('content')
<div class="preloader"></div>

{{-- Titolo--}}
<div class="dashboard__title bg-grey">
    <div class="wrapper">
        <div class="title">
            <div class="left">
                <h3>Ciao, {{ Auth::user()->name }} {{ Auth::user()->surname}}</h3>
            </div>
            <div class="right">
            </div>
        </div>
    </div>
</div>

{{-- ---- --}}

<div class="dashboard__content">
    <div class="wrapper">
        <div class="left">
            <div class="box">
                <ul>
                    <li><a href="{{route("upr.message.index")}}"><i class="lni lni-popup"></i>Messaggi</a></li>
                    <li><a href="{{route("upr.apartments.index")}}"><i class="lni lni-pencil-alt"></i>Gestisci gli annunci</a></li>
                    <li><a href="{{route("upr.apartments.create")}}"><i class="lni lni-plus"></i>Pubblica annuncio</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"><i class="lni lni-exit"></i>Esci</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="right">

          <div class="stat-wrapper">
            <div class="stat-box">
                <div class="left">
                    <h3>{{count($apartments)}}</h3>
                    <p>Annunci</p>
                </div>
                <div class="right">
                    <i class="lni lni-home"></i>

                </div>
            </div>
            <div class="stat-box">
                <div class="left">
                    <h3>{{count($messages)}}</h3>
                    <p>Messaggi</p>
                </div>
                <div class="right">
                    <i class="lni lni-envelope"></i>

                </div>
            </div>
            <div class="stat-box">
                <div class="left">
                    <h3>{{count($totalViews)}}</h3>
                    <p>Visualizzazioni Totali</p>
                </div>
                <div class="right">
                    <i class="lni lni-eye"></i>

                </div>
            </div>
          </div>

          <h4>Sponsorizzazioni attive</h4>
          <div class="stat-wrapper">

            {{-- @if (!$apartments->packages->isEmpty()) --}}

              <div class="table-package">

                <table class="customTable">
                  <thead >
                    <tr >
                      <th >Alloggio</th>
                      <th >Pacchetto</th>
                      <th >Durata</th>
                      <th >Price</th>

                    </tr>
                  </thead>

                  @foreach ($packageActives as  $packageActive)

                  <tbody>
                    <tr >
                      <td>{{$packageActive->title}}</td>
                      <td>{{$packageActive->name}}</td>
                      <td>{{$packageActive->duration}} ore</td>
                      <td>{{$packageActive->price}} Euro</td>

                    </tr>
                  </tbody>
                    @endforeach
                </table>
              </div>
            {{-- @endif --}}
          </div>


        </div>
    </div>
</div>


@endsection
