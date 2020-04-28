 @extends('layouts.layout-upload-image')
 @section('content')

 <div class="preloader"></div>


 <div class="ap-show">
     <div class="ap-show__wrapper">
         <div class="menu-left">
             <a class="btn__menu" href="{{route("upr.apartments.show", $apartment)}}"><i class="lni lni-chevron-left"></i>Indietro</a>
         </div>
         <div class="menu-right">

             <a class="ap__btn" data-toggle="modal" data-target="#exampleModalScrollable" href="°">Aggiungi foto</a>

             <!-- Modal -->
             <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-scrollable" role="document">
                     <div class="modal-content">
                         <div class="modal-header">

                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-body">
                             <form method="post" action="{{ route('upr.images.store') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                 <input type="hidden" name="apartmentId" value="{{$apartment->id}}">
                                 @csrf
                             </form>

                             <a class="ap__btn" href="{{route("upr.apartment.show2", $apartment)}}">Salva</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 {{-- galleria immagini --}}
 <div class="home-apartment">

     <div class="max-w">
         <h3>Galleria immagini</h3>
         <p>Aggiungi delle immagini all'annuncio</p>
     </div>
     <div class="home-apartment__wrapper">

         @foreach ($apartment->images as $image)

         <div class="swiper-slide home-apartment__container">
             <div class="home-apartment__box">

                 <div class="thumb">
                     <div class="thumb_container">
                         <img class="img-whp" src="{{asset('images/' . $image->img_path)}}" alt="">
                     </div>

                     <div class="thmb_cntnt">
                         <div class="tag-gallery">


                             <form action="{{route("upr.images.destroy", $image)}}" method="post">
                                 @csrf
                                 @method('DELETE')
                                 <button class="gallery-btn" type="submit"><i class="lni lni-close"></i></button>
                             </form>


                         </div>

                     </div>
                 </div>
                 <div class="details">

                 </div>

             </div>
         </div>
         @endforeach
     </div>
 </div>
 {{-- ---- --}}


 @endsection
