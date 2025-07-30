 <div class="row my-3">
    <label for="name" class="btn btn-xs mb-3">Display name</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $val['name'] ?? $ceramony->name ?? ''}}">
    <input name="type" type="hidden" class="form-control @error('type') is-invalid @enderror" id="name" value="{{$val['type'] ?? $ceramony->type}}">
</div>
<div class="row g-3">
    <div class="col-6">
        <label for="startDate" class="btn btn-xs">Start Date / Time</label>
        <div class="input-group">
            @if($submitBtn == 'update')
            <input name="startDate" type="datetime-local" class="form-control @error('startDate') is-invalid @enderror" value="{{ old('startDate') ?? $ceramony->startDate ?? \Carbon\Carbon::now() }}" aria-label="startDate">
            @else
            <input name="startDate" type="datetime-local" class="form-control @error('startDate') is-invalid @enderror" value="{{ old('startDate') ?? $ceramony->startDate ?? \Carbon\Carbon::now() }}" aria-label="startDate" min="{{substr(str_replace(' ','T',Carbon\Carbon::now()),0,17).'00'}}">
            @endif
            @error('startDate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <label for="endDate" class="btn btn-xs">End Date / Time</label>
        <div class="input-group">
            @if($submitBtn == 'update')
            <input name="endDate" type="datetime-local" class="form-control @error('endDate') is-invalid @enderror" value="{{ old('endDate') ?? $ceramony->endDate ?? \Carbon\Carbon::now() }}" aria-label="endDate">
            @else
            <input name="endDate" type="datetime-local" class="form-control @error('endDate') is-invalid @enderror" value="{{ old('endDate') ?? $ceramony->endDate ?? \Carbon\Carbon::now() }}" aria-label="endDate" min="{{substr(str_replace(' ','T',Carbon\Carbon::now()),0,17).'00'}}">
            @endif
            @error('endDate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>

<div class="row mt-3 mb-3">
    <div class="col-6">
        <label for="venue_id" class="btn btn-xs mb-2">Venue </label>
        <a href="/host/venues/create">(Not Finding Your Perfect Venue? Add One!!)</a>
        <div class="input-group">
            <select name="venue_id" id="venue_id" class="form-control @error('venue_id') is-invalid @enderror">
                @foreach ($venues as $key => $value)
                <option value="{{ $key }}" @if(isset($ceramony->venues->first()->id)) {{ ( $key ==  $ceramony->venues->first()->id ) ? 'selected' : '' }} @endif> {{ $value}} </option>
                @endforeach
            </select>
            @error('venue_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-6 text-center">
        <label for="imageOne" class="btn btn-upload btn-red mb-3">{{__(' Ceramony Photo ')}}<i class="fa fa-upload" aria-hidden="true"></i></label>
        <div class="upload-cover">

            <input hidden type="file" name="imageOne" id="imageOne" class="form-control  @error('imageOne') is-invalid @enderror" value="{{ $ceramony->imageOne ?? asset('storage').$val['imageOne'] ?? '' }}" {{$wedform}}>

            @error('imageOne')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @if($ceramony->imageOne == null)
            <img src="{{asset('storage').$val['imageOne']}}" id="imageOneTag" alt="CeramonyPhoto" width="200px" height="auto">
            @else
            <img src="{{asset('storage').$ceramony->imageOne}}" id="imageOneTag" alt="CeramonyPhoto" width="200px" height="auto">
            @endif
        </div>
    </div>
</div>

<h5 class="btn btn-xs">Dress code</h5>
<div class="row mt-3 mb-5">
    <div class="col-6">
        <div class="upload-cover">
            <label for="imageTwo" class="btn btn-upload btn-red">{{__(' Girls')}} <i class="fa fa-upload" aria-hidden="true"></i></label>
            <input hidden type="file" name="imageTwo" id="imageTwo" class="form-control  @error('imageTwo') is-invalid @enderror" value="{{$ceramony->imageTwo ?? asset('storage\ceramony').$val['ladiesDress'] ?? '' }}" {{$wedform}}>
            @error('imageTwo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @if($ceramony->imageTwo == null)
            <img src="{{asset('storage').$val['ladiesDress']}}" id="imageTwoTag" alt="LadiesDressCode" width="100px" height="75px">
            @else
            <img src="{{asset('storage').$ceramony->imageTwo}}" id="imageTwoTag" alt="LadiesDressCode" width="100px" height="75px">
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="upload-cover">
            <label for="imageThree" class="btn btn-upload btn-red">{{__(' Boys ')}}<i class="fa fa-upload" aria-hidden="true"></i></label>
            <input hidden type="file" name="imageThree" id="imageThree" class="form-control  @error('imageThree') is-invalid @enderror" value="{{$ceramony->imageThree ?? asset('storage\ceramony').$val['gentsDress']  ?? '' }}" {{$wedform}}>
            @error('imageThree')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if($ceramony->imageThree == null)
            <img src="{{asset('storage').$val['gentsDress']}}" id="imageThreeTag" alt="GentsDressCode" width="100px" height="75px">
            @else
            <img src="{{asset('storage').$ceramony->imageThree}}" id="imageThreeTag" alt="GentsDressCode" width="100px" height="75px">
            @endif
        </div>
    </div>
</div>


@if($wedform != 'disabled')

<div class="form-group row justify-content-center mb-3 ">
    <div class="col-sm-1">
        <button type="submit" class="btn btn-sm wed-btn-main">
            <span class="material-icons">save</span>
        </button>
    </div>
    <div class="col-sm-1 offset-sm-2">
        <a href="{{route('invitedguests.index', [$invitation])}}" class="btn btn-sm wed-btn-main"> <span class="material-icons">
                skip_next
            </span>
        </a>
    </div>
</div>
@endif
