  <div class="form-group">
      <label for="name" class="form-label">{{ __('Name') }}</label>
      <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') ?? $task->name ?? '' }}" autocomplete="name" autofocus>
      @error('name')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
  </div>
  <div class="form-group">
      <label for="description" class="form-label">{{ __('Description') }}</label>
      <textarea name="description" id="description" cols="60" rows="5" class="form-control @error('description') is-invalid @enderror" autocomplete="description">{{ old('description') ?? $task->description ?? ''}} </textarea>
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
          <option value="1">Critical</option>
          <option value="2">Low</option>
          <option value="3">Medium</option>
          <option value="4">High</option>
      </select>
      @error('priority')
      <span class="invalid-feedback" role="alert">
          <strong>{{$message}}
      </span>
      @enderror
  </div>

  <div class="form-group">
      <label for="priority" class="form-label">{{ __('Category') }}</label>
      <select name="parent_id" id="parent_id" class="form-control" size="7">
          <!-- <option value="select" disabled>Select for MasterCategory</option> -->
          <option value="NULL">New Category/SubCategory</option>
          @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ $cat->id === $task->id ? 'selected' : '' }} class="mx-3">{{ $cat->name }}</option>
          @if ($cat->children)
          @foreach ($cat->children as $child)
          <option value="{{ $child->id}}" {{ $child->id === $task->id ? 'selected' : '' }} class="mx-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}</option>
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
      <input type="text" name="icon" id="icon" class="form-control  @error('icon') is-invalid @enderror" value="{{ old('icon') ?? $task->icon ?? '<i class="material-icons">place</i>' }}" autocomplete="icon">
      @error('icon')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
  </div>
  <div class="form-check d-inline-block">
      <label for="status" class="form-label">{{__('Publish')}}</label>
      <input type="radio" id="option1" name="status" value="0" {{ ($task->status == "0" ) ? "checked" : "" }}>No
      <input type="radio" id="option2" name="status" value="1" {{ ( $task->status =="1" ) ? "checked" : "" }}>Yes
  </div>
  <div class="form-group">
      <div class="upload-cover">
          <label class="btn btn-upload btn-red" for="imageOne">{{__(' Upload Photo ')}}<i class="fa fa-upload" aria-hidden="true"></i></label>
          <input type="file" hidden name="imageOne" id="imageOne" class="form-control-file @error('imageOne') is-invalid @enderror" accept="image/*" value="{{ old('imageOne')  ?? $task->imageOne ?? '' }}" autocomplete="imageOne" aria-label="imageOne" aria-describedby="imageOne">
          @error('imageOne')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
          @if($task->imageOne == null)
          <img src="{{App\Wed\Happy::TASKIMGPATH.'taskDefault.png'}}" alt="taskImage" id="imageOneTag" width="48px" height="auto">
          @else
          <img src="{{App\Wed\Happy::TASKIMGPATH.$task->imageOne}}" alt="taskImage" style="border-radius:20%" id="imageOneTag" width="48px" height="auto">
          @endif
      </div>
  </div>
  <div class="form-group">
      <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
  </div>