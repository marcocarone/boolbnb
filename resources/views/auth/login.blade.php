@extends('layouts.layoutLoginRegister')

@section('content')

<div class="preloader"></div>

<div class="login-container">
    <div class="login-container__left">
        <a class="logo-lg" href="{{ url('/') }}"><img src="{{url('/images/logo.svg')}}" alt="Logo boolbnb"></a>
        <h2>I tuoi annunci e le tue ricerche sempre con te!</h2>
        <p>Cerca l'appartamento ideale tra milioni di annunci immobiliari. Filtra i risultati di ricerca per numero di stanze, numero di bagni, tipo di servizi, la presenza di balconi, giardino e ascensore.</p>
    </div>
    <div class="login-container__right">

    <div class="login-form-container">
            <ul>
              <li ><a class="active" href="#">Entra</a></li>
              <li><a href="{{ route('register') }}">Registrati</a></li>
              <li><a href="{{ url('/') }}">Home</a></li>
            </ul>
        <div class=" ">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Inserisci la tua email" required  autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Inserisci la tua password" name="password" required >

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="pretty p-default p-round p-fill">
                            <input class="checkbox " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <div class="state p-primary">
                              <label class="form-check-label" for="remember">
                                  {{ __('Ricordami') }}
                              </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 ">
                        <button type="submit" class="login__btn">
                            {{ __('Entra') }}
                        </button>
                    </div>
                    {{-- @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Hai dimenticato la Password?') }}
                        </a>
                    @endif --}}
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection
