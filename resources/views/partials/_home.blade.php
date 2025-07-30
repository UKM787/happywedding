<!-- hosthome -->
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" id="complexName">{{ __('Complex Name*') }}</label>
        <input name="complexName" type="text" class="form-control @error('complexName') is-invalid @enderror" placeholder="complexName" value="{{ old('complexName') ?? $home->complexName ?? ''}}" aria-label="complexName" aria-describedby="complexName" autocomplete="complexName" {{$wedform}} autofocus>
        @error('complexName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" id="floor">{{ __('Floor*')}}</label>
        <input name="floor" type="text" class="form-control @error('floor') is-invalid @enderror" placeholder="floor" value="{{ old('floor') ?? $home->floor ?? ''}}" aria-label="floor" aria-describedby="floor" autocomplete="floor" {{$wedform}}>
        @error('floor')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" id="doorNo">{{ __('Door No.')}}</label>
        <input name="doorNo" type="text" class="form-control @error('doorNo') is-invalid @enderror" placeholder="doorNo" value="{{ old('doorNo') ?? $home->doorNo ?? ''}}" aria-label="doorNo" aria-describedby="doorNo" autocomplete="doorNo" {{$wedform}}>
        @error('doorNo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label" id="streetNo">{{ __('Street No.') }}</label>
        <input name="streetNo" type="text" class="form-control @error('streetNo') is-invalid @enderror" placeholder="streetNo" value="{{ old('streetNo') ?? $home->streetNo ?? ''}}" aria-label="streetNo" aria-describedby="streetNo" autocomplete="streetNo" {{$wedform}}>
        @error('streetNo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" id="area">{{ __('Area*')}}</label>
        <input name="area" type="text" class="form-control @error('area') is-invalid @enderror" placeholder="area" value="{{ old('area') ?? $home->area ?? ''}}" aria-label="area" aria-describedby="area" autocomplete="area" {{$wedform}}>
        @error('area')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" id="district">{{ __('District')}}</label>
        <input name="district" type="text" class="form-control @error('district') is-invalid @enderror" placeholder="district" value="{{ old('district') ?? $home->district ?? ''}}" aria-label="district" aria-describedby="district" autocomplete="district" {{$wedform}}>
        @error('district')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" id="state">{{ __('State') }}</label>
        <input name="state" type="text" class="form-control @error('state') is-invalid @enderror" placeholder="state" value="{{ old('state') ?? $home->state ?? ''}}" aria-label="state" aria-describedby="state" autocomplete="state" {{$wedform}}>
        @error('state')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label" id="pin">{{ __('Pin*')}}</label>
        <input name="pin" type="text" class="form-control @error('pin') is-invalid @enderror" placeholder="pincode" value="{{ old('pin') ?? $home->pin ?? ''}}" aria-label="pin" aria-describedby="pin" autocomplete="pin" {{$wedform}}>
        @error('pin')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" id="zone">{{ __('Zone')}}</label>
        <input name="zone" type="text" class="form-control @error('zone') is-invalid @enderror" placeholder="zone" value="{{ old('zone') ?? $home->zone ?? ''}}" aria-label="zone" aria-describedby="zone" autocomplete="zone" {{$wedform}}>
        @error('zone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" id="country">{{ __('Country') }}</label>
        <input name="country" type="text" class="form-control @error('country') is-invalid @enderror" placeholder="country" value="{{ old('country') ?? $home->country ?? ''}}" aria-label="country" aria-describedby="country" autocomplete="country" {{$wedform}}>
        @error('country')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" id="reachus">{{ __('map')}}</label>
        <input name="reachus" type="text" class="form-control @error('reachus') is-invalid @enderror" placeholder="Reachus" value="{{ old('reachus') ?? $home->reachus ?? ''}}" aria-label="reachus" aria-describedby="reachus" autocomplete="reachus" {{$wedform}}>
        @error('reachus')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


