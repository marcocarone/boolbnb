 @extends('layouts.uploadImage')
@section('content')
<div class="container">
{{-- @dd($apartment->id) --}}
    {{-- @dd($data) --}}
    {{-- @dd($apartment->images) --}}
    <a class="btn btn-secondary mb-3" href="{{route("upr.apartments.show", $apartment)}}">Indietro</a>

    <div class="row d-flex flex-row bd-highlight">
        @foreach ($apartment->images as $image)
        {{-- @dd($image->img_path) --}}

        <div class="card-deck col-md-4 mb-4">
            <div class="card">
                <div class="imgdiv">
                    <img class="image_home" src="{{asset('images/' . $image->img_path)}}" class="card-img-top" alt="">
                </div>
                <div class="card-body">
                    <form action="{{route("upr.images.destroy", $image)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="dropdown-item" type="submit">Elimina</button>
                    </form>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
  Aggiungi delle foto all'appartamento
</button>

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

          <a class="btn btn-primary m-3" href="{{route("upr.apartment.show2", $apartment)}}">Salva</a>

      </div>


    </div>
  </div>
</div>

</div>


@endsection
