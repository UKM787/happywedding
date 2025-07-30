<!-- guestfamily -->

<div class="row">
    <div class="col-md-7 mb-3">
        <label class="form-label" id="name">{{ __('Name*') }}</label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ isset($family->name) ? $family->name : '' ?? old('name')  }}" aria-label="name" aria-describedby="name" autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label" id="age">{{ __('Age') }}</label>
        <input name="age" type="text" class="form-control @error('age') is-invalid @enderror" placeholder="Age" value="{{ isset($family->age) ? $family->age : '' ?? old('age')  }}" aria-label="age" aria-describedby="age" autocomplete="age">
        @error('age')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" id="gender">{{ __('Gender*')}}</label>
        <input name="gender" type="text" class="form-control @error('gender') is-invalid @enderror" placeholder="gender" value="{{ isset($family->gender) ? $family->gender : '' ?? old('gender')  }}" aria-label="gender" aria-describedby="gender" autocomplete="gender">
        @error('gender')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label" id="relation">{{ __('Relation')}}</label>
        <input name="relation" type="text" class="form-control @error('relation') is-invalid @enderror" placeholder="relation" value="{{ isset($family->relation) ? $family->relation : '' ?? old('relation')  }}" aria-label="relation" aria-describedby="relation" autocomplete="relation">
        @error('relation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label" id="mobile">{{ __('Mobile')}}</label>
        <input name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile No." value="{{ isset($family->mobile) ? $family->mobile : '' ?? old('mobile')  }}" aria-label="mobile" aria-describedby="mobile" autocomplete="mobile">
        @error('mobile')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<!-- guestkyc  -->
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label" id="imageOne">{{ __('Photo')}}</label>
        <input name="imageOne" type="file" class="form-control @error('imageOne') is-invalid @enderror" placeholder="Upload Your Photo" value="{{ asset('storage\guests').'\guestDefault.png' ?? $family->imageOne }}" aria-label="imageOne" aria-describedby="imageOne" autocomplete="imageOne">
        @error('imageOne')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-2">
        @if(isset($family->imageOne))
        <img src="{{asset('storage/'.$family->imageOne)}}" alt="" width="75px" height="50px">
        @else
        <img src="{{asset('storage/guests').'/guestDefault.png'}}" alt="" width="75px" height="50px">
        @endif
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label" id="imageTwo">{{ __('Photo')}}</lebel>
            <input name="imageTwo" type="file" class="form-control @error('imageTwo') is-invalid @enderror" placeholder="Upload Your Photo" value="{{asset('storage\guests').'\guestDefault.png' ?? $family->imageTwo ?? '' }}" aria-label="imageTwo" aria-describedby="imageTwo" autocomplete="imageTwo">
            @error('imageTwo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
    </div>
    <div class="col-md-2">
        @if(isset($family->imageTwo))
        <img src="{{asset('storage/'.$family->imageTwo)}}" alt="" width="50px" height="50px">
        @else
        <img src="{{asset('storage/guests').'/guestDefault.png'}}" alt="" width="50px" height="50px">
        @endif
    </div>
</div>
