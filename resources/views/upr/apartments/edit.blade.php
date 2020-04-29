@extends('layouts.layout01')
@section('content')


  <div class="preloader"></div>

<div class="ap-create-show">
    <div class="ap-create-show__wrapper">
        <div class="menu-left">
            <a class="btn__menu" href="{{ URL::previous() }}"><i class="lni lni-chevron-left"></i>Indietro</a>
        </div>
        <div class="menu-right">

        </div>
    </div>
</div>

  {{-- Titolo--}}
  <div class="ap-create-show__title bg-grey">
      <div class="wrapper">
          <div class="ap-title-price">
              <div class="left">
                <h3>Modifica il tuo annuncio</h3>
                <p>In pochi minuti potrai modificare il tuo annuncio.</p>
              </div>
              <div class="right">
              </div>
          </div>
      </div>
  </div>

  {{-- ---- --}}


  <div class="ap-create-show__content">
      <div class="wrapper">
          <div class="left">
  					<form action="{{route('upr.apartments.update', $apartment)}}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PATCH')

  						<div class="box">
  								<label  class="title" for="title">Titolo</label>
  								<input id="create-title" class="form-control @error("title") is-invalid @enderror" type="text" name="title" value="{{$apartment->title}}"  required minlength="4" maxlength="70">
  								@error("title")
  									<span class="invalid-feedback" role="alert">
  										<strong>{{ $message }}</strong>
  									</span>
  								@enderror
  						</div>

  						<div class="box">
  							<label class="title"  for="description">Descrizione</label>
  							<textarea class="form-control @error("description") is-invalid @enderror" name="description"  maxlength="2000" id="description" cols="30" rows="10">{{$apartment->description}}</textarea>
  							@error("description")
  								<span class="invalid-feedback" role="alert">
  									<strong>{{ $message }}</strong>
  								</span>
  							@enderror
  						</div>

  					<div class="box">
  							<label class="title"  for="description">Scegli la foto copertina</label>
  							<div class="form-group col-md-12 custom-file mb-3">
  									<input type="file" class="custom-file-input" id="validatedCustomFile" name="cover_img" accept="image/*">
  									<label class="custom-file-label" for="validatedCustomFile"></label>
  									<div class="invalid-feedback">Non puoi caricare questo file</div>
  							</div>
  					</div>

              <div class="box box-flex">
                  <div class="box-spec">
                      <svg height="40" viewBox="0 0 512 512.01665" width="40" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="m486.410156 298.683594h-25.601562v-85.332032c-.027344-23.554687-19.113282-42.640624-42.667969-42.667968h-136.53125c-23.554687.027344-42.640625 19.113281-42.667969 42.667968v85.332032h-25.601562c-14.128906.015625-25.582032 11.46875-25.597656 25.601562v85.332032c.066406 22.457031 17.550781 41.003906 39.964843 42.394531l-12.269531 42.9375h-79.757812c-4.082032-19.847657-21.539063-34.105469-41.804688-34.132813h-17.066406v-392.875c.011718-26.691406 20.644531-48.835937 47.269531-50.726562s50.183594 17.113281 53.96875 43.535156l.148437 1.035156c-11.011718 4.535156-17.40625 16.097656-15.390624 27.832032l2.328124 13.777343-22.816406 39.183594c-3.066406 5.269531-3.089844 11.773437-.066406 17.066406 3.027344 5.292969 8.648438 8.570313 14.746094 8.597657.976562 0 1.953125-.082032 2.914062-.246094l81.867188-13.835938c6.527344-1.105468 11.828125-5.886718 13.601562-12.265625 1.769532-6.378906-.308594-13.207031-5.335937-17.515625l-34.425781-29.511718-2.328126-13.777344c-1.652343-9.605469-8.628906-17.433594-17.980468-20.179688l-.367188-2.574218c-5.042968-35.296876-36.511718-60.691407-72.074218-58.164063s-63.125 32.117187-63.125 67.769531v392.875h-17.066407v-8.53125c0-4.714844-3.820312-8.535156-8.535156-8.535156-4.710937 0-8.53125 3.820312-8.53125 8.535156v12.148438c-15.527344 6.785156-25.5703125 22.105468-25.6015625 39.050781 0 4.710937 3.8203125 8.53125 8.5351565 8.53125h494.933593c4.710938 0 8.53125-3.820313 8.53125-8.53125 0-4.714844-3.820312-8.535156-8.53125-8.535156h-19.164062l-12.269531-42.9375c22.414062-1.390625 39.898437-19.9375 39.964843-42.394531v-85.332032c-.015624-14.132812-11.46875-25.585937-25.597656-25.601562zm-247.476562-161.351563-81.867188 13.839844 22.359375-38.398437 25.777344-4.355469 33.792969 28.898437zm-41.046875-44.988281-16.828125 2.84375-1.425782-8.414062c-.777343-4.644532 2.347657-9.042969 6.992188-9.835938.472656-.078125.949219-.117188 1.429688-.117188 4.160156.007813 7.710937 3.007813 8.414062 7.109376zm83.722656 95.40625h136.53125c14.132813.015625 25.585937 11.46875 25.601563 25.601562v86.90625c-10.199219 3.589844-17.035157 13.210938-17.066407 24.027344v17.285156c-7.34375-5.644531-16.339843-8.722656-25.601562-8.753906h-30.597657l19.566407-19.566406c3.230469-3.347656 3.1875-8.671875-.105469-11.960938-3.292969-3.292968-8.613281-3.339843-11.960938-.105468l-19.566406 19.566406v-39.132812c0-4.714844-3.824218-8.535157-8.535156-8.535157s-8.535156 3.820313-8.535156 8.535157v39.132812l-19.566406-19.566406c-3.347657-3.234375-8.667969-3.1875-11.960938.105468-3.292969 3.289063-3.335938 8.613282-.105469 11.960938l19.566407 19.566406h-30.597657c-9.261719.03125-18.257812 3.109375-25.601562 8.753906v-17.285156c-.03125-10.816406-6.867188-20.4375-17.066407-24.027344v-86.90625c.015626-14.132812 11.46875-25.585937 25.601563-25.601562zm119.464844 162.132812c14.132812.015626 25.585937 11.46875 25.601562 25.601563v8.53125h-153.601562v-8.53125c.015625-14.132813 11.46875-25.585937 25.601562-25.601563zm12.117187 102.402344 24.382813 42.664063h-175.394531l24.378906-42.664063zm13.484375-17.070312h-153.601562v-34.132813h153.601562zm-221.867187-25.597656v-85.332032c.003906-4.710937 3.824218-8.527344 8.53125-8.535156h34.136718c4.707032.007812 8.527344 3.824219 8.53125 8.535156v110.929688h-25.597656c-14.132812-.015625-25.585937-11.464844-25.601562-25.597656zm-186.269532 85.332031c3.625-10.21875 13.289063-17.054688 24.136719-17.066407h51.199219c10.84375.011719 20.511719 6.847657 24.136719 17.066407zm214.648438 0 12.191406-42.664063h21.527344l-24.378906 42.664063zm224.035156 0-24.378906-42.664063h21.527344l12.191406 42.664063zm37.71875-85.332031c-.015625 14.132812-11.46875 25.582031-25.601562 25.597656h-25.597656v-110.929688c.003906-4.710937 3.824218-8.527344 8.53125-8.535156h34.136718c4.707032.007812 8.523438 3.824219 8.53125 8.535156zm0 0" />
                      </svg>
                      <h4>Stanze</h4>
  										<input  id="room-create" class="form-control @error("n_rooms") is-invalid @enderror" type="number" name="n_rooms"  value="{{$apartment->n_rooms}}" required min="1" max="100">
  										@error("n_rooms")
  											<span class="invalid-feedback d-block" role="alert">
  												<strong>{{ $message }}</strong>
  											</span>
  										@enderror
                  </div>

                  <div class="box-spec">
                      <svg id="Capa_1" enable-background="new 0 0 512.01 512.01" height="40" viewBox="0 0 512.01 512.01" width="40" xmlns="http://www.w3.org/2000/svg">
                          <g id="XMLID_255_">
                              <path id="XMLID_256_" d="m382.005 207.667c0 5.523 4.478 10 10 10s10-4.477 10-10v-20c0-5.523-4.478-10-10-10s-10 4.477-10 10z" />
                              <path id="XMLID_257_" d="m392.005 150c5.522 0 10-4.477 10-10v-20c0-5.523-4.478-10-10-10s-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" />
                              <path id="XMLID_258_" d="m424.005 207.667c0 5.523 4.478 10 10 10s10-4.477 10-10v-20c0-5.523-4.478-10-10-10s-10 4.477-10 10z" />
                              <path id="XMLID_259_" d="m434.005 150c5.522 0 10-4.477 10-10v-20c0-5.523-4.478-10-10-10s-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" />
                              <path id="XMLID_265_" d="m350.005 217.667c5.522 0 10-4.477 10-10v-20c0-5.523-4.478-10-10-10s-10 4.477-10 10v20c0 5.522 4.477 10 10 10z" />
                              <path id="XMLID_266_" d="m350.005 150c5.522 0 10-4.477 10-10v-20c0-5.523-4.478-10-10-10s-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" />
                              <path id="XMLID_269_" d="m256.132 122.083c17.645 0 32-14.355 32-32s-14.355-32-32-32-32 14.355-32 32 14.355 32 32 32zm0-44c6.617 0 12 5.383 12 12s-5.383 12-12 12-12-5.383-12-12 5.383-12 12-12z" />
                              <path id="XMLID_272_" d="m155.731 64c17.645 0 32-14.355 32-32s-14.355-32-32-32-32 14.355-32 32 14.356 32 32 32zm0-44c6.617 0 12 5.383 12 12s-5.383 12-12 12-12-5.383-12-12 5.383-12 12-12z" />
                              <path id="XMLID_290_" d="m64.005 118c17.645 0 32-14.355 32-32s-14.355-32-32-32-32 14.355-32 32 14.355 32 32 32zm0-44c6.617 0 12 5.383 12 12s-5.383 12-12 12-12-5.383-12-12 5.383-12 12-12z" />
                              <path id="XMLID_291_"
                                d="m256.005 290c-2.63 0-5.21 1.07-7.07 2.93s-2.93 4.44-2.93 7.07 1.069 5.21 2.93 7.07 4.44 2.93 7.07 2.93 5.21-1.07 7.069-2.93c1.86-1.86 2.931-4.44 2.931-7.07s-1.07-5.21-2.931-7.07c-1.859-1.86-4.439-2.93-7.069-2.93z" />
                              <path id="XMLID_321_"
                                d="m512.005 278c0-14.153-9.239-26.181-22-30.391v-213.609c0-18.748-15.252-34-34-34h-40c-15.551 0-28.687 10.498-32.718 24.777-23.427 4.138-41.282 24.628-41.282 49.223 0 5.523 4.478 10 10 10h80c5.522 0 10-4.477 10-10 0-23.154-15.822-42.676-37.22-48.338 2.554-3.428 6.626-5.662 11.22-5.662h40c7.72 0 14 6.28 14 14v212h-177.752c-3.806-20.766-19.222-37.872-39.604-43.689-1.46-6.614-4.771-12.682-9.688-17.6-7.927-7.925-19.144-11.612-30.059-10.239-14.989-17.627-37.101-27.971-60.397-27.971-18.146 0-35.88 6.293-49.937 17.72-11.578 9.412-20.284 21.966-25.07 35.964-14.561.109-28.723 5.918-39.141 16.336-8.487 8.488-13.899 19.229-15.69 30.873-13.103 4.005-22.662 16.209-22.662 30.606 0 14.153 9.239 26.181 22 30.391v61.275c0 30.202 10.829 57.92 28.802 79.485l-10.208 17.681c-8.301 14.378-3.357 32.829 11.021 41.13 4.64 2.679 9.788 4.047 15.006 4.047 2.615 0 5.248-.344 7.842-1.039 7.769-2.082 14.262-7.064 18.282-14.029l6.945-12.03c14.411 5.854 30.156 9.088 46.644 9.088h219.334c16.282 0 31.84-3.151 46.104-8.867l6.818 11.809c4.021 6.965 10.514 11.947 18.282 14.029 2.594.695 5.227 1.039 7.842 1.039 5.217 0 10.366-1.368 15.006-4.047 6.965-4.021 11.947-10.514 14.029-18.282 2.081-7.769 1.013-15.883-3.009-22.848l-9.938-17.212c18.209-21.632 29.198-49.532 29.198-79.954v-61.275c12.761-4.21 22-16.238 22-30.391zm-91.714-214h-56.572c4.127-11.641 15.249-20 28.286-20s24.159 8.359 28.286 20zm-367.791 166.662c8.051-8.051 19.596-11.809 30.874-10.059 5.222.806 10.158-2.569 11.299-7.72 5.95-26.876 30.272-46.383 57.832-46.383 19.107 0 37.153 9.316 48.274 24.922 2.58 3.62 7.239 5.102 11.438 3.638 5.855-2.042 12.218-.591 16.602 3.793 3.087 3.087 4.748 7.198 4.678 11.576-.081 5.069 3.643 9.397 8.667 10.072 14.259 1.916 25.688 12.213 29.576 25.499h-228.329c1.658-5.738 4.748-10.998 9.089-15.338zm22.929 256.28c-1.351 2.338-3.53 4.011-6.139 4.71-2.607.698-5.331.341-7.671-1.01-2.339-1.35-4.011-3.53-4.71-6.138s-.34-5.333 1.01-7.671l7.445-12.894c5.134 4.416 10.629 8.423 16.438 11.965zm379.005-2.438c-.698 2.608-2.371 4.789-4.71 6.139-4.827 2.787-11.022 1.126-13.81-3.701l-6.202-10.742c5.823-3.514 11.333-7.493 16.485-11.883l7.226 12.516c1.351 2.338 1.71 5.063 1.011 7.671zm25.571-194.504h-179.003c-5.522 0-10 4.477-10 10s4.478 10 10 10h169.003v59.667c0 57.53-46.804 104.333-104.333 104.333h-219.334c-57.529 0-104.333-46.804-104.333-104.333v-59.667h169.004c5.522 0 10-4.477 10-10s-4.478-10-10-10h-179.004c-6.617 0-12-5.383-12-12s5.383-12 12-12h448c6.617 0 12 5.383 12 12s-5.383 12-12 12z" />
                          </g>
                      </svg>
                      <h4>Bagni</h4>
  										<input id="bath-create" class="form-control @error("n_baths") is-invalid @enderror" type="number" name="n_baths" value="{{$apartment->n_baths}}" required min="1" max="10">
  										@error("n_baths")
  											<span class="invalid-feedback d-block" role="alert">
  												<strong>{{ $message }}</strong>
  											</span>
  										@enderror
                  </div>

                  <div class="box-spec">
                      <svg height="40" viewBox="0 0 64 64" width="40" xmlns="http://www.w3.org/2000/svg">
                          <g id="Measuring_tape" data-name="Measuring tape">
                              <path
                                d="m47 16a16.019 16.019 0 0 0 -16 16v7h-28v-3a1 1 0 0 0 -2 0v11a1 1 0 0 0 1 1h45a16 16 0 0 0 0-32zm-44 25h3v2a1 1 0 0 0 2 0v-2h3v1a1 1 0 0 0 2 0v-1h3v2a1 1 0 0 0 2 0v-2h3v1a1 1 0 0 0 2 0v-1h3v2a1 1 0 0 0 2 0v-2h3v5h-28zm44 5h-14v-14a14 14 0 1 1 14 14z" />
                              <path d="m47 24a8 8 0 1 0 8 8 8.009 8.009 0 0 0 -8-8zm0 14a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z" />
                              <path d="m46 42h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0-2z" />
                              <path d="m37 42h-1a1 1 0 0 0 0 2h1a1 1 0 0 0 0-2z" />
                          </g>
                      </svg>
                      <h4>Mq</h4>

  										<input id="mq-create" class="form-control @error("sq_meters") is-invalid @enderror" type="number" name="sq_meters"  value="{{$apartment->sq_meters}}" required min="10" max="2000">
  										@error("sq_meters")
  											<span class="invalid-feedback d-block" role="alert">
  												<strong>{{ $message }}</strong>
  											</span>
  										@enderror
                  </div>
              </div>

  						<div class="box">
  							<label class="title" for="address">Indirizzo</label>
  							<input id="address" class="form-control @error("address") is-invalid @enderror" type="text" name="address" value="{{$apartment->address}}"  autocomplete="off" required minlength="4" maxlength="255">
  							@error("address")
  								<span class="invalid-feedback d-block" role="alert">
  									<strong>{{ $message }}</strong>
  								</span>
  							@enderror
  							<div class="dropdown-address hidden">
  								<ul class="list-unstyled "></ul>
  							</div>
  							<input type="hidden" id="latitude" name="latitude" value="{{$apartment->latitude}}">
  							<input type="hidden" id="longitude" name="longitude" value="{{$apartment->longitude}}">
  						</div>

  						<div class="box">
  							<label class="title" for="price">Prezzo</label>
  							<input id="price" class="form-control @error("price") is-invalid @enderror" type="number" name="price" value="{{$apartment->price}}"  required>
  							@error("price")
  								<span class="invalid-feedback d-block" role="alert">
  									<strong>{{ $message }}</strong>
  								</span>
  							@enderror
  						</div>

  						<div class="box">
  							<label class="title" for="active">Visibilità</label>
                <select name="active" class="custom-select mr-sm-2">
                    <option value="0" {{($apartment->active == 0) ? 'selected' : ''}}  >Non visibile</option>
                    <option value="1" {{($apartment->active == 1) ? 'selected' : ''}} >Visibile</option>
                </select>
  						</div>
  						<div class="box">
  								<label class="title" for="services">Servizi</label>
  								<div class="box-service">
  										@foreach ($services as $service)
  										<div class="service">
  											<div class="pretty p-default  p-round p-fill ">
  												<input type="checkbox" name="services[]" value="{{$service->id}}" {{($apartment->services->contains($service->id)) ? 'checked' : ''}}>
  												<div class="state p-primary">
  								            <label>{{$service->title}}</label>
  								        </div>
  											</div>
  										</div>
  										@endforeach
  								</div>
  						</div>
  						<button class="form-create__btn" type="submit">Salva</button>
  					</form>
  						</div>

  						<div class="right">
  								<div class=" upr-show-sticky">
  									<div class="home-apartment__container">
  										<div class="home-apartment__box">
  												<div class="thumb">
  													<div class="thumb_container">
                              <img id="blah" class="img-whp" src="{{($apartment->cover_img == "storage/") ? asset("storage/images/asset/nophoto.png") : asset($apartment->cover_img) }}" alt="{{$apartment->title}}">
  													</div>
  													<div class="thmb_cntnt">
  														<p id="price-append" class="fp_price">{{$apartment->price}}</p>
  														<small>€</small>
  													</div>
  												</div>
  												<div class="details">
  													<div class="tc_content">
  														<div class="tc_content__height">
  																<h4 id="title-append" >{{$apartment->title}}</h4>
  														</div>
  														<p id="address-append"><span></span>{{$apartment->address}}</p>
  														<ul class="prop_details">
  															<li>Stanze: <strong id="room-append">{{$apartment->n_rooms}}</strong> </li>
  															<li>Bagni: <strong id="bath-append">{{$apartment->n_baths}}</strong> </li>
  															<li>Mq: <strong id="mq-append">{{$apartment->sq_meters}}</strong> </li>
  														</ul>
  													</div>
  												</div>
  										</div>
  									</div>
  								</div>
  						</div>
          </div>
      </div>

@endsection
