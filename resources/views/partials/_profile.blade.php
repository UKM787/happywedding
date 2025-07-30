<!-- hostprofile -->
<div class="row">
    <div class="col-md-5 mb-3">
        <label class="form-label" id="name">{{ __('Name*') }}</label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') ?? $profile->name ?? '' }}" aria-label="name" aria-describedby="name" autocomplete="name" autofocus {{$wedform}}>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-5 mb-3">
        <label class="form-label" id="fatherName">{{ __('Father Name*')}}</label>
        <input name="fatherName" type="text" class="form-control @error('fatherName') is-invalid @enderror" placeholder="fatherName" value="{{ old('fatherName') ?? $profile->fatherName ?? ''}}" aria-label="fatherName" aria-describedby="fatherName" autocomplete="fatherName" {{$wedform}}>
        @error('fatherName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-2 mb-3">
        <Label class="form-label" id="surname">{{ __('Surname')}}</Label>
        <input name="surname" type="text" class="form-control @error('surname') is-invalid @enderror" placeholder="surname" value="{{ old('surname') ?? $profile->surname ?? ''}}" aria-label="surname" aria-describedby="surname" autocomplete="surname" {{$wedform}}>
        @error('surname')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-2 mb-3">
        <label class="form-label" id="age">{{ __('Age') }}</label>
        <input name="age" type="text" class="form-control @error('age') is-invalid @enderror" placeholder="Age" value="{{ old('age') ?? $profile->age ?? ''}}" aria-label="age" aria-describedby="age" autocomplete="age" {{$wedform}}>
        @error('age')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" id="gender">{{ __('Gender*')}}</label>
        <input name="gender" type="text" class="form-control @error('gender') is-invalid @enderror" placeholder="gender" value="{{ old('gender') ?? $profile->gender ?? ''}}" aria-label="gender" aria-describedby="gender" autocomplete="gender" {{$wedform}}>
        @error('gender')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" id="relation">{{ __('Relation')}}</label>
        <input name="relation" type="text" class="form-control @error('relation') is-invalid @enderror" placeholder="relation" value="{{ old('relation') ?? $profile->relation ?? ''}}" aria-label="relation" aria-describedby="relation" autocomplete="relation" {{$wedform}}>
        @error('relation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label" id="email">{{ __('Email') }}</label>
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email ID" value="{{ old('email') ?? $profile->email ?? ''}}" aria-label="email" aria-describedby="email" autocomplete="email" {{$wedform}}>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
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
        @if(isset($route) && $route == 'guestprofile.edit')
        <label class="btn btn-upload btn-red" {{$wedform}}>{{ __('Photo') }}<i class="fa fa-upload" aria-hidden="true"></i>
            <input hidden type="file" name="imageOne" id="imageOne" class="@error('imageOne') is-invalid @enderror mb-4" accept="image/*" value="{{$profile->imageOne ?? asset('storage\defaultsv1').'\avatar.png' ??  '' }}" autocomplete="imageOne" aria-label="imageOne" {{$wedform}}></label>
        @error('imageOne')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @if(isset($profile->imageOne) )
        <img src="{{asset('storage').'/'.$profile->imageOne}}" alt="profilePhoto" id="imageOneTag" width="125px" height="100px">

        @else
        <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="125px" height="100px">
        @endif

        @else
        @if(isset($profile->imageOne) )
        <img src="{{asset('storage').'/'.$profile->imageOne}}" alt="profilePhoto" id="imageOneTag" width="125px" height="100px">

        @else
        <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="125px" height="100px">
        @endif


        @endif



    </div>
</div>
