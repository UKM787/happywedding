<div class="form-group row mb-2">
    {{-- <div class="col">\
        
        <label for="startDate" for="startDate">{{ __('Date') }}
            <input id="startDate" type="datetime-local" value="{{ $savedate->startDate ??  old('startDate') ?? \Carbon\Carbon::now() }}"  class=" form-control @error('startDate') is-invalid @enderror" name="startDate" required autocomplete=" startDate" autofocus {{$wedform}} min="{{substr(str_replace(' ','T',Carbon\Carbon::now()),0,17).'00'}}"></label>
        @error('startDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> --}}
    <div class="col">
        <label for="upload" class="form-label" style="visibility: hidden">{{ __('Upload Photo')}}</label>
        <div class="upload-cover">
            <label class="btn btn-upload btn-red" for="imageOne">{{ __(' Upload Photo ')}}<i class="fa fa-upload" aria-hidden="true"></i></label>
            <input type="file" hidden name="imageOne" id="imageOne" class="form-control @error('imageOne') is-invalid @enderror" accept="image/*" value="{{asset('storage').$pic ?? $savedate->imageOne ?? '' }}" autocomplete="imageOne" {{$wedform}} aria-label="imageOne" aria-describedby="imageOne">
            @error('imageOne')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="mb-5">
            <label for="upload" class="form-label" style="visibility: hidden">{{ __('Upload Photo')}}</label>
            @if($savedate->imageOne == null)
            <img src="{{asset('storage').$pic}}" id="imageOneTag" alt="SavetheDate Photo" width="150px" height="100px">
            @else
            <img src="{{asset('storage/'.$savedate->imageOne)}}" alt="SavetheDate Photo" id="imageOneTag" width="150px" height="100px">
            @endif
        </div>
    </div>
</div>

@if($wedform != 'disabled')
<div class="form-group row mb-2 mb-3">
    <div class="col-sm-12 text-center">
        <button type="submit" class="btn wed-btn-main btn-sm">
            <span class="material-icons">
                save
            </span>
        </button>
    </div>
</div>
@endif
<!-- .card-body ends -->
