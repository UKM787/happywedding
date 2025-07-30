<div class="card text-muted">

    
    <div class="card-header text-success text-center bg-nav text-muted h4">{{ __('Guest Arrival') }}</div>
    <div class="card-body">
        <div class="row">
            <label for="date" class="col-sm-2 col-form-label ">{{ __('Date') }}</label>

            <div class="col-sm-10">
                @if($arrival->date)
                <input id="date" type="datetime-local" class="form-control @error('date') is-invalid @enderror" name="date" value="{{old('date') ??  $arrival->date->format('Y-m-d').'T'.$arrival->date->format('H:i') ?? substr(str_replace(' ','T',Carbon\Carbon::now()),0,17).'00'  }}" autocomplete="date" min="{{substr(str_replace(' ','T',Carbon\Carbon::now()),0,17).'00'}}" autofocus>
                @else
                <input style="border: 1px solid red ;" id="date" type="datetime-local" class="form-control @error('date') is-invalid @enderror" name="date" value="{{old('date') ?? substr(str_replace(' ','T',Carbon\Carbon::now()),0,17).'00'  }}" autocomplete="date" min="{{substr(str_replace(' ','T',Carbon\Carbon::now()),0,17).'00'}}" autofocus>
                @endif
                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row my-2">

            <label for="travelMode" class="col-sm-2 col-form-label ">{{ __('travelBy') }}</label>

            <div class="col-sm-4">
                <input id="travelMode" type="text" class="form-control @error('travelMode') is-invalid @enderror" name="travelMode" value="{{ old('travelMode') ?? $arrival['travelMode'] }}" autocomplete="travelMode">

                @error('travelMode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <label for="location" class="col-sm-2 col-form-label ">{{ __('Location') }}</label>

            <div class="col-sm-4">
                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') ?? $arrival['location']}}" autocomplete="location">

                @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row">

            <label for="memberCount'" class="col-sm-2">{{ __('Member') }}</label>

            <div class="col-sm-4">
                <input id="memberCount" type="text" class="form-control @error('memberCount') is-invalid @enderror" name="memberCount" value="{{ $count ?? $arrival['memberCount'] ?? ''}}" autocomplete="memberCount" title="No. of Family Members Attending">

                @error('memberCount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

        </div>
        <div class="row m-4 p-3 text-center">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-sm wed-btn-main">
                    <i class="material-icons">{{ __('save') }}</i></i>
                </button>
            </div>
        </div>
    </div>
</div>
