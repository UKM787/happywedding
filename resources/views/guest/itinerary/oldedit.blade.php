@extends('layouts.guest')
@section('content')
<div class="row bg-info">
  <div class="col">Invitation : {{$invitation->name}}</div>
  <div class="col">Guest: {{$user->name}}</div>
  <div class="col">Host: {{$invitation->host->name}}</div>
</div>
<table class="table table-bordered">
  <thead class="bg-nav">

    <th>Relation</th>
    <th>Name</th>
    <th>Age</th>
    <th>Gender</th>
    <th>Mobile</th>
    <th>Attending</th>

  <tbody>
    @foreach($user->guestfamily as $familymember)
    <tr>
      <td>{{$familymember->guest_relation}}</td>
      <td>{{$familymember->name}}</td>
      <td>{{$familymember->age}}</td>
      <td>{{$familymember->gender}}</td>
      <td>{{$familymember->mobile}}</td>
      <td>
        <form action="" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <input type="hidden" name="{{$familymember->slug}}">
          <label class="checkbox {{ $familymember->share ? '' : 'is-complete' }}" for="share">
            <input type="checkbox" name="share" value="{{ 'share' ? true : false}}" {{$familymember->share ? 'checked' : ''}}>
            {{$familymember->share ? 'attending' : 'notattending'}}
          </label>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="row justify-content-center mb-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header text-success text-center bg-nav text-muted h4">{{ __('Guest Arrival') }}</div>

      <div class="card-body">
        <form method="POST" action="{{route('itinerary.update',[$user, $invitation, $itinerary])}}">
          @csrf

          <div class="form-group row">
            <div class="col-md-2 mt-2">
              <label class="checkbox {{ $itinerary->pickup ? '' : 'is-complete' }}" for="pickup">
                <input type="checkbox" name="pickup" id="pickup" value="{{ $itinerary->pickup ? true : false }}" {{$itinerary->pickup ? 'checked' : ''}}>
                {{$itinerary->pickup ? 'Pickup Required' : 'Pickup Not Required'}}
              </label>
            </div>
          </div>

          <div class="form-group row">
            <label for="date" class="col-md-2 col-form-label text-md-right">{{ __('Arrival Date') }}</label>

            <div class="col-md-3">
              <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') ?? $itinerary->date}}" required autocomplete="date" autofocus>

              @error('date')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="arr_time" class="col-md-2 col-form-label text-md-right">{{ __('Arrival Time') }}</label>

            <div class="col-md-2">
              <input id="arr_time" type="time" class="form-control @error('arr_time') is-invalid @enderror" name="arr_time" value="{{ old('arr_time') ?? $itinerary->arr_time}}" required autocomplete="arr_time" autofocus>

              @error('arr_time')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="location" class="col-md-1 col-form-label text-md-right">{{ __('Arrival Location') }}</label>

            <div class="col-md-2">
              <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') ?? $itinerary->location }}" required autocomplete="location" autofocus>

              @error('location')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div>

          <div class="form-group row">

            <label for="arr_travelMode" class="col-md-2 col-form-label text-md-right">{{ __('Mode of Travel') }}</label>

            <div class="col-md-2">
              <input id="arr_travelMode" type="text" class="form-control @error('arr_travelMode') is-invalid @enderror" name="arr_travelMode" value="{{ old('arr_travelMode') ?? $itinerary->arr_travelMode}}" required autocomplete="arr_travelMode" autofocus>

              @error('arr_travelMode')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="arr_familyMembers'" class="col-md-2 col-form-label text-md-right">{{ __('Family Members') }}</label>

            <div class="col-md-2">
              <input id="arr_familyMembers" type="text" class="form-control @error('arr_familyMembers') is-invalid @enderror" name="arr_familyMembers" value="{{ old('arr_familyMembers') ?? $itinerary->arr_familyMembers}}" required autocomplete="arr_familyMembers" title="No. of Family Members Attending" autofocus>

              @error('arr_familyMembers')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div>

          <!-- form data to be filled by Host -->
          <!-- <div class="form-group row">

            <label for="driverName" class="col-md-2 col-form-label text-md-right">{{ __('Driver Name') }}</label>

            <div class="col-md-2">
              <input id="driverName" type="text" class="form-control @error('driverName') is-invalid @enderror" name="driverName" value="{{ old('driverName') }}" required autocomplete="driverName" autofocus>

              @error('driverName')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="driverMobile" class="col-md-2 col-form-label text-md-right">{{ __('Driver Mobile') }}</label>

            <div class="col-md-2">
              <input id="driverMobile" type="text" class="form-control @error('driverMobile') is-invalid @enderror" name="driverMobile" value="{{ old('driverMobile') }}" required autocomplete="driverMobile" autofocus>

              @error('driverMobile')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="vehicleNo" class="col-md-2 col-form-label text-md-right">{{ __('Vehicle No.') }}</label>

            <div class="col-md-2">
              <input id="vehicleNo" type="text" class="form-control @error('vehicleNo') is-invalid @enderror" name="vehicleNo" value="{{ old('vehicleNo') }}" required autocomplete="vehicleNo" autofocus>

              @error('vehicleNo')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div>

          <div class="form-group row">

            <label for="inchargeName" class="col-md-2 col-form-label text-md-right">{{ __('Incharge Name') }}</label>

            <div class="col-md-2">
              <input id="inchargeName" type="text" class="form-control @error('inchargeName') is-invalid @enderror" name="inchargeName" value="{{ old('inchargeName') }}" required autocomplete="inchargeName" autofocus>

              @error('inchargeName')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="inchargeMobile" class="col-md-2 col-form-label text-md-right">{{ __('Incharge Mobile') }}</label>

            <div class="col-md-2">
              <input id="inchargeMobile" type="text" class="form-control @error('inchargeMobile') is-invalid @enderror" name="inchargeMobile" value="{{ old('inchargeMobile') }}" required autocomplete="inchargeMobile" autofocus>

              @error('inchargeMobile')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="inchargeLocation" class="col-md-2 col-form-label text-md-right">{{ __('Incharge Location') }}</label>

            <div class="col-md-2">
              <input id="inchargeLocation" type="text" class="form-control @error('inchargeLocation') is-invalid @enderror" name="inchargeLocation" value="{{ old('inchargeLocation') }}" required autocomplete="inchargeLocation" autofocus>

              @error('inchargeLocation')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div> -->


          <!-- </form> -->
      </div>
    </div>
  </div>
