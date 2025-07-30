<!-- accommodation -->
<div class="row wed-form-row">
    <div class="input-group col-md-4 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="name">{{ __('Name*') }}</span>
        </div>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') ?? '' }}" aria-label="name" aria-describedby="name" autocomplete="name" autofocus {{$wedform}}>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="input-group col-md-5 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="fatherName">{{ __('Father Name*')}}</span>
        </div>
        <input name="fatherName" type="text" class="form-control @error('fatherName') is-invalid @enderror" placeholder="fatherName" value="{{ old('fatherName') ??  ''}}" aria-label="fatherName" aria-describedby="fatherName" autocomplete="fatherName" {{$wedform}}>
        @error('fatherName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="input-group col-md-3 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="surname">{{ __('Surname')}}</span>
        </div>
        <input name="surname" type="text" class="form-control @error('surname') is-invalid @enderror" placeholder="surname" value="{{ old('surname') ?? ''}}" aria-label="surname" aria-describedby="surname" autocomplete="surname" {{$wedform}}>
        @error('surname')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row wed-form-row">
    <div class="input-group col-md-2 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="age">{{ __('Age') }}</span>
        </div>
        <input name="age" type="text" class="form-control @error('age') is-invalid @enderror" placeholder="Age" value="{{ old('age') ??  ''}}" aria-label="age" aria-describedby="age" autocomplete="age" {{$wedform}}>

        @error('age')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="input-group col-md-3 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="gender">{{ __('Gender*')}}</span>
        </div>
        <input name="gender" type="text" class="form-control @error('gender') is-invalid @enderror" placeholder="gender" value="{{ old('gender')  ?? ''}}" aria-label="gender" aria-describedby="gender" autocomplete="gender" {{$wedform}}>
        @error('gender')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="input-group col-md-3 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="relation">{{ __('Relation')}}</span>
        </div>
        <input name="relation" type="text" class="form-control @error('relation') is-invalid @enderror" placeholder="relation" value="{{ old('relation') ?? ''}}" aria-label="relation" aria-describedby="relation" autocomplete="relation" {{$wedform}}>
        @error('relation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="input-group col-md-4 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="email">{{ __('Email') }}</span>
        </div>
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email ID" value="{{ old('email') ??  ''}}" aria-label="email" aria-describedby="email" autocomplete="email" {{$wedform}}>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row wed-form-row">

    <div class="input-group col-md-3 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="phone">{{ __('Phone*')}}</span>
        </div>
        <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Landline Phone" value="{{ old('phone')  ?? ''}}" aria-label="phone" aria-describedby="phone" autocomplete="phone" {{$wedform}}>
        @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="input-group col-md-3 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="mobile1">{{ __('Mobile')}}</span>
        </div>
        <input name="mobile1" type="text" class="form-control @error('mobile1') is-invalid @enderror" placeholder="Mobile No." value="{{ old('mobile1')  ?? ''}}" aria-label="mobile1" aria-describedby="mobile1" autocomplete="mobile1" {{$wedform}}>
        @error('mobile1')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="input-group col-md-3 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="mobile2">{{ __('Mobile') }}</span>
        </div>
        <input name="mobile2" type="text" class="form-control @error('mobile2') is-invalid @enderror" placeholder="Alternate Mobile No." value="{{ old('mobile2')  ?? ''}}" aria-label="mobile2" aria-describedby="mobile2" autocomplete="mobile2" {{$wedform}}>

        @error('mobile2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="input-group col-md-3 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="whatsup">{{ __('Whatsup')}}</span>
        </div>
        <input name="whatsup" type="text" class="form-control @error('whatsup') is-invalid @enderror" placeholder="Whatsup No." value="{{ old('whatsup') ?? ''}}" aria-label="whatsup" aria-describedby="whatsup" autocomplete="whatsup" {{$wedform}}>
        @error('whatsup')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<!-- guestphoto optional -->
<div class="row wed-form-row">
    <div class="input-group col-md-4 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text mr-2" id="hostImage">{{ __('Photo')}}</span>
        </div>
        <input name="hostImage" type="file" class="form-control @error('hostImage') is-invalid @enderror" placeholder="Upload Your Photo" value="{{asset('storage\guests').'\guestDefault.png'  ?? '' }}" aria-label="hostImage" aria-describedby="hostImage" autocomplete="hostImage" {{$wedform}}>
        @error('hostImage')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

</div>
<!-- guestphoto optional ends-->

@if($wedform != 'disabled')
<div class="form-group row mb-3">
    <div class="col-md-2 offset-md-5">
        <button type="submit" class="btn wed-form-button">
            <span class="material-icons">save</span>
        </button>
    </div>
</div>
@endif
