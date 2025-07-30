@extends('layouts.guest')
@section('content')
<div class="row bg-info my-3 py-3 h3">
  <div class="col">Invitation : {{$invitation->name}}</div>
  <div class="col">Guest: {{$user->name}}</div>
  <div class="col">Host: {{$invitation->host->name}}</div>
</div>

<table class="table table-sm table-hover table-striped">
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


<form method="POST" action="{{route('itinerary.store',[$user, $invitation])}}">
  @csrf
  <div class="row justify-content-center mb-3">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header text-success text-center bg-nav text-muted h4">{{ __('Guest Arrival') }}</div>

        <div class="card-body">
          <div class="row">
            <label for="pickup" class="col-sm-3 text-sm-center bg-info" style="border-radius: 25%">{{ __('Pickup Facility') }}</label>

            <div class="col-sm-9">
              <input id="pickup" type="checkbox" name="pickup" value="{{ old('pickup') }}" autocomplete="pickup" autofocus>
            </div>
          </div>

          <div class="row">
            <label for="date" class="col-sm-2 col-form-label text-md-right">{{ __('Arrival Date') }}</label>

            <div class="col-sm-4">
              <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus>

              @error('date')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="arr_time" class="col-sm-2 col-form-label text-md-right">{{ __('Arrival Time') }}</label>

            <div class="col-sm-4">
              <input id="arr_time" type="time" class="form-control @error('arr_time') is-invalid @enderror" name="arr_time" value="{{ old('arr_time') }}" required autocomplete="arr_time" autofocus>

              @error('arr_time')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="row">

            <label for="arr_travelMode" class="col-sm-2 col-form-label text-md-right">{{ __('Mode of Travel') }}</label>

            <div class="col-sm-4">
              <input id="arr_travelMode" type="text" class="form-control @error('arr_travelMode') is-invalid @enderror" name="arr_travelMode" value="{{ old('arr_travelMode') }}" required autocomplete="arr_travelMode" autofocus>

              @error('arr_travelMode')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="location" class="col-sm-2 col-form-label text-md-right">{{ __('Arrival Location') }}</label>

            <div class="col-sm-4">
              <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" autofocus>

              @error('location')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="row">

            <label for="arr_familyMembers'" class="col-sm-2 col-form-label text-md-right">{{ __('Family Member') }}</label>

            <div class="col-sm-4">
              <input id="arr_familyMembers" type="text" class="form-control @error('arr_familyMembers') is-invalid @enderror" name="arr_familyMembers" value="{{ old('arr_familyMembers') }}" required autocomplete="arr_familyMembers" title="No. of Family Members Attending" autofocus>

              @error('arr_familyMembers')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- .col-sm-6 ends -->
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header text-success text-center bg-nav text-muted h4">{{ __('Guest Departure') }}</div>

        <div class="card-body">
          <div class="row">
            <label for="dropdown" class="col-sm-3 text-sm-center bg-success" style="border-radius: 25%">{{ __('Drop Facility') }}</label>

            <div class="col-sm-9">
              <input id="dropdown" type="checkbox" name="dropdown" value="{{ old('dropdown') }}" autocomplete="dropdown" autofocus>
            </div>
          </div>

          <div class="row">
            <label for="date" class="col-sm-2 col-form-label text-md-right">{{ __('Depature Date') }}</label>

            <div class="col-sm-4">
              <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus>

              @error('date')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="dep_time" class="col-sm-2 col-form-label text-md-right">{{ __('Departure Time') }}</label>

            <div class="col-sm-4">
              <input id="dep_time" type="time" class="form-control @error('dep_time') is-invalid @enderror" name="dep_time" value="{{ old('dep_time') }}" required autocomplete="dep_time" autofocus>

              @error('dep_time')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="row">

            <label for="dep_travelMode" class="col-sm-2 col-form-label text-md-right">{{ __('Mode of Travel') }}</label>

            <div class="col-sm-4">
              <input id="dep_travelMode" type="text" class="form-control @error('dep_travelMode') is-invalid @enderror" name="dep_travelMode" value="{{ old('dep_travelMode') }}" required autocomplete="dep_travelMode" autofocus>

              @error('dep_travelMode')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <label for="location" class="col-sm-2 col-form-label text-md-right">{{ __('Departure Location') }}</label>

            <div class="col-sm-4">
              <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" autofocus>

              @error('location')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="row">

            <label for="dep_familyMembers" class="col-sm-2 col-form-label text-md-right">{{ __('Family Member') }}</label>

            <div class="col-sm-4">
              <input id="dep_familyMembers" type="text" class="form-control @error('dep_familyMembers') is-invalid @enderror" name="dep_familyMembers" value="{{ old('dep_familyMembers') }}" required autocomplete="dep_familyMembers" autofocus>

              @error('dep_familyMembers')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- .col-sm-6 ends -->
    <div class="row m-4 p-3">
      <div class="col-sm-6 col-offset-sm-4">
        <button type="submit" class="btn btn-primary">
          {{ __('Submit') }}
        </button>
      </div>
    </div>
    <!-- form submit ends -->
  </div>
</form>


@endsection