</div>

<div class="row justify-content-center mb-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header text-success text-center bg-nav text-muted h4">{{ __('Guest Departure') }}</div>

      <div class="card-body">
        <form method="POST" action="{{route('itinerary.store',[$user, $invitation])}}">
          @csrf

          <div class="form-group row">
            <div class="col-md-2 mt-2">
              <label class="checkbox {{ $itinerary->dropdown ? '' : 'is-complete' }}" for="dropdown">
                <input type="checkbox" name="dropdown" id="dropdown" value="{{ $itinerary->dropdown ? true : false }}" {{$itinerary->dropdown ? 'checked' : ''}}>
                {{$itinerary->dropdown ? 'Pickup Required' : 'Pickup Not Required'}}
              </label>
            </div>
          </div>

          <div class="form-group row">
            <label for="date" class="col-md-2 col-form-label text-md-right">{{ __('Depature Date') }}</label>

            <div class="col-md-3">
              <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') ?? $itinerary->date}}" required autocomplete="date" autofocus>

              @error('date')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="dep_time" class="col-md-2 col-form-label text-md-right">{{ __('Departure Time') }}</label>

            <div class="col-md-2">
              <input id="dep_time" type="time" class="form-control @error('dep_time') is-invalid @enderror" name="dep_time" value="{{ old('dep_time') ?? $itinerary->dep_time}}" required autocomplete="dep_time" autofocus>

              @error('dep_time')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="location" class="col-md-1 col-form-label text-md-right">{{ __('Location') }}</label>

            <div class="col-md-2">
              <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') ?? $itinerary->location}}" required autocomplete="location" autofocus>

              @error('location')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div>

          <div class="form-group row">

            <label for="dep_travelMode" class="col-md-2 col-form-label text-md-right">{{ __('Mode of Travel') }}</label>

            <div class="col-md-2">
              <input id="dep_travelMode" type="text" class="form-control @error('dep_travelMode') is-invalid @enderror" name="dep_travelMode" value="{{ old('dep_travelMode') ?? $itinerary->dep_travelMode}}" required autocomplete="dep_travelMode" autofocus>

              @error('dep_travelMode')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="dep_familyMembers" class="col-md-2 col-form-label text-md-right">{{ __('Family Members') }}</label>

            <div class="col-md-2">
              <input id="dep_familyMembers" type="text" class="form-control @error('dep_familyMembers') is-invalid @enderror" name="dep_familyMembers" value="{{ old('dep_familyMembers') ?? $itinerary->dep_familyMembers }}" required autocomplete="dep_familyMembers" autofocus>

              @error('dep_familyMembers')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div>

          <!-- form data to be filled by host -->
          <!-- <div class="form-group row">

            <label for="driverName" class="col-md-2 col-form-label text-md-right">{{ __('Driver Name') }}</label>

            <div class="col-md-2">
              <input id="driverName" type="text" class="form-control @error('driverName') is-invalid @enderror" name="driverName" value="{{ old('driverName') }}" required autocomplete="driverName" autofocus>

              @error('driverName')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="driverMobile" class="col-md-2 col-form-label text-md-right">{{ __('Driver Mobile') }}</label>

            <div class="col-md-2">
              <input id="driverMobile" type="text" class="form-control @error('driverMobile') is-invalid @enderror" name="driverMobile" value="{{ old('driverMobile') }}" required autocomplete="driverMobile" autofocus>

              @error('driverMobile')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="vehicleNo" class="col-md-2 col-form-label text-md-right">{{ __('Vehicle No.') }}</label>

            <div class="col-md-2">
              <input id="vehicleNo" type="text" class="form-control @error('vehicleNo') is-invalid @enderror" name="vehicleNo" value="{{ old('vehicleNo') }}" required autocomplete="vehicleNo" autofocus>

              @error('vehicleNo')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div>

          <div class="form-group row">

            <label for="inchargeName" class="col-md-2 col-form-label text-md-right">{{ __('Incharge Name') }}</label>

            <div class="col-md-2">
              <input id="inchargeName" type="text" class="form-control @error('inchargeName') is-invalid @enderror" name="inchargeName" value="{{ old('inchargeName') }}" required autocomplete="inchargeName" autofocus>

              @error('inchargeName')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="inchargeMobile" class="col-md-2 col-form-label text-md-right">{{ __('Incharge Mobile') }}</label>

            <div class="col-md-2">
              <input id="inchargeMobile" type="text" class="form-control @error('inchargeMobile') is-invalid @enderror" name="inchargeMobile" value="{{ old('inchargeMobile') }}" required autocomplete="inchargeMobile" autofocus>

              @error('inchargeMobile')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="inchargeLocation" class="col-md-2 col-form-label text-md-right">{{ __('Incharge Location') }}</label>

            <div class="col-md-2">
              <input id="inchargeLocation" type="text" class="form-control @error('inchargeLocation') is-invalid @enderror" name="inchargeLocation" value="{{ old('inchargeLocation') }}" required autocomplete="inchargeLocation" autofocus>

              @error('inchargeLocation')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div> -->

          <div class="form-group row mb-3">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                {{ __('Submit') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
