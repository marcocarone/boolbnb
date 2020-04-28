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
                <li ><a class="active" href="#">Registrati</a></li>
                <li><a href="{{ route('login') }}">Entra</a></li>
                <li><a href="{{ url('/') }}">Home</a></li>
              </ul>
          <div class=" ">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nome" value="{{ old('name') }}" required autocomplete="name" autofocus maxlength="20">

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="form-group">
                  <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" placeholder="Cognome" name="surname"
                    value="{{ old('surname') }}" required autofocus maxlength="20">

                  @error('surname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="form-group">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="form-group">
                  <input id="date_of_birth" type="date"  aria-describedby="data-descr" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" autocomplete="date_of_birth" placeholder="Data di nascita" autofocus min="1930-02-02"
                  > <small id="data-descr" class="form-text text-muted">Inserisci la tua data di nascita.</small>
                  @error('date_of_birth')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="form-group">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"  name="password" required autocomplete="new-password">

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="form-group">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Conferma Password" required autocomplete="new-password">
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 ">
                        <button type="submit" class="login__btn">
                            {{ __('Registrati') }}
                        </button>
                    </div>
                </div>

@endsection
