


<div class="form-group-sm row mb-1">
    <div class="col-sm-4">
        <label for="brideName" class="form-label">{{ __('Bride Name') }}</label>
        <input id="brideName" type="text" class="form-control @error('brideName') is-invalid @enderror" name="brideName" value="{{ old('brideName') ?? $invitation->brideName ?? '' }}" autocomplete="brideName" autofocus {{$wedform}}>
        @error('brideName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-4">
        <label for="brideMobile" class="form-label">{{ __('Bride Mobile No.') }}</label>
        <input id="brideMobile" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" type="number" class="form-control @error('brideMobile') is-invalid @enderror" name="brideMobile" value="{{ old('brideMobile') ?? $invitation->brideMobile ?? '' }}" autocomplete="brideMobile" {{$wedform}}>

        @error('brideMobile')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-4">
        <label for="brideEmail" class="form-label">{{ __('Bride Email') }}</label>
        <input id="brideEmail" type="text" class="form-control @error('brideEmail') is-invalid @enderror" name="brideEmail" value="{{ old('brideEmail') ?? $invitation->brideEmail ?? '' }}" autocomplete="brideEmail" {{$wedform}}>

        @error('brideEmail')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group-sm row mb-1">
    <div class="col-sm-6">
        <label for="brideMotherName" class="form-label">{{ __('Bride Mother Name') }}</label>
        <input id="brideMotherName" type="text" class="form-control @error('brideMotherName') is-invalid @enderror" name="brideMotherName" value="{{ old('brideMotherName') ?? $invitation->brideMotherName ?? '' }}" autocomplete="brideMotherName" {{$wedform}}>
        @error('brideMotherName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-6">
        <label for="brideFatherName" class="form-label">{{ __('Bride Father Name') }}</label>
        <input id="brideFatherName" type="text" class="form-control @error('brideFatherName') is-invalid @enderror" name="brideFatherName" value="{{ old('brideFatherName') ?? $invitation->brideFatherName ?? '' }}" autocomplete="brideFatherName" {{$wedform}}>

        @error('brideFatherName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group-sm row mb-1">
    <div class="col-sm-4">
        <label for="groomName" class="form-label">{{ __('Groom Name') }}</label>
        <input id="groomName" type="text" class="form-control @error('groomName') is-invalid @enderror" name="groomName" value="{{ old('groomName') ?? $invitation->groomName ?? '' }}" autocomplete="groomName" {{$wedform}}>
        @error('groomName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-4">
        <label for="groomMobile" class="form-label">{{ __('Groom Mobile No.') }}</label>
        <input id="groomMobile" type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" class="form-control @error('groomMobile') is-invalid @enderror" name="groomMobile" value="{{ old('groomMobile') ?? $invitation->groomMobile ?? '' }}" autocomplete="groomMobile" {{$wedform}}>

        @error('groomMobile')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-4">
        <label for="groomEmail" class="form-label">{{ __('Groom Email') }}</label>
        <input id="groomEmail" type="text" class="form-control @error('groomEmail') is-invalid @enderror" name="groomEmail" value="{{ old('groomEmail') ?? $invitation->groomEmail ?? '' }}" autocomplete="groomEmail" {{$wedform}}>
        @error('groomEmail')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group-sm row mb-1">
    <div class="col-sm-6">
        <label for="brideMotherName" class="form-label">{{ __('Groom Mother Name') }}</label>
        <input id="groomMotherName" type="text" class="form-control @error('groomMotherName') is-invalid @enderror" name="groomMotherName" value="{{ old('groomMotherName') ?? $invitation->groomMotherName ?? '' }}" autocomplete="groomMotherName" {{$wedform}}>
        @error('groomMotherName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-6">
        <label for="groomFatherName" class="form-label">{{ __('Groom Father Name') }}</label>
        <input id="groomFatherName" type="text" class="form-control @error('groomFatherName') is-invalid @enderror" name="groomFatherName" value="{{ old('groomFatherName') ?? $invitation->groomFatherName ?? '' }}" autocomplete="groomFatherName" {{$wedform}}>
        @error('groomFatherName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="row mt-2">
    <div class="col">
        <label for="state" class="col-form">{{ __('State') }}</label>
        <select required name="state" id="state" class="form-control @error('state_id') is-invalid @enderror" data-saved="{{$invitation->state ?? ''}}">
            <option value="" selected>Select your state</option>
        </select>
        @error('state')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col">
        <label for="location_id" class="col-form">{{ __('City') }}</label>
        <select required name="location_id" id="location_id" class="form-control @error('location_id') is-invalid @enderror" data-old="{{old('location_id') ?? $invitation->location_id ?? ''}}">
            <option value="" selected>Select your State First</option>
        </select>
        @error('location_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<!-- @if (isset($invitation->startDate))
{{$invitation->startDate}}
@else
{{\Carbon\Carbon::now()}}
@endif -->
<div class="form-group-sm row mb-3">

    <div class="col-sm-4">
        <label for="startDate" class="form-label">{{ __('Wedding Starts') }}</label>
        <input id="startDate" type="datetime-local" value="{{ $invitation->startDate ?? old('startDate') ?? \Carbon\Carbon::now()  }}" class="form-control @error('startDate') is-invalid @enderror" name="startDate" min="{{substr(str_replace(' ','T',Carbon\Carbon::now()),0,17).'00'}}" autocomplete="startDate" {{$wedform}}>
        @error('startDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    {{--<div class="col-sm-4">
        <label for="endDate" class="form-label">{{ __('Wedding Completes') }}</label>
        <input id="endDate" type="datetime-local" value="{{$invitation->endDate ?? old('endDate') ??\Carbon\Carbon::now() }}" class="form-control @error('endDate') is-invalid @enderror" min="{{substr(str_replace(' ','T',Carbon\Carbon::now()),0,17).'00'}}" name="endDate" autocomplete="endDate" {{$wedform}}>
        @error('endDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> --}}

    <div class="col-sm-4">
        <label for="venue_id" class="form-label">{{ __('Venues') }} <a href="/host/venues/create">(Not Finding Your Perfect Venue? Add One!!)</a> </label>
        
        <select id="venue_id" type="text" class="form-control @error('venue_id') is-invalid @enderror" name="venue_id" {{$wedform}}>
            <option value="" selected disabled>Select your marriage venue</option>
            @foreach ($venues as $key => $val)
            <option value="{{ $key }}" @if(isset($invitation->venues->first()->id)) {{ ( $key ==  $invitation->venues->first()->id ) ? 'selected' : '' }} @endif> {{ $val}} </option>
            @endforeach
        </select>
        @error('venue_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group-sm row my-5">
    <div class="col-sm-2 offset-sm-3">
        <div class="upload-cover"><label for="imageOne" class="btn btn-upload btn-red"> Upload Photo <i aria-hidden="true" class="fa fa-upload"></i></label> <input type="file" name="imageOne" id="imageOne" accept="image/*" value="{{asset('storage').$invitation->imageOne}}" autocomplete="imageOne" aria-label="imageOne" aria-describedby="imageOne" class="form-control-file " hidden="hidden"></div>
    </div>
    @if(isset($invitation->imageOne))
    <div class="col-sm-2"><img src="{{asset('storage').$invitation->imageOne}}" alt="Invitation Cover Image" id="imageOneTag" width="150px" height="100px"></div>
    @else
    <div class="col-sm-2"><img src="{{asset('storage').'/defaultsv1/invitationv0/cover1.png'}}" alt="Invitation Cover Image" id="imageOneTag" width="150px" height="100px"></div>
    @endif
</div>

@if($wedform != 'disabled')
<div class="form-group-sm row mt-3">
    <div class="col-sm-2 offset-sm-5">
        <button type="submit" class="btn wed-btn-main btn-sm">
            <span class="material-icons">
                save
            </span>
        </button>
    </div>
</div>
@endif
