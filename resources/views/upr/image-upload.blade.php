 @extends('layouts.layout-upload-image')
 @section('content')


 <div class="preloader"></div>


 {{-- Titolo--}}
 <div class="ap-create-show__title bg-grey">
     <div class="wrapper">
         <div class="ap-title-price">
             <div class="left">
                 <h3>Galleria Fotografica</h3>
                 <p>Aggiungi una galleria fotografica al tuo annuncio.</p>
             </div>
             <div class="right">

             </div>
         </div>

     </div>
 </div>

 {{-- ---- --}}

 <div class="ap-create-show__title ">
     <div class="wrapper">
         <form method="post" action="{{ route('upr.images.store') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
             <input type="hidden" name="apartmentId" value="{{$apartmentId}}">
             @csrf
         </form>
         <div class="">
             <a class="gallery-btn" href="{{route("upr.apartments.index")}}">Salva appartamento</a>
         </div>


     </div>
 </div>


 @endsection
