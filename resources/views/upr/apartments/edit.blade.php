@extends('layouts.app')
@section('content')



<form  action="{{route('upr.apartments.update', $apartment)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="container">
      <a class="btn btn-secondary mb-3" href="{{ URL::previous() }}">Indietro</a>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="title">Titolo</label>
                <input class="form-control @error("title") is-invalid @enderror" type="text" name="title"  value="{{$apartment->title}}" required minlength="4" maxlength="70">
                  @error("title")
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
            </div>

            <div class="form-group col-md-12">
                <label for="description">Descrizione</label>
                <textarea class="form-control @error("description") is-invalid @enderror" name="description"  maxlength="1000" id="description" cols="30" rows="10">{{$apartment->description}}</textarea>
                  @error("description")
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
            </div>
            <div class="form-group col-md-12 custom-file mb-3">
                <input type="file" class="custom-file-input" id="validatedCustomFile" name="cover_img" accept="image/*">
                <label class="custom-file-label" for="validatedCustomFile">Scegli la cover...</label>
                <div class="invalid-feedback">Non puoi caricare questo file</div>
            </div>

            <div class="form-group col-md-2">
                <label for="n_rooms">Numero stanze</label>
                <input class="form-control @error("n_rooms") is-invalid @enderror" type="number" name="n_rooms"  value="{{$apartment->n_rooms}}" required min="1" max="100">
                  @error("n_rooms")
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
            </div>
            <div class="form-group col-md-2">
                <label for="n_baths">Numero bagni</label>
                <input class="form-control @error("n_baths") is-invalid @enderror" type="number" name="n_baths" value="{{$apartment->n_baths}}" required min="1" max="10">
                  @error("n_baths")
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="sq_meters">Metri quadri</label>
                <input class="form-control @error("sq_meters") is-invalid @enderror" type="number" name="sq_meters" value="{{$apartment->sq_meters}}" required min="1" max="2000">
                  @error("sq_meters")
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
            </div>
            <div class="form-group col-md-5">
                <label for="address">Indirizzo</label>
                <input id="address" class="form-control @error("address") is-invalid @enderror" type="text" name="address"  autocomplete="off" value="{{$apartment->address}}" required minlength="4" maxlength="255">
                  @error("address")
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <div class="dropdown-address hidden">
                    <ul class="list-unstyled m-0"></ul>
                  </div>
                  <input type="hidden" id="latitude" name="latitude" value="{{$apartment->latitude}}">
                  <input type="hidden" id="longitude" name="longitude" value="{{$apartment->longitude}}">
            </div>
          
            <div class="form-group col-md-3">
                <label for="price">Prezzo</label>
                <input class="form-control @error("price") is-invalid @enderror" type="number" name="price" value="{{$apartment->price}}" required>
                  @error("price")
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
            </div>

            <div class="form-group col-md-3">
                <label for="active">Visibilità</label>
                <select name="active" class="custom-select mr-sm-2">
                    <option value="0" {{($apartment->active == 0) ? 'selected' : ''}}  >Non visibile</option>
                    <option value="1" {{($apartment->active == 1) ? 'selected' : ''}} >Visibile</option>
                </select>
            </div>

            <div class="form-group col-md-12">
                <label for="services">Servizi aggiuntivi</label>
                @foreach ($services as $service)
                <div>
                    <input type="checkbox" name="services[]" value="{{$service->id}}" {{($apartment->services->contains($service->id)) ? 'checked' : ''}}>
                    <span>{{$service->title}}</span>
                </div>
                @endforeach
            </div>
            <button class="btn btn-success"   type="submit">Salva</button>
        </div>
    </div>
</form>

</div>


@endsection
