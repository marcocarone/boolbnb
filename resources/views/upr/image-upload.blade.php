 @extends('layouts.uploadImage')
 @section('content')


 <div class="container">
     <div class="row">

         <div class="col-md-12">
             {{-- @dd($apartmentId) --}}
             <h2>Galleria Fotografica</h2>
             <p>Puoi aggiungere una galleria fotografica nel tuo annuncio. Puoi selezionare e salvare più file contemporaneamente</p>
             <form method="post" action="{{ route('upr.images.store') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                 <input type="hidden" name="apartmentId" value="{{$apartmentId}}">
                 @csrf
             </form>
             <a class="btn btn-primary mt-3" href="{{route("upr.apartments.index")}}">Salva appartamento</a>
         </div>
     </div>
 </div>

 @endsection
