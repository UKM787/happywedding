<!-- hostprofile -->
<div class="row wed-form-row">
    <div class="input-group col-sm-4 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="name">{{ __('Name*') }}</span>
        </div>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') ?? $profile->name ?? '' }}" aria-label="name" aria-describedby="name" autocomplete="name" autofocus {{$wedform}}>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="input-group col-sm-4 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="mobile">{{ __('Mobile*')}}</span>
        </div>
        <input name="mobile" type="mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="mobile number" value="{{ old('mobile') ?? $profile->mobile ?? ''}}" aria-label="mobile" aria-describedby="mobile" autocomplete="mobile" {{$wedform}}>
        @error('mobile')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="input-group col-sm-4 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="email">{{ __('Email')}}</span>
        </div>
        <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="email id" value="{{ old('email') ?? $profile->email ?? ''}}" aria-label="email" aria-describedby="email" autocomplete="email" {{$wedform}}>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row wed-form-row">
    <div class="input-group col-sm-4 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="gender">{{ __('Gender*')}}</span>
        </div>
        <input name="gender" type="text" class="form-control @error('gender') is-invalid @enderror" placeholder="gender" value="{{ old('gender') ?? $profile->gender ?? ''}}" aria-label="gender" aria-describedby="gender" autocomplete="gender" {{$wedform}}>
        @error('gender')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="input-group col-sm-4 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="relation">{{ __('Relation')}}</span>
        </div>
        <input name="relation" type="text" class="form-control @error('relation') is-invalid @enderror" placeholder="relation" value="{{ old('relation') ?? $profile->relation ?? ''}}" aria-label="relation" aria-describedby="relation" autocomplete="relation" {{$wedform}}>
        @error('relation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="input-group col-sm-4 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="department">{{ __('Department') }}</span>
        </div>
        <input name="department" type="department" class="form-control @error('department') is-invalid @enderror" placeholder="department ID" value="{{ old('department') ?? $profile->department ?? ''}}" aria-label="department" aria-describedby="department" autocomplete="department" {{$wedform}}>

        @error('department')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<!-- memberphoto optional -->
<div class="row wed-form-row">
    <div class="col-sm-4">
        <div class="upload-cover">
            <label for="imageOne" class="btn btn-upload btn-red">{{ __('Photo') }}<i class="fa fa-upload" aria-hidden="true"></i>
                <input hidden type="file" name="imageOne" id="imageOne" class="@error('imageOne') is-invalid @enderror mb-4" accept="image/*" value="{{asset('storage\defaultsv1').'\avatar.png' ?? $profile->imageOne ?? '' }}" autocomplete="imageOne" aria-label="imageOne" {{$wedform}}></label>
            @error('imageOne')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @isset($profile)
            @if($profile == null)
            <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="125px" height="100px">
            @else
            <img src="{{asset('storage').$profile->imageOne}}" alt="profilePhoto" id="imageOneTag" width="125px" height="100px">
            @endif
            @endisset

        </div>
    </div>
    <div class="col-sm-4">
        <div class="upload-cover">
            <label for="imageOne" class="btn btn-upload btn-red">{{ __('Identity Card') }}<i class="fa fa-upload" aria-hidden="true"></i>
                <input hidden type="file" name="imageTwo" id="imageTwo" class="@error('imageTwo') is-invalid @enderror mb-4" accept="image/*" value="{{asset('storage\defaultsv1').'\avatar.png' ?? $profile->imageTwo ?? '' }}" autocomplete="imageTwo" aria-label="imageTwo" {{$wedform}}></label>
            @error('imageTwo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @isset($profile)
            @if($profile == null)
            <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="125px" height="100px">
            @else
            <img src="{{asset('storage').$profile->imageTwo}}" alt="profilePhoto" id="imageOneTag" width="125px" height="100px">
            @endif
            @endisset

        </div>
    </div>

</div>


<!-- guestphoto optional ends-->

@if($wedform != 'disabled')
<div class="form-group row m-4">
    <div class="col-sm-2 offset-sm-5">
        <button type="submit" class="btn btn-sm wed-btn-main">
            <span class="material-icons">save</span>
        </button>
    </div>
</div>
@endif
