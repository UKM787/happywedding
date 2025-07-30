  <div class="form-group">
      <label for="name" class="form-label">{{ __('Name') }}</label>
      <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') ?? $vendor->name ?? '' }}" autocomplete="name" autofocus>
      @error('name')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
  </div>
  <div class="form-group">
      <label for="description" class="form-label">{{ __('Description') }}</label>
      <textarea name="description" id="description" cols="60" rows="5" class="form-control @error('description') is-invalid @enderror" autocomplete="description">{{ old('description') ?? $vendor->description ?? '' }}</textarea>
      @error('description')
      <span class="invalid-feedback" role="alert">
          <strong>{{$message}}
      </span>
      @enderror
  </div>
  <div class="form-group">
      <label for="locationmaster_id" class="form-label">{{ __('City') }}</label>
      <select name="locationmaster_id" id="locationmaster_id" class="form-control">
          @foreach ($locations as $key => $val)
          <option value="{{$val}}" {{$val == $vendor->locationmaster_id ? 'selected; : '' }}</option>}}>{{$key}}</option>
          @endforeach
      </select>
      @error('locationmaster_id')
      <span class="invalid-feedback" role="alert">
          <strong>{{$message}}
      </span>
      @enderror
  </div>
  <div class="form-group">
      <label for="priority" class="form-label">{{ __('Priority') }}</label>
      <select name="priority" id="priority" class="form-control">
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
  <div class="form-group">
      <label for="parent_id" class="form-label">{{ __('Category') }}</label>
      <select name="parent_id" id="parent_id" class="form-control">
          <option value="" selected>Lease Empty Master Category</option>
          @foreach ($vendorcats as $key => $val)
          <option value="{{$val}}">{{$key}}</option>
          @endforeach
      </select>
      @error('parent_id')
      <span class="invalid-feedback" role="alert">
          <strong>{{$message}}
      </span>
      @enderror
  </div>
  <div class="form-group">
      <label for="status" class="form-label">{{__('Publish')}}</label>
      <input type="checkbox" name="status" id="status" class="form-checkbox" checked>
  </div>
  <div class="form-group">
      <label for="icon" class="form-label">{{ __('Icon') }}</label>
      <input type="text" name="icon" id="icon" class="form-control  @error('icon') is-invalid @enderror" value="{{ old('icon') ?? $vendor->icon ?? '' }}" autocomplete="icon">
      @error('icon')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
  </div>
  <div class="form-group">
      <div class="upload-cover">
          <label class="btn btn-upload btn-red" for="imageOne">{{__(' Upload Photo ')}}<i class="fa fa-upload" aria-hidden="true"></i></label>
          <input type="file" hidden name="imageOne" id="imageOne" class="form-control-file @error('imageOne') is-invalid @enderror" accept="image/*" value="{{ old('imageOne') ?? $vendor->imageOne ?? '' }}" autocomplete="imageOne" aria-label="imageOne" aria-describedby="imageOne">
          @error('imageOne')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
      </div>
      @if($vendor->imageOne == null)
      <img src="{{asset('img/cities\/').'cityDefault.png'}}" alt="VendorImage" id="imageOneTag" width="60px" height="auto">
      @else
      <img src="{{asset('img/cities\/').$vendor->imageOne}}" alt="VendorImage" id="imageOneTag" width="60px" height="auto">
      @endif
  </div>
  <div class="form-group">
      <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
  </div>
