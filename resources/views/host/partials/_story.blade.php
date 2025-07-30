<div class="form-group row">
    <div class="col-sm-6">
        <label for="intro" class="form-label">{{ __('How We Met') }}</label>
        <textarea id="intro" type="text" class="form-control @error('intro') is-invalid @enderror" name="intro" required autocomplete="intro" {{$wedform}}> {{ old('intro') ?? $story->intro ?? '' }}</textarea>
        @error('intro')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-2">
        <div class="upload-cover">
            <label for="imageOne" class="btn btn-upload btn-red">{{ __('Banner') }}<i class="fa fa-upload" aria-hidden="true"></i></label>
            <input hidden type="file" name="imageOne" id="imageOne" class="form-control @error('imageOne') is-invalid @enderror mb-4" value="{{asset('storage').$imageOne ?? $story->imageOne ?? '' }}" {{$wedform}}>
            @error('imageOne')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if($story->imageOne == null)
            <img src="{{asset('storage').$imageOne}}" alt="Banner" id="imageOneTag" width="100px" height="75px">
            @else
            <img src="{{asset('storage/'.$story->imageOne)}}" alt="WeMet" id="imageOneTag" width="100px" height="75px">
            @endif
        </div>
    </div>
    <div class="col-sm-2">
        <div class="upload-cover">
            <label for="imageTwo" class="btn btn-upload btn-red">{{ __('FirstPhotoClicked') }}<i class="fa fa-upload" aria-hidden="true"></i></label>
            <input hidden type="file" name="imageTwo" id="imageTwo" class="form-control @error('imageTwo') is-invalid @enderror mb-4" value="{{asset('storage').$imageTwo ?? $story->imageTwo ?? ''}}" {{$wedform}}>
            @error('imageTwo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if($story->imageTwo == null)
            <img src="{{asset('storage').$imageTwo}}" alt="VenuePhoto" id="imageTwoTag" width="100px" height="75px">
            @else
            <img src="{{asset('storage/'.$story->imageTwo)}}" alt="WeMet" id="imageTwoTag" width="100px" height="75px">
            @endif
        </div>
    </div>
    <div class="col-sm-2">
        <div class="upload-cover">
            <label for="imageThree" class="btn btn-upload btn-red">{{ __('NextPhotoClicked') }}<i class="fa fa-upload" aria-hidden="true"></i></label>
            <input hidden type="file" name="imageThree" id="imageThree" class="form-control @error('imageThree') is-invalid @enderror mb-4" value="{{asset('storage').$imageThree ?? $story->imageThree ?? '' }}" {{$wedform}}>
            @error('imageThree')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if($story->imageThree == null)
            <img src="{{asset('storage').$imageThree}}" alt="VenuePhoto" id="imageThreeTag" width="100px" height="75px">
            @else
            <img src="{{asset('storage/'.$story->imageThree)}}" alt="WeMet" id="imageThreeTag" width="100px" height="75px">
            @endif
        </div>
    </div>

</div>

<div class="form-group row">
    <div class="col-sm-4">
        <label for="firstMeet" class="form-label">{{ __('YearWeMet') }}</label>
        <input id="firstMeet" type="datetime-local" class="form-control @error('firstMeet') is-invalid @enderror" name="firstMeet" value="{{ $story->firstMeet ?? old('firstMeet') ?? \Carbon\Carbon::now() }}" required autocomplete="firstMeet" {{$wedform}}>
        @error('firstMeet')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-6">
        <label for="firstMeetDescription" class="form-label">{{ __('FirstMeet') }}</label>
        <textarea id="firstMeetDescription" type="text" class="form-control @error('firstMeetDescription') is-invalid @enderror" name="firstMeetDescription" required autocomplete="firstMeetDescription" {{$wedform}}> {{ old('firstMeetDescription') ?? $story->firstMeetDescription ?? '' }}</textarea>
        @error('firstMeetDescription')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-2">
        <div class="upload-cover">
            <label for="imageFour" class="btn btn-upload btn-red">{{ __('Photo') }}<i class="fa fa-upload" aria-hidden="true"></i></label>
            <input hidden type="file" name="imageFour" id="imageFour" class=" form-control @error('imageFour') is-invalid @enderror mb-4" value="{{asset('storage').$imageFour ?? $story->imageFour ?? '' }} {{$wedform}}">
            @error('imageFour')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if($story->imageFour == null)
            <img src="{{asset('storage'.$imageFour)}}" alt="VenuePhoto" id="imageFourTag" width="100px" height="75px">
            @else
            <img src="{{asset('storage/'.$story->imageFour)}}" alt="WeMet" id="imageFourTag" width="100px" height="75px">
            @endif
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-4">
        <label for="secondMeet" class="form-label">{{ __('YearWeCameClose') }}</label>
        <input id="secondMeet" type="datetime-local" class="form-control @error('secondMeet') is-invalid @enderror" name="secondMeet" value="{{ $story->secondMeet ?? old('secondMeet') ?? \Carbon\Carbon::now() }}" required autocomplete="secondMeet" {{$wedform}}>
        @error('secondMeet')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-6">
        <label for="secondMeetDescription" class="form-label">{{ __('Exchanged Hearts') }}</label>
        <textarea id="secondMeetDescription" type="text" class="form-control @error('secondMeetDescription') is-invalid @enderror" name="secondMeetDescription" required autocomplete="secondMeetDescription" {{$wedform}}> {{ old('secondMeetDescription') ?? $story->secondMeetDescription ?? '' }}</textarea>
        @error('secondMeetDescription')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-2">
        <div class="upload-cover">
            <label for="imageFive" class="btn btn-upload btn-red">{{ __('Photo') }}<i class="fa fa-upload" aria-hidden="true"></i></label>
            <input hidden type="file" name="imageFive" id="imageFive" class="form-control @error('imageFive') is-invalid @enderror mb-4" value="{{asset('storage').$imageFive ?? $story->imageFive ?? ''}}" {{$wedform}}>
            @error('imageFive')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if($story->imageFive == null)
            <img src="{{asset('storage').$imageFive}}" alt="VenuePhoto" id="imageFiveTag" width="100px" height="75px">
            @else
            <img src="{{asset('storage/'.$story->imageFive)}}" alt="WeMet" id="imageFiveTag" width="100px" height="75px">
            @endif
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-4">
        <label for="thirdMeet" class="form-label">{{ __('YearDecidedToMarry') }}</label>
        <input id="thirdMeet" type="datetime-local" class="form-control @error('thirdMeet') is-invalid @enderror" name="thirdMeet" value="{{  $story->thirdMeet ?? old('thirdMeet') ??\Carbon\Carbon::now() }}" required autocomplete="thirdMeet" {{$wedform}}>
        @error('thirdMeet')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-6">
        <label for="thirdMeetDescription" class="form-label">{{ __('HowDecidedToMarry') }}</label>
        <textarea id="thirdMeetDescription" type="text" class="form-control @error('thirdMeetDescription') is-invalid @enderror" name="thirdMeetDescription" required autocomplete="thirdMeetDescription" {{$wedform}}> {{ old('thirdMeetDescription') ?? $story->thirdMeetDescription ?? '' }}</textarea>
        @error('thirdMeetDescription')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-2">
        <div class="upload-cover">
            <label for="imageSix" class="btn btn-upload btn-red">{{ __('Photo') }}<i class="fa fa-upload" aria-hidden="true"></i></label>
            <input hidden type="file" name="imageSix" id="imageSix" class="@error('imageSix') is-invalid @enderror mb-4" value="{{asset('storage').$imageSix ?? $story->imageSix ?? ''  }}" {{$wedform}}>
            @error('imageSix')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if($story->imageSix == null)
            <img src="{{asset('storage').$imageSix}}" alt="WeMet" id="imageSixTag" width="100px" height="75px">
            @else
            <img src="{{asset('storage/'.$story->imageSix)}}" alt="WeMet" id="imageSixTag" width="100px" height="75px">
            @endif
        </div>
    </div>
</div>

@if($wedform != 'disabled')
<div class="form-group-sm row mb-2 mb-3">
    <div class="col-sm-12 text-center">
        <button type="submit" class="btn btn-sm wed-btn-main">
            <span class="material-icons">save</span>
        </button>
    </div>
</div>
@endif
