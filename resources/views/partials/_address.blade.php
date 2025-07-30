<div class="row">
  <!-- guesthome -->
  <div class="col">
  <div class="row wed-form-row">
    <div class="input-group mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="complexName">{{ __('Complex Name*') }}</span>
      </div>
        <input name="complexName" type="text" class="form-control @error('complexName') is-invalid @enderror"
          placeholder="complexName" value="{{ old('complexName') ?? $guesthome->complexName ?? ''}}"
          aria-label="complexName" aria-describedby="complexName" autocomplete="complexName" {{$wedform}} autofocus>
        @error('complexName')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
  </div>
  <div class="row wed-form-row">
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="floor">{{ __('Floor*')}}</span>
      </div>
      <input name="floor" type="text" class="form-control @error('floor') is-invalid @enderror" placeholder="floor"
        value="{{ old('floor') ?? $guesthome->floor ?? ''}}" aria-label="floor" aria-describedby="floor"
        autocomplete="floor" {{$wedform}}>
      @error('floor')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="doorNo">{{ __('Door No.')}}</span>
      </div>
      <input name="doorNo" type="text" class="form-control @error('doorNo') is-invalid @enderror" placeholder="doorNo"
        value="{{ old('doorNo') ?? $guesthome->doorNo ?? ''}}" aria-label="doorNo" aria-describedby="doorNo"
        autocomplete="doorNo" {{$wedform}}>
      @error('doorNo')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  <div class="row wed-form-row">
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="streetNo">{{ __('Street No.') }}</span>
      </div>
      <input name="streetNo" type="text" class="form-control @error('streetNo') is-invalid @enderror"
        placeholder="streetNo" value="{{ old('streetNo') ?? $guesthome->streetNo ?? ''}}" aria-label="streetNo"
        aria-describedby="streetNo" autocomplete="streetNo" {{$wedform}}>

      @error('streetNo')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="area">{{ __('Area*')}}</span>
      </div>
        <input name="area" type="text" class="form-control @error('area') is-invalid @enderror" placeholder="area"
          value="{{ old('area') ?? $guesthome->area ?? ''}}" aria-label="area" aria-describedby="area" autocomplete="area"
          {{$wedform}}>
        @error('area')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
  </div>

  <div class="row wed-form-row">
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="district">{{ __('District')}}</span>
      </div>
      <input name="district" type="text" class="form-control @error('district') is-invalid @enderror"
        placeholder="district" value="{{ old('district') ?? $guesthome->district ?? ''}}" aria-label="district"
        aria-describedby="district" autocomplete="district" {{$wedform}}>
      @error('district')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="pin">{{ __('Pin*')}}</span>
      </div>
      <input name="pin" type="text" class="form-control @error('pin') is-invalid @enderror" placeholder="pincode"
        value="{{ old('pin') ?? $guesthome->pin ?? ''}}" aria-label="pin" aria-describedby="pin" autocomplete="pin"
        {{$wedform}}>
      @error('pin')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  <div class="row wed-form-row">
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="state">{{ __('State') }}</span>
      </div>
      <input name="state" type="text" class="form-control @error('state') is-invalid @enderror" placeholder="state"
        value="{{ old('state') ?? $guesthome->state ?? ''}}" aria-label="state" aria-describedby="state"
        autocomplete="state" {{$wedform}}>

      @error('state')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="zone">{{ __('Zone')}}</span>
      </div>
      <input name="zone" type="text" class="form-control @error('zone') is-invalid @enderror" placeholder="zone"
        value="{{ old('zone') ?? $guesthome->zone ?? ''}}" aria-label="zone" aria-describedby="zone" autocomplete="zone"
        {{$wedform}}>
      @error('zone')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>
  <div class="row wed-form-row">
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="country">{{ __('Country') }}</span>
      </div>
      <input name="country" type="text" class="form-control @error('country') is-invalid @enderror" placeholder="country"
        value="{{ old('country') ?? $guesthome->country ?? ''}}" aria-label="country" aria-describedby="country"
        autocomplete="country" {{$wedform}}>

      @error('country')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="reachus">{{ __('reachus')}}</span>
      </div>
      <input name="reachus" type="text" class="form-control @error('reachus') is-invalid @enderror" placeholder="Reachus"
        value="{{ old('reachus') ?? $guesthome->reachus ?? ''}}" aria-label="reachus" aria-describedby="reachus"
        autocomplete="reachus" {{$wedform}}>
      @error('reachus')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>


  @if($wedform != 'disabled')
  <div class="form-group row mb-2">
    <div class="col-md-2 offset-md-5">
      <button type="submit" class="btn wed-form-button">
        {{__($submitBtn)}}
      </button>
    </div>
  </div>
  @endif
