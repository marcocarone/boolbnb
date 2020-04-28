@extends('layouts.layout01')
@section('content')

 <div class="preloader"></div>


<div class="home-messages">

    <div class="max-w">
        <h3>Messaggi ricevuti</h3>

    </div>

    <div class="home-messages__wrapper">
        @foreach ($apartments as $apartment)


          @foreach ($apartment->messages as $message)

        <div class="msm-box">
          <div class="msm-delete">
              <form action="{{route('upr.message.destroy', $message)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn-delete" type="submit"><i class="lni lni-close"></i></button>
              </form>
          </div>
          <div class="title">
              <h4 >Appartamento: {{$message->apartment->title}}</h4>

          </div>
          <div class="msn-content">
            <p ><strong>Email del richiedente:</strong> {{$message->email}}</p>
            <p > {{$message->message}}</p>
            <small > Messaggio del: {{$message->created_at}}</small>
          </div>



        </div>

        @endforeach
        @endforeach

    </div>
</div>
{{-- ---- --}}

@endsection
