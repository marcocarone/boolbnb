@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card m-2">
        <div class="card-body">

            <h2 class="card-title mt-3"> Messaggi ricevuti</h2>
            @foreach ($apartments as  $apartment)

              @foreach ($apartment->messages as $message)

              <div class="card m-2">
                  <div class="card-body">
                    <h4 class="card-title mt-3">Appartamento: {{$message->apartment->title}}</h4>
                    <p class="card-text">Email del richiedente: {{$message->email}}</p>
                      <p class="card-text"> Messaggio: {{$message->message}}</p>
                      <p class="card-text"> Messaggio del: {{$message->created_at}}</p>

                      <form action="{{route('upr.message.destroy', $message)}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger m-1" type="submit">Elimina</button>
                      </form>
                  </div>
              </div>
              @endforeach
            @endforeach
        </div>
    </div>

    @endsection
