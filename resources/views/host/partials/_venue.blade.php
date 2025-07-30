  <div class="add-venue">
      <div class="row mb-1">
          <label for="name" class="form-label">{{ __('Name of Place*')}}</label>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $venue->name }}" autocomplete="name"  autofocus>
          @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
      </div>
      <div class="row mb-1">
          <label for="description" class="form-label">{{ __('Name of Hall*')}}</label>
          <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $venue->description }}" autocomplete="description" >
          @error('description')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
      </div>
      <div class="row mb-1">
          <label for="address" class="form-label">{{ __('Address')}} </label>
          <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $venue->address }}" autocomplete="address" >
          @error('address')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
      </div>

      <div class="row mb-1">
          <div class="col">
              <label for="city" class="form-label">{{ __('City') }}</label>
              <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') ?? $venue->city }}" autocomplete="city" >
              @error('city')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          <div class="col">
              <label for="pincode" class="form-label">{{ __('Pin Code') }}</label>
              <input id="pincode" type="text" class="form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode') ?? $venue->pincode }}" autocomplete="pincode" >
              @error('pincode')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
      </div>
      <div class="row mb-1">
          <div class="col">
              <label for="state" class="form-label">{{ __('State') }}</label>
              <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') ?? $venue->state }}" autocomplete="state" >
              @error('state')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          <div class="col">
              <label for="country" class="form-label">{{ __('Country') }}</label>
              <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') ?? $venue->country }}" autocomplete="country" >
              @error('country')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
      </div>

      <div class="row mb-2">
          <label for="map" class="form-label">{{ __('Google Maps') }}</label>
          <input id="map" type="text" class="form-control @error('map') is-invalid @enderror" name="map" value="{{ old('map') ?? $venue->map }}" autocomplete="map" >
          @error('map')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
      </div>

      <!-- venueimageOne optional -->
      <div class="row my-3">
          <div class="col">
              <div class="upload-cover">
                  <label class="btn btn-upload btn-red" for="imageOne">{{__(' Upload Photo ')}}<i class="fa fa-upload" aria-hidden="true"></i></label>
                  <input hidden type="file" name="imageOne" id="imageOne" style="opacity:0" class="form-control-file @error('imageOne') is-invalid @enderror" accept="image/*" value="{{asset('storage\venues').'\venueDefault.png' ?? $venue->imageOne ?? '' }}" autocomplete="imageOne" {{$wedform}} aria-label="imageOne" aria-describedby="imageOne">
                  @error('imageOne')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>auth()->guard('host')->user()->role
                  </span>
                  @enderror
              </div>
          </div>
          <div class="col">
              @if($venue->imageOne == null)
              <img src="{{asset('storage/venues/venueDefault.png')}}" alt="VenuePhoto" id="imageOneTag" width="150px" height="100px">
              @else
              <img src="{{asset('storage/'.$venue->imageOne)}}" alt="{{$venue->name}}" id="imageOneTag" width="150px" height="100px">
              @endif
          </div>

      </div>


      <div class="row my-5 text-center">
          <div class="col">
              <button type="submit" class="btn wed-btn-main btn-sm">
                  <span class="material-icons">save</span>
              </button>
          </div>
      </div>
  </div>
