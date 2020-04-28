<div class="top-header-search">
    <div class="top-header__wrapper">
        <div class="top-header__left">
            <a class="logo-lg" href="{{ url('/') }}"><img src="{{url('/images/logo.svg')}}" alt="Logo boolbnb"></a>
            <a class=" parent__drop-down mobile-menu" href="#"><i class="lni lni-menu"></i></a>
            <a class="close-menu mobile-menu d-none" href="#"><i class="lni lni-close"></i></a>
            <ul class="drop-down">
                <li><a href="{{route("about")}}">Chi siamo</a></li>

            </ul>
        </div>
        <div class="top-header__center">
            <a href="{{ url('/') }}"><img src="{{url('/images/logo-simbol.svg')}}" alt="Logo boolbnb"></a>
        </div>
        <div class="top-header__right">
            <ul>

                <li class="menu__last-item"><a href="{{route("about")}}">Chi siamo</a></li>

                @guest
                <li><a href="{{ route('login') }}">{{ __('Entra') }}</a></li>
                @if (Route::has('register'))
                <li><a href="{{ route('register') }}">{{ __('Registrati') }}</a></li>
                @endif
                @else

                <li>
                    <a id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} {{ Auth::user()->surname}} <span class=""><i class="lni lni-chevron-down"></i></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-center mt-3" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route("upr.dashboard")}}">Dashboard</a>
                        <a class="dropdown-item" href="{{route("upr.message.index")}}">Messaggi</a>
                        <a class="dropdown-item" href="{{route("upr.apartments.index")}}">Gestisci gli annunci</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            {{ __('Esci') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

                <li>
                    <a class="btn__menu" href="{{route("upr.apartments.create")}}"><i class="lni lni-plus"></i>Pubblica annuncio</a>
                </li>
                @endguest

            </ul>

            <a class="login-menu" href="#"><i class="lni lni-user"></i></a>
            <a class="close-login-menu mobile-menu d-none" href="#"><i class="lni lni-close"></i></a>
            <ul class="login-menu__drop-down">

                @guest
                <li><a href="{{ route('login') }}">{{ __('Entra') }}</a></li>
                @if (Route::has('register'))
                <li><a href="{{ route('register') }}">{{ __('Registrati') }}</a></li>
                @endif
                @else

                <li class="d-flex flex-column">
                    <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        {{ Auth::user()->name }} {{ Auth::user()->surname}} <span class=""><i class="lni lni-chevron-down"></i></span>
                    </a>

                    <div class="collapse " id="collapseExample">
                        <div class="d-flex flex-column align-items-center">
                            <a class="" href="{{route("upr.dashboard")}}">Dashboard</a>
                            <a class="" href="{{route("upr.message.index")}}">Messaggi</a>
                            <a class="" href="{{route("upr.apartments.index")}}">Gestisci gli annunci</a>
                            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                {{ __('Esci') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>

                    </div>
                </li>

                <li>
                    <a class="btn__menu" href="{{route("upr.apartments.create")}}"><i class="lni lni-plus"></i>Pubblica annuncio</a>
                </li>
                @endguest

            </ul>
        </div>
    </div>
</div>
