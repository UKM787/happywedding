<div class="row justify-content-center mb-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header text-white text-center h4 bg-nav">{{$host->name}} {{ __(' Add Groom') }} <a href="" class="btn btn-sm"><span class="px-3 text-danger">skip</span></a></div>

      <div class="card-body">
        <div class="form-group row">
          <label for="complex_name" class="col-md-1 col-form-label text-md-right">{{ __('Complex Name') }}</label>

          <div class="col-md-3">
            <input id="complex_name" type="text" class="form-control @error('complex_name') is-invalid @enderror" name="complex_name" value="{{ old('complex_name') ?? '' }}" required autocomplete="complex_name" autofocus>

            @error('complex_name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <label for="floor" class="col-md-1 col-form-label text-md-right">{{ __('Floor') }}</label>

          <div class="col-md-3">
            <input id="floor" type="text" class="form-control @error('floor') is-invalid @enderror" name="floor" value="{{ old('floor') ?? '' }}" required autocomplete="floor" autofocus>

            @error('floor')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <label for="door_no" class="col-md-1 col-form-label text-md-right">{{ __('Door No.') }}</label>

          <div class="col-md-3">
            <input id="door_no" type="text" class="form-control @error('door_no') is-invalid @enderror" name="door_no" value="{{ old('door_no') ?? '' }}" required autocomplete="door_no" autofocus>

            @error('door_no')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

        </div>

        <div class="form-group row">
          <label for="street_no" class="col-md-1 col-form-label text-md-right">{{ __('Street No.') }}</label>

          <div class="col-md-2">
            <input id="street_no" type="text" class="form-control @error('street_no') is-invalid @enderror" name="street_no" value="{{ old('street_no') ?? '' }}" required autocomplete="street_no" autofocus>

            @error('street_no')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <label for="area" class="col-md-1 col-form-label text-md-right">{{ __('Area') }}</label>

          <div class="col-md-2">
            <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area') ?? '' }}" required autocomplete="area" autofocus>

            @error('area')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <label for="district" class="col-md-1 col-form-label text-md-right">{{ __('District') }}</label>

          <div class="col-md-2">
            <input id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ old('district') ?? '' }}" required autocomplete="district" autofocus>

            @error('district')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <label for="state" class="col-md-1 col-form-label text-md-right">{{ __('State') }}</label>

          <div class="col-md-2">
            <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') ?? '' }}" required autocomplete="state" autofocus>

            @error('state')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

        </div>

        <div class="form-group row">


          <label for="pin" class="col-md-1 col-form-label text-md-right">{{ __('Pin') }}</label>

          <div class="col-md-2">
            <input id="pin" type="text" class="form-control @error('pin') is-invalid @enderror" name="pin" value="{{ old('pin') ?? '' }}" required autocomplete="pin" autofocus>

            @error('pin')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <label for="zone" class="col-md-1 col-form-label text-md-right">{{ __('Zone') }}</label>

          <div class="col-md-2">
            <input id="zone" type="text" class="form-control @error('zone') is-invalid @enderror" name="zone" value="{{ old('zone') ?? '' }}" required autocomplete="zone" autofocus>

            @error('zone')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <label for="country" class="col-md-1 col-form-label text-md-right">{{ __('Country') }}</label>

          <div class="col-md-2">
            <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') ?? '' }}" required autocomplete="country" autofocus>

            @error('country')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <label for="reachus" class="col-md-1 col-form-label text-md-right">{{ __('Reachus') }}</label>

          <div class="col-md-2">
            <input id="reachus" type="url" class="form-control @error('reachus') is-invalid @enderror" name="reachus" value="{{ old('reachus') ?? '' }}" required autocomplete="reachus" autofocus>

            @error('reachus')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

        </div>



      </div>
    </div>
  </div>
</div>