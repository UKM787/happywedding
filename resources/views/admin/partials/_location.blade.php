<div class="row g-3">
    <div class="col"> <label for="name" class="form-label">{{ __('Country / State / City') }}</label>
        <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') ?? $location->name ?? '' }}" autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col">
        <label for="parent_id" class="form-label">{{ __('Count / State') }}</label>
        <select name="parent_id" id="parent_id" class="form-control">
            <option value="" disabled>Select Country/State</option>
            <option value="NULL">newCountry</option>
            @foreach ($locations as $item)
            <option value="{{ $item->id }}" {{ ($item->id === $location->parent_id ) ? 'selected' : '' }}> {{$item->name}}</option>
            @endforeach
        </select>
        @error('parent_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}
        </span>
        @enderror
    </div>
</div>

<div class="row g-3">
    <div class="col">
        <label for="longitude" class="form-label">{{ __('Longitude') }}</label>
        <input type="text" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude') ?? $location->longitude ?? ''}}" autocomplete="longitude">
        @error('longitude')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}
        </span>
        @enderror
    </div>
    <div class="col">
        <label for="latitude" class="form-label">{{ __('Latitude') }}</label>
        <input type="text" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude') ?? $location->latitude ?? ''}}" autocomplete="latitude">
        @error('latitude')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}
        </span>
        @enderror
    </div>
</div>
<div class="row g-3">
    <div class="col"> <label for="priority" class="form-label">{{ __('Priority') }}</label>
        <select name="priority" id="priority" class="form-control">
            <option value="select" disabled>Select Priority</option>
            <option value="0" selected>No Priority</option>
            <option value="1" {{$location->priority == 1 ? 'selected' : ''}}>One</option>
            <option value="2" {{$location->priority == 2 ? 'selected' : ''}}>Two</option>
            <option value="3" {{$location->priority == 3 ? 'selected' : ''}}>Three</option>
            <option value="4" {{$location->priority == 4 ? 'selected' : ''}}>Four</option>
            <option value="5" {{$location->priority == 5 ? 'selected' : ''}}>Five</option>
            <option value="6" {{$location->priority == 6 ? 'selected' : ''}}>Six</option>
            <option value="7" {{$location->priority == 7 ? 'selected' : ''}}>Seven</option>
            <option value="8" {{$location->priority == 8 ? 'selected' : ''}}>Eight</option>
            <option value="9" {{$location->priority == 9 ? 'selected' : ''}}>Nine</option>
        </select>
        @error('priority')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}
        </span>
        @enderror
    </div>
    <div class="col"> <label for="icon" class="form-label">{{ __('Icon') }}</label>
        <input type="text" name="icon" id="icon" class="form-control  @error('icon') is-invalid @enderror" value="{{ old('icon') ?? $location->icon ?? '<i class="material-icons">place</i>' }}" autocomplete="icon">
        @error('icon')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="row g-3 mt-2">
    <div class="col">
        <div class="form-check">
            <label for="status" class="form-label">{{__('Publish')}}</label>
            <input type="radio" id="option1" name="status" value="0" {{ ($location->status == null ) ? "checked" : "" }}>No
            <input type="radio" id="option2" name="status" value="1" {{ ( $location->status =="1" ) ? "checked" : "" }}>Yes
        </div>
    </div>
    <div class="col text-center">
        @if($location->imageOne == null)
        @img(App\Wed\Happy::LOCIMGPATH.'locationDefault.png', 'locationImage', 'img-fluid', 72, 'auto', App\Wed\Happy::LOCIMGPATH.'locationDefault.png')
        @else
        @img(App\Wed\Happy::LOCIMGPATH.$location->imageOne, 'locationImage', 'img-fluid rounded-circle', 72, 'auto', App\Wed\Happy::LOCIMGPATH.'locationDefault.png')
        @endif
        <hr>
        <div class="upload-cover">
            <label class="btn btn-upload btn-red" for="imageOne">{{__(' Upload Photo ')}}<i class="fa fa-upload" aria-hidden="true"></i></label>
            <input type="file" hidden name="imageOne" id="imageOne" class="form-control-file @error('imageOne') is-invalid @enderror" accept="image/*" value="{{ old('imageOne')  ?? $location->imageOne  ??'' }}" autocomplete="imageOne" aria-label="imageOne" aria-describedby="imageOne">
            @error('imageOne')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>

<div class="g-3 text-center">
    <button state="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
</div>
