<div class="row invitation-form  mb-3">

    @foreach($arrivals as $arrival)
    <div class="col-sm-6">
       @include('guest.invitation.logistics.partials._arrival', ['arrival' => $arrival])
    </div>
    @endforeach
    <!-- .col-sm-6 ends -->
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header text-success text-center bg-nav text-muted h4">{{ __('Guest Departure') }}</div>

            <div class="card-body">
                <div class="row">
                    <label for="departureDate" class="col-sm-2 col-form-label text-sm-left text-muted">{{ __('Date') }}</label>

                    <div class="col-sm-4">
                        <input id="departureDate" type="date" class="form-control @error('departureDate') is-invalid @enderror" name="departureDate" value="{{ old('departureDate') }}" autocomplete="departureDate">

                        @error('departureDate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <label for="departureTime" class="col-sm-2 col-form-label text-sm-left text-muted">{{ __('Time') }}</label>

                    <div class="col-sm-4">
                        <input id="departureTime" type="time" class="form-control @error('departureTime') is-invalid @enderror" name="departureTime" value="{{ old('departureTime') }}" autocomplete="departureTime">

                        @error('departureTime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row my-2">

                    <label for="modeOfTravel" class="col-sm-2 col-form-label text-sm-left text-muted">{{ __('modeOfTravel') }}</label>

                    <div class="col-sm-4">
                        <input id="modeOfTravel" type="text" class="form-control @error('modeOfTravel') is-invalid @enderror" name="modeOfTravel" value="{{ old('modeOfTravel') }}" autocomplete="modeOfTravel">

                        @error('modeOfTravel')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <label for="location" class="col-sm-2 col-form-label text-sm-left text-muted">{{ __('Location') }}</label>

                    <div class="col-sm-4">
                        <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" autocomplete="location">

                        @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row">

                    <label for="noOfMembers" class="col-sm-2 col-form-label text-sm-left text-muted">{{ __('Family Member') }}</label>

                    <div class="col-sm-4">
                        <input id="noOfMembers" type="text" class="form-control @error('noOfMembers') is-invalid @enderror" name="noOfMembers" value="{{ old('noOfMembers') }}" autocomplete="noOfMembers">

                        @error('noOfMembers')
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
            <button type="submit" class="btn btn-sm wed-btn-main">
                <span class="material-icons">
                    save
                </span>
            </button>
        </div>
    </div>
    <!-- form submit ends -->
</div>
