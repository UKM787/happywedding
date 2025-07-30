<!-- Services -->

<div class="row">

    <div class="col-md-12">
        {{$vendor->name}}
        {{$vendor->email}}
        {{$vendor->mobile}}
        {{$vendor->location->name}}
    </div>
</div>
@foreach ($services as $service)
<div class="row">
    <div class="col-md-12">
        <label for="service_id" class="form-label">{{ __('Services') }}</label>
        <span class="text-primary h3">{{$service->category->name}}</span>
        {{$service->location->name}}
        {!! $service->location->icon !!}
        {{ $service->status ? 'Active' : 'Not Active' }}
    </div>
</div>

<!-- guestphoto optional -->
<div class="row mt-3">
    <div class="col-md-2">
        <div class="upload-cover">
            <label class="btn btn-upload btn-red">{{ __('Photo') }}<i class="fa fa-upload" aria-hidden="true"></i>
                <input hidden type="file" name="imageOne" class="@error('imageOne') is-invalid @enderror mb-4" accept="image/*" value="{{$service->imageOne ?? asset('storage\defaultsv1').'\avatar.png' ??  '' }}" autocomplete="imageOne" aria-label="imageOne"></label>
            @error('imageOne')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @if(isset($service->imageOne) )
            <img src="{{asset('assets/vendors\/').$service->imageOne}}" alt="profilePhoto" id="imageOneTag" width="125px" height="auto">

            @else
            <img src="{{asset('assets/vendors\/').'/vendorDefault.png'}}" alt="profilePhoto" id="imageOneTag" width="125px" height="auto">
            @endif


        </div>
    </div>
</div>
@endforeach
