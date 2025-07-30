  <div class="form-group">
      <label for="name" class="form-label">{{ __('Name') }}</label>
      <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') ?? $ceramony->name ?? '' }}" autocomplete="name" autofocus>
      @error('name')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
  </div>
  <div class="form-group">
      <!-- <label for="type" class="form-label">{{ __('Type') }}</label>
      <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') ?? ''}}" autocomplete="type">
      @error('type')
      <span class="invalid-feedback" role="alert">
          <strong>{{$message}}
      </span>
      @enderror
  </div> -->
      <div class="form-group">
          <label for="parent_id" class="form-label">{{ __('Category') }}</label>
          <select name="parent_id" id="parent_id" class="form-control" size="7">
              <option value="select" disabled>Create Ceramony</option>
              <option value="NULL">Select New Ceramony</option>
              @foreach ($ceracats as $key => $val)
              <option value="{{$val}}" {{$ceramony->parent_id == $val ? 'selected' : ''}}>{{$key}}</option>
              @endforeach
          </select>
          @error('parent_id')
          <span class="invalid-feedback" role="alert">
              <strong>{{$message}}
          </span>
          @enderror
      </div>
      <div class="form-group">
          <label for="priority" class="form-label">{{ __('Priority') }}</label>
          <select name="priority" id="priority" class="form-control">
              <option value="select" disabled>Select Priority</option>
              <option value="0" selected>No Priority</option>
              <option value="1" {{$ceramony->priority == 1 ? 'selected' : ''}}>One</option>
              <option value="2" {{$ceramony->priority == 2 ? 'selected' : ''}}>Two</option>
              <option value="3" {{$ceramony->priority == 3 ? 'selected' : ''}}>Three</option>
              <option value="4" {{$ceramony->priority == 4 ? 'selected' : ''}}>Four</option>
              <option value="5" {{$ceramony->priority == 5 ? 'selected' : ''}}>Five</option>
              <option value="6" {{$ceramony->priority == 6 ? 'selected' : ''}}>Six</option>
              <option value="7" {{$ceramony->priority == 7 ? 'selected' : ''}}>Seven</option>
              <option value="8" {{$ceramony->priority == 8 ? 'selected' : ''}}>Eight</option>
              <option value="9" {{$ceramony->priority == 9 ? 'selected' : ''}}>Nine</option>
          </select>
          @error('priority')
          <span class="invalid-feedback" role="alert">
              <strong>{{$message}}
          </span>
          @enderror
      </div>

      <div class="form-group">
          <label for="icon" class="form-label">{{ __('Icon') }}</label>
          <input type="text" name="icon" id="icon" class="form-control  @error('icon') is-invalid @enderror" value="{{ old('icon') ?? $ceramony->icon ?? '' }}" autocomplete="icon">
          @error('icon')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
      </div>
      <div class="form-group">
          <label for="status" class="form-label">{{__('Status')}}</label>
          <input type="hidden" name="status" id="status" class="form-checkbox" checked value="off">
          <input type="checkbox" name="status" id="status" class="form-checkbox" checked value="on">
      </div>

      <div class="user-image mb-3 text-center">
          <div class="imgPreview"> </div>
      </div>
      <div class="custom-file">
          <input type="file" name="imageOne[]" class="custom-file-input" id="images" multiple="multiple">
          <label class="custom-file-label" for="images">Choose image</label>
      </div>
      {{-- <!-- <div class="form-group">
      <div class="upload-cover">
          <label class="btn btn-upload btn-red" for="imageOne">{{__(' Upload Photo ')}}<i class="fa fa-upload" aria-hidden="true"></i></label>
      <input type="file" hidden name="imageOne[]" id="imageOne" class="form-control-file @error('imageOne') is-invalid @enderror" accept="image/*" value="{{ old('imageOne')  ?? $ceramony->imageOne  ??'' }}" autocomplete="imageOne" aria-label="imageOne" aria-describedby="imageOne" multiple>
      @error('imageOne')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
      @if($ceramony->imageOne == null)
      <img src="{{asset('assets/ceramonies\/').'ceramonyDefault.png'}}" alt="ceramonyImage" id="imageOneTag" width="48px" height="auto">
      @else
      <img src="{{asset('assets/ceramonies\/').$ceramony->imageOne}}" alt="CeramonyImage" style="border-radius:20%" id="imageOneTag" width="48px" height="auto">
      @endif
  </div>
  </div> --> --}}
  <div class="form-group">
      <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
  </div>