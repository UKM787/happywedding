<div class="row">
    <div class="col-md-9 offset-md-1">
        {!! Form::label('title', 'Name: ') !!}
        {!! Form::text('name', $tag->name ? $tag->name : ('name' ? old('name') : ''),['class' => 'form-control', 'placeholder' => 'tag Name', 'autofocus'] )!!}
        @error('name')
        <span class="alert-danger form-control">
            {{$errors->first('name')}} </span>
        @enderror
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4 offset-md-1"> <label for="priority" class="form-label">{{ __('Priority') }}</label>
        <select name="priority" id="priority" class="form-control">
            <option value="select" disabled>Select Priority</option>
            <option value="0" selected>No Priority</option>
            <option value="1" {{$tag->priority == 1 ? 'selected' : ''}}>One</option>
            <option value="2" {{$tag->priority == 2 ? 'selected' : ''}}>Two</option>
            <option value="3" {{$tag->priority == 3 ? 'selected' : ''}}>Three</option>
            <option value="4" {{$tag->priority == 4 ? 'selected' : ''}}>Four</option>
            <option value="5" {{$tag->priority == 5 ? 'selected' : ''}}>Five</option>
            <option value="6" {{$tag->priority == 6 ? 'selected' : ''}}>Six</option>
            <option value="7" {{$tag->priority == 7 ? 'selected' : ''}}>Seven</option>
            <option value="8" {{$tag->priority == 8 ? 'selected' : ''}}>Eight</option>
            <option value="9" {{$tag->priority == 9 ? 'selected' : ''}}>Nine</option>
        </select>
        @error('priority')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}
        </span>
        @enderror
    </div>
    <div class="col-md-4 offset-md-1"> <label for="icon" class="form-label">{{ __('Icon') }}</label>
        <input type="text" name="icon" id="icon" class="form-control  @error('icon') is-invalid @enderror" value="{{ old('icon') ?? $tag->icon ?? '<i class="material-icons">place</i>' }}" autocomplete="icon">
        @error('icon')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="row g-3 mt-2">
    <div class="col-md-4 offset-md-1">
        <div class=" form-check">
            <label for="status" class="form-label">{{__('Publish')}}</label>
            <input type="radio" id="option1" name="status" value="0" {{ ($tag->status == null ) ? "checked" : "" }}>No
            <input type="radio" id="option2" name="status" value="1" {{ ( $tag->status =="1" ) ? "checked" : "" }}>Yes
        </div>
    </div>
    <div class="col-md-4 offset-md-1 text-center">
        @if($tag->imageOne == null)
        <img src="{{App\Wed\Happy::TAGIMGPATH.'tagDefault.png'}}" alt="locationImage" id="imageOneTag" width="72px" height="auto">
        @else
        <img src="{{App\Wed\Happy::TAGIMGPATH.$tag->imageOne}}" alt="locationImage" style="border-radius:20%" id="imageOneTag" width="72px" height="auto">
        @endif
        <hr>
        <div class="upload-cover">
            <label class="btn btn-upload btn-red" for="imageOne">{{__(' Upload Photo ')}}<i class="fa fa-upload" aria-hidden="true"></i></label>
            <input type="file" hidden name="imageOne" id="imageOne" class="form-control-file @error('imageOne') is-invalid @enderror" accept="image/*" value="{{ old('imageOne')  ?? $tag->imageOne  ??'' }}" autocomplete="imageOne" aria-label="imageOne" aria-describedby="imageOne">
            @error('imageOne')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror


        </div>
    </div>
</div>

<div class="row">
    <div class="text-center mt-3">
        {!! Form::submit( $submitBtn , ['class' => 'btn-sm wed-btn-main']) !!}
    </div>
</div>

<!--
@section('newfooter')
// <script>
//    $('#tag_list').select2({
//       placeholder : 'pick your tag'
//    });
// </script>

@endsection -->