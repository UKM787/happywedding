  <div class="form-group">
      <label for="name" class="form-label">{{ __('Name') }}</label>
      <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') ?? $category->name ?? '' }}" autocomplete="name" autofocus>
      @error('name')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
  </div>
  <div class="form-group">
      <label for="description" class="form-label">{{ __('Description') }}</label>
      <textarea name="description" id="description" cols="60" rows="5" class="form-control @error('description') is-invalid @enderror" autocomplete="description">{{ old('description') ?? $category->description ?? '' }}</textarea>
      @error('description')
      <span class="invalid-feedback" role="alert">
          <strong>{{$message}}
      </span>
      @enderror
  </div>
  <div class="form-group">
      <label for="priority" class="form-label">{{ __('Priority') }}</label>
      <select name="priority" id="priority" class="form-control">
          <option value="0" disabled>Select Priority</option>
          <option value="1" {{$category->priority == 1 ? 'selected' : ''}}>One</option>
          <option value="2" {{$category->priority == 2 ? 'selected' : ''}}>Two</option>
          <option value="3" {{$category->priority == 3 ? 'selected' : ''}}>Three</option>
          <option value="4" {{$category->priority == 4 ? 'selected' : ''}}>Four</option>
          <option value="5" {{$category->priority == 5 ? 'selected' : ''}}>Five</option>
          <option value="6" {{$category->priority == 6 ? 'selected' : ''}}>Six</option>
          <option value="7" {{$category->priority == 7 ? 'selected' : ''}}>Seven</option>
          <option value="8" {{$category->priority == 8 ? 'selected' : ''}}>Eight</option>
          <option value="9" {{$category->priority == 9 ? 'selected' : ''}}>Nine</option>
      </select>
      @error('priority')
      <span class="invalid-feedback" role="alert">
          <strong>{{$message}}
      </span>
      @enderror
  </div>

  <div class="form-group">
      <label for="parent_id" class="form-label">{{ __('Category') }}</label>
      <select name="parent_id" id="parent_id" class="form-select" size="7">
          <option value="select" disabled>Select Category/Subcategory</option>
          <option value="NULL">New Category/Subcategory>
              @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ $cat->id ===$category->id ? 'selected' : '' }} class="mx-3">{{ $cat->name }}</option>
          @if ($cat->children)
          @foreach ($cat->children as $child)
          <option value="{{$child->id}}" {{ $child->id === $category->id ? 'selected' : '' }} class="mx-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}</option>
          @endforeach
          @endif
          @endforeach
      </select>
      @error('parent_id')
      <span class="invalid-feedback" role="alert">
          <strong>{{$message}}
      </span>
      @enderror
  </div>
  <div class="form-group">
      <label for="icon" class="form-label">{{ __('Icon') }}</label>
      <input type="text" name="icon" id="icon" class="form-control  @error('icon') is-invalid @enderror" value="{{ old('icon') ?? $category->icon ?? '<i class="material-icons">place</i>' }}" autocomplete="icon">
      @error('icon')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
  </div>
  <div class="form-group">
      <label for="status" class="form-label">{{__('Publish')}}</label>
      <input type="radio" id="option1" name="status" value="0" {{ ($category->status == null ) ? "checked" : "" }}>No
      <input type="radio" id="option2" name="status" value="1" {{ ( $category->status =="1" ) ? "checked" : "" }}>Yes
  </div>
  <div class="form-group">
      <div class="upload-cover">
          <label class="btn btn-upload btn-red" for="imageOne">{{__(' Upload Photo ')}}<i class="fa fa-upload" aria-hidden="true"></i></label>
          <input type="file" hidden name="imageOne" id="imageOne" class="form-control-file @error('imageOne') is-invalid @enderror" accept="image/*" value="{{ old('imageOne') ?? $category->imageOne ?? '' }}" autocomplete="imageOne" aria-label="imageOne" aria-describedby="imageOne">
          @error('imageOne')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
      </div>
      @if($category->imageOne == null)
      <img src="{{App\Wed\Happy::CATIMGPATH.'categoryDefault.png'}}" alt="caregoryImage" id="imageOneTag" width="48px" height="auto">
      @else
      <img src="{{App\Wed\Happy::CATIMGPATH.$category->imageOne}}" alt="caregoryImage" style="border-radius:20%" id="imageOneTag" width="48px" height="auto">
      @endif
  </div>
  <div class="form-group">
      <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
  </div>