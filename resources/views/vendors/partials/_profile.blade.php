<!-- vendorprofile -->

<div class="row">
    <div class="col-md-2">
        <div class="upload-cover">
            <label class="btn btn-upload btn-red" {{$wedform}}>{{ __('logo') }}<i class="fa fa-upload" aria-hidden="true"></i>
                <input hidden type="file" name="logo" class="@error('logo') is-invalid @enderror mb-4" accept="image/*" value="{{$profile->logo ?? asset('assets/vendors/logo\/').'logo.png' ??  '' }}" autocomplete="logo" aria-label="logo" {{$wedform}}></label>
            @error('logo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @if(isset($profile->logo) )
            <img src="{{asset('assets/vendors/logo\/').$profile->logo}}" alt="companyLogo" id="imageOneTag" width="36" height="auto">

            @else
            <img src="{{asset('assets/vendors/logo\/').'logoDefault.png'}}" alt="companyLogo" id="imageOneTag" width="36px" height="auto">
            @endif


        </div>
    </div>

    <div class="col-md-10">
        <label class="form-label" id="companyname">{{ __('Company Name*') }}</label>
        <input name="companyname" type="text" class="form-control @error('companyname') is-invalid @enderror" placeholder="enter companyName" value="{{ old('companyname') ?? $profile->companyname ?? '' }}" aria-label="companyname" aria-describedby="companyname" autocomplete="companyname" {{$wedform}}>

        @error('companyname')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label class="form-label" id="companyinfo">{{ __('Company Description*')}}</label>
        <textarea name="companyinfo" type="text" class="form-control @error('companyinfo') is-invalid @enderror" placeholder="enter detailed companyInformation" aria-label="companyinfo" aria-describedby="companyinfo" autocomplete="companyinfo" {{$wedform}}>{{ old('companyinfo') ?? $profile->companyinfo ?? ''}}</textarea>
        @error('companyinfo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="category_id" class="form-label">{{ __('Category') }}</label>
        <select name="category_id[]" class="form-select" size="7" multiple>
            <option>Select a Master Service Category</option>
            @foreach($vendorcats as $cat)
            <option value="{{ $cat->id }}" {{ $cat->id === old('cat_id') ? 'selected' : '' }} @if(!$cat->children->isEmpty()) disabled @endif>{{ $cat->name }}</option>
            @if ($cat->children)
            @foreach ($cat->children as $child)
            <option value="{{ $child->id }}" {{ $child->id === old('cat_id') ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
            @endforeach
            @endif
            @endforeach
        </select>

        @error('category_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}
        </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="locationmaster_id" class="form-label">{{ __('Location') }}</label>
        <select name="locationmaster_id" id="locationmaster_id" class="form-control" size="5">
            @foreach ($locations as $key => $val)
            <option value="{{$val}}" @if (isset($profile)) {{$val == $profile->locationmaster_id ? 'selected' : '' }} @endif>{{$key}}</option>
            @endforeach
        </select>
        @error('locationmaster_id')
        <span class=" invalid-feedback" role="alert">
            <strong>{{$message}}
        </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <Label class="form-label" id="address">{{ __('Address')}}</Label>
        <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="address" value="{{ old('address') ?? $profile->address ?? ''}}" aria-label="address" aria-describedby="address" autocomplete="address" {{$wedform}}>
        @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-4">
        <Label class="form-label" id="map">{{ __('Map')}}</Label>
        <input name="map" type="text" class="form-control @error('map') is-invalid @enderror" placeholder="map" value="{{ old('map') ?? $profile->map ?? ''}}" aria-label="map" aria-describedby="map" autocomplete="map" {{$wedform}}>
        @error('map')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <label class="form-label" id="longitude">{{ __('Longitude') }}</label>
        <input name="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" placeholder="enter longtitude" value="{{ old('longitude') ?? $profile->longitude ?? ''}}" aria-label="longitude" aria-describedby="longitude" autocomplete="longitude" {{$wedform}}>
        @error('longitude')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-2">
        <label class="form-label" id="latitude">{{ __('Latitude*')}}</label>
        <input name="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" placeholder="enter latitude" value="{{ old('latitude') ?? $profile->latitude ?? ''}}" aria-label="latitude" aria-describedby="latitude" autocomplete="latitude" {{$wedform}}>
        @error('latitude')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-2">
        <label class="form-label" id="establish">{{ __('Established')}}</label>
        <input name="establish" type="text" class="form-control @error('establish') is-invalid @enderror" placeholder="establishing year" value="{{ old('establish') ?? $profile->establish ?? ''}}" aria-label="establish" aria-describedby="establish" autocomplete="establish" {{$wedform}}>
        @error('establish')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label" id="gst">{{ __('GST') }}</label>
        <input name="gst" type="gst" class="form-control @error('gst') is-invalid @enderror" placeholder="enter company  gstno" value="{{ old('gst') ?? $profile->gst ?? ''}}" aria-label="gst" aria-describedby="gst" autocomplete="gst" {{$wedform}}>
        @error('gst')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <label class="form-label" id="phone">{{ __('Phone*')}}</label>
        <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Landline Phone" value="{{ old('phone') ?? $profile->phone ?? ''}}" aria-label="phone" aria-describedby="phone" autocomplete="phone" {{$wedform}}>
        @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" id="mobile">{{ __('Primary Mobile')}}</label>
        <input name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile No." value="{{ old('mobile') ?? $profile->mobile ?? ''}}" aria-label="mobile" aria-describedby="mobile" autocomplete="mobile" {{$wedform}}>
        @error('mobile')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" id="mobile1">{{ __('Alternate Mobile') }}</label>
        <input name="mobile1" type="text" class="form-control @error('mobile1') is-invalid @enderror" placeholder="Alternate Mobile No." value="{{ old('mobile1') ?? $profile->mobile1 ?? ''}}" aria-label="mobile1" aria-describedby="mobile1" autocomplete="mobile1" {{$wedform}}>
        @error('mobile1')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" id="whatsup">{{ __('Whatsup')}}</label>
        <input name="whatsup" type="text" class="form-control @error('whatsup') is-invalid @enderror" placeholder="Whatsup No." value="{{ old('whatsup') ?? $profile->whatsup ?? ''}}" aria-label="whatsup" aria-describedby="whatsup" autocomplete="whatsup" {{$wedform}}>
        @error('whatsup')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<!-- guestphoto optional -->
<div class="col-md-2">
    <div class="upload-cover">
        <label class="btn btn-upload btn-red" {{$wedform}}>{{ __('Photo') }}<i class="fa fa-upload" aria-hidden="true"></i>
            <input hidden type="file" name="imageOne" class="@error('imageOne') is-invalid @enderror mb-4" accept="image/*" value="{{$profile->imageOne ?? asset('storage\defaultsv1').'\avatar.png' ??  '' }}" autocomplete="imageOne" aria-label="imageOne" {{$wedform}}></label>
        @error('imageOne')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        @if(isset($profile->imageOne) )
        <img src="{{asset('assets/vendors\/').$profile->imageOne}}" alt="profilePhoto" id="imageOneTag" width="125px" height="auto">

        @else
        <img src="{{asset('assets/vendors\/').'/vendorDefault.png'}}" alt="profilePhoto" id="imageOneTag" width="125px" height="auto">
        @endif


    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center bt-3">
        <div class="form-group">
            <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
        </div>
    </div>
</div>