</div>
<!-- guestoffice -->
  <div class="col">
    <div class="row wed-form-row">
      <div class="input-group col mb-2">
        <div class="input-group-prepend">
          <span class="input-group-text mr-2" id="companyName">{{ __('Company Name*') }}</span>
        </div>
        <input name="companyName" type="text" class="form-control @error('companyName') is-invalid @enderror"
          placeholder="companyName" value="{{ old('companyName') ?? $guestoffice->companyName ?? ''}}"
          aria-label="companyName" aria-describedby="companyName" autocomplete="companyName" {{$wedform}} autofocus>

        @error('companyName')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="row wed-form-row">
      <div class="input-group col mb-2">
        <div class="input-group-prepend">
          <span class="input-group-text mr-2" id="complexName">{{ __('Complex Name*') }}</span>
        </div>
        <input name="complexName" type="text" class="form-control @error('complexName') is-invalid @enderror"
          placeholder="complexName" value="{{ old('complexName') ?? $guestoffice->complexName ?? ''}}"
          aria-label="complexName" aria-describedby="complexName" autocomplete="complexName" {{$wedform}}>

        @error('complexName')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="row wed-form-row">
      <div class="input-group col mb-2">
        <div class="input-group-prepend">
          <span class="input-group-text mr-2" id="floor">{{ __('Floor*')}}</span>
        </div>
        <input name="floor" type="text" class="form-control @error('floor') is-invalid @enderror" placeholder="floor"
          value="{{ old('floor') ?? $guestoffice->floor ?? ''}}" aria-label="floor" aria-describedby="floor"
          autocomplete="floor" {{$wedform}}>
        @error('floor')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="input-group col mb-2">
        <div class="input-group-prepend">
          <span class="input-group-text mr-2" id="doorNo">{{ __('Door No.')}}</span>
        </div>
        <input name="doorNo" type="text" class="form-control @error('doorNo') is-invalid @enderror" placeholder="doorNo"
          value="{{ old('doorNo') ?? $guestoffice->doorNo ?? ''}}" aria-label="doorNo" aria-describedby="doorNo"
          autocomplete="doorNo" {{$wedform}}>
        @error('doorNo')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="row wed-form-row">
      <div class="input-group col mb-2">
        <div class="input-group-prepend">
          <span class="input-group-text mr-2" id="streetNo">{{ __('Street No.') }}</span>
        </div>
        <input name="streetNo" type="text" class="form-control @error('streetNo') is-invalid @enderror"
          placeholder="streetNo" value="{{ old('streetNo') ?? $guestoffice->streetNo ?? ''}}" aria-label="streetNo"
          aria-describedby="streetNo" autocomplete="streetNo" {{$wedform}}>

        @error('streetNo')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="area">{{ __('Area*')}}</span>
      </div>
      <input name="area" type="text" class="form-control @error('area') is-invalid @enderror" placeholder="area"
        value="{{ old('area') ?? $guestoffice->area ?? ''}}" aria-label="area" aria-describedby="area" autocomplete="area"
        {{$wedform}}>
      @error('area')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  <div class="row wed-form-row">
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="district">{{ __('District')}}</span>
      </div>
      <input name="district" type="text" class="form-control @error('district') is-invalid @enderror"
        placeholder="district" value="{{ old('district') ?? $guestoffice->district ?? ''}}" aria-label="district"
        aria-describedby="district" autocomplete="district" {{$wedform}}>
      @error('district')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="pin">{{ __('Pin*')}}</span>
      </div>
      <input name="pin" type="text" class="form-control @error('pin') is-invalid @enderror" placeholder="pincode"
        value="{{ old('pin') ?? $guestoffice->pin ?? ''}}" aria-label="pin" aria-describedby="pin" autocomplete="pin"
        {{$wedform}}>
      @error('pin')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>
  <div class="row wed-form-row">
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="state">{{ __('State') }}</span>
      </div>
      <input name="state" type="text" class="form-control @error('state') is-invalid @enderror" placeholder="state"
        value="{{ old('state') ?? $guestoffice->state ?? ''}}" aria-label="state" aria-describedby="state"
        autocomplete="state" {{$wedform}}>

      @error('state')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="input-group col mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="zone">{{ __('Zone')}}</span>
      </div>
      <input name="zone" type="text" class="form-control @error('zone') is-invalid @enderror" placeholder="zone"
        value="{{ old('zone') ?? $guestoffice->zone ?? ''}}" aria-label="zone" aria-describedby="zone" autocomplete="zone"
        {{$wedform}}>
      @error('zone')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  <div class="row wed-form-row">
    <div class="input-group col-md-4 mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="country">{{ __('Country') }}</span>
      </div>
      <input name="country" type="text" class="form-control @error('country') is-invalid @enderror" placeholder="country"
        value="{{ old('country') ?? $guestoffice->country ?? ''}}" aria-label="country" aria-describedby="country"
        autocomplete="country" {{$wedform}}>

      @error('country')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="input-group col-md-8 mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text mr-2" id="reachus">{{ __('Reachus')}}</span>
      </div>
      <input name="reachus" type="text" class="form-control @error('reachus') is-invalid @enderror" placeholder="Reachus"
        value="{{ old('reachus') ?? $guestoffice->reachus ?? ''}}" aria-label="reachus" aria-describedby="reachus"
        autocomplete="reachus" {{$wedform}}>
      @error('reachus')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  @if($wedform != 'disabled')
  <div class="form-group row mb-2">
    <div class="col-md-2 offset-md-5">
      <button type="submit" class="btn btn-sm wed-btn-main">
       <span class="material-icons">save</span>
      </button>
    </div>
  </div>
  @endif</div>
</div>
