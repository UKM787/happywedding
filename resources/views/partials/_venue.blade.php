<!-- hostprofile -->
<div class="row">

    <div class="col-md-12">
        <label class="form-label" id="name">{{ __('Venue Name*') }}</label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="enter venue name" value="{{ old('name') ?? $venue->name ?? '' }}" aria-label="name" aria-describedby="name" autocomplete="name">

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label class="form-label" id="description">{{ __('Venue Description*')}}</label>
        <textarea name="description" type="text" class="form-control @error('description') is-invalid @enderror" placeholder="enter detailed venueInformation" aria-label="description" aria-describedby="description" autocomplete="description">{{ old('description') ?? $venue->description ?? ''}}</textarea>
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label class="form-label" id="address">{{ __('Address*')}}</label>
        <textarea name="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="enter venueAddress" aria-label="address" aria-describedby="address" autocomplete="address">{{ old('address') ?? $venue->address ?? ''}}</textarea>
        @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<!-- Contact Information -->
<div class="row">
    <div class="col-md-6">
        <label class="form-label" id="landline">{{ __('Landline Number') }}</label>
        <input name="landline" type="text" class="form-control @error('landline') is-invalid @enderror" placeholder="enter landline number" value="{{ old('landline') ?? $venue->landline ?? '' }}" aria-label="landline" aria-describedby="landline" autocomplete="landline">
        @error('landline')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" id="number_2">{{ __('Mobile Number') }}</label>
        <input name="number_2" type="text" class="form-control @error('number_2') is-invalid @enderror" placeholder="enter mobile number" value="{{ old('number_2') ?? $venue->number_2 ?? '' }}" aria-label="number_2" aria-describedby="number_2" autocomplete="number_2">
        @error('number_2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label class="form-label" id="email">{{ __('Email Address') }}</label>
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="enter email address" value="{{ old('email') ?? $venue->email ?? '' }}" aria-label="email" aria-describedby="email" autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" id="watsapp">{{ __('WhatsApp Number') }}</label>
        <input name="watsapp" type="text" class="form-control @error('watsapp') is-invalid @enderror" placeholder="enter whatsapp number" value="{{ old('watsapp') ?? $venue->watsapp ?? '' }}" aria-label="watsapp" aria-describedby="watsapp" autocomplete="watsapp">
        @error('watsapp')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="row">
    {{--
    @if($categories->isNotEmpty())
    <div class="col">
        <label for="category_id" class="form-label">{{ __('Category') }}</label>
        <select name="category_id" id="category_id" class="form-control" size="5">
            @foreach ($categories as $key => $val)
            <option value="{{$val}}" @if (isset($venue)) {{$val == $venue->category_id ? 'selected' : '' }} @endif>{{$key}}</option>
            @endforeach
        </select>
        @error('category_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}
        </span>
        @enderror
    </div>
    @endif --}}
   {{-- <div class="col">
        <label for="location_id" class="form-label">{{ __('Location') }}</label>
        <select name="location_id" id="location_id" class="form-control" size="5">
            @foreach ($locations as $key => $val)
            <option value="{{$val}}" @if (isset($venue)) {{$val == $venue->location_id ? 'selected' : '' }} @endif>{{$key}}</option>
            @endforeach
        </select>
        @error('location_id')
        <span class=" invalid-feedback" role="alert">
            <strong>{{$message}}
        </span>
        @enderror
    </div> --}}
    {{--
    @if(! isset($host))
    @if(! isset($vendor))
    <div class="col">
        <label for="priority" class="form-label">{{ __('Priority') }}</label>
        <select name="priority" id="priority" class="form-control" size="5">
            <option value="0" disabled>Select Priority</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
            <option value="4">Four</option>
            <option value="5">Five</option>
            <option value="6">Six</option>
            <option value="7">Seven</option>
            <option value="8">Eight</option>
            <option value="9">Nine</option>
        </select>
        @error('priority')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}
        </span>
        @enderror
    </div>
    @endif
    --}}
</div>
<div class="row mt-2">
    <div class="col">
        <label for="state_id" class="col-form">{{ __('State') }}</label>
        <select required name="state_id" id="state_id" class="form-control @error('state_id') is-invalid @enderror">
            <option value="" selected>Select your state</option>
        </select>
        @error('state_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col">
        <label for="locationmaster_id" class="col-form">{{ __('City') }}</label>
        <select required name="locationmaster_id" id="locationmaster_id" class="form-control @error('locationmaster_id') is-invalid @enderror" data-old="{{old('locationmaster_id')}}">
            <option value="" selected>Select your State First</option>
        </select>
        @error('locationmaster_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stateSelect = document.getElementById('state_id');
    const citySelect = document.getElementById('locationmaster_id');
    const oldLocationId = citySelect.getAttribute('data-old');

    // Store existing venue data for edit mode
    const existingStateId = '{{ old("state_id") ?? $venue->state_id ?? "" }}';
    const existingLocationId = '{{ old("locationmaster_id") ?? $venue->locationmaster_id ?? "" }}';
    const existingStateName = '{{ old("state") ?? $venue->state ?? "" }}';
    const existingCityName = '{{ old("city") ?? $venue->city ?? "" }}';

    // Load states on page load
    loadStates();

    // Handle state change
    stateSelect.addEventListener('change', function() {
        const selectedStateId = this.value;
        if (selectedStateId) {
            loadCities(selectedStateId);
        } else {
            citySelect.innerHTML = '<option value="" selected>Select your State First</option>';
        }
    });

    function loadStates() {
        fetch('/api/states')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    stateSelect.innerHTML = '<option value="">Select your state</option>';
                    data.data.forEach(state => {
                        const option = document.createElement('option');
                        option.value = state.id;
                        option.textContent = state.name;
                        // Match by ID first, then by name if ID is not available
                        if (state.id == existingStateId || (existingStateId === '' && state.name === existingStateName)) {
                            option.selected = true;
                        }
                        stateSelect.appendChild(option);
                    });

                    // If we have an existing state, load its cities
                    if (existingStateId) {
                        loadCities(existingStateId);
                    } else if (existingStateName) {
                        // Find state ID by name and load cities
                        const stateOption = Array.from(stateSelect.options).find(option => option.textContent === existingStateName);
                        if (stateOption) {
                            loadCities(stateOption.value);
                        }
                    }
                } else {
                    console.error('Error loading states:', data.message);
                }
            })
            .catch(error => {
                console.error('Error fetching states:', error);
            });
    }

    function loadCities(stateId) {
        citySelect.innerHTML = '<option value="">Loading cities...</option>';

        fetch(`/api/cities/${stateId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    citySelect.innerHTML = '<option value="">Select your city</option>';
                    data.data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        // Match by ID first, then by name if ID is not available
                        if (city.id == existingLocationId || city.id == oldLocationId ||
                            (existingLocationId === '' && city.name === existingCityName)) {
                            option.selected = true;
                        }
                        citySelect.appendChild(option);
                    });
                } else {
                    console.error('Error loading cities:', data.message);
                    citySelect.innerHTML = '<option value="">Error loading cities</option>';
                }
            })
            .catch(error => {
                console.error('Error fetching cities:', error);
                citySelect.innerHTML = '<option value="">Error loading cities</option>';
            });
    }
});
</script>
{{--
<div class="row">

    <div class="col-md-4">
        <label class="form-label" id="longitude">{{ __('Longitude') }}</label>
        <input name="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" placeholder="enter longtitude" value="{{ old('longitude') ?? $venue->longitude ?? ''}}" aria-label="longitude" aria-describedby="longitude" autocomplete="longitude">
        @error('longitude')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label" id="latitude">{{ __('Latitude*')}}</label>
        <input name="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" placeholder="enter latitude" value="{{ old('latitude') ?? $venue->latitude ?? ''}}" aria-label="latitude" aria-describedby="latitude" autocomplete="latitude">
        @error('latitude')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-4">
        <Label class="form-label" id="map">{{ __('Map')}}</Label>
        <input name="map" type="text" class="form-control @error('map') is-invalid @enderror" placeholder="map" value="{{ old('map') ?? $venue->map ?? ''}}" aria-label="map" aria-describedby="map" autocomplete="map">
        @error('map')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@if(! isset($vendor))
<div class="row">
    <div class="col-md-4">
        <label for="icon" class="form-label">{{ __('Icon') }}</label>
        <input type="text" name="icon" id="icon" class="form-control  @error('icon') is-invalid @enderror" value="{{ old('icon') ?? $venue->icon ?? '' }}" autocomplete="icon">
        @error('icon')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    <div class="col-md-2">
        <label for="status" class="form-label">{{__('Publish')}}</label>
        <input type="checkbox" name="status" id="status" class="form-checkbox" checked>
    </div>
</div>
@endif


<!-- guestphoto optional -->
<div class="row mt-3">
    <div class="col-md-2">
        <div class="upload-cover">
            <label class="btn btn-upload btn-red">{{ __('Photo') }}<i class="fa fa-upload" aria-hidden="true"></i>
                <input hidden type="file" name="imageOne" class="@error('imageOne') is-invalid @enderror mb-4" accept="image/*" value="{{$venue->imageOne ?? asset('storage\defaultsv1').'\avatar.png' ??  '' }}" autocomplete="imageOne" aria-label="imageOne"></label>
            @error('imageOne')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @if(isset($venue->imageOne) )
            <img src="{{asset('assets/venues\/').$venue->imageOne}}" alt="profilePhoto" id="imageOneTag" width="125px" height="auto">

            @else
            <img src="{{asset('assets/venues\/').'/venueDefault.png'}}" alt="profilePhoto" id="imageOneTag" width="125px" height="auto">
            @endif


        </div>
    </div>
</div>

@endif
--}}
<div class="row mt-3 text-center">
    <div class="col-2">
        <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
    </div>
</div>

