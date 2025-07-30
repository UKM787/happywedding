<div class="row">
    <div class="col-md-6 offset-md-2">
        {!! Form::label('title', 'Title: ') !!}
        {!! Form::text('title', $article->title ? $article->title : ('title' ? old('title') : ''),['class' => 'form-control', 'placeholder' => 'Article Title', 'autofocus'] )!!}
        @error('title')
        <span class="alert-danger form-control">
            {{$errors->first('title')}} </span>
        @enderror
    </div>
    @if(auth()->guard('admin')->user() != null && auth()->guard('admin')->user()->role == 'admin')
    <div class="col-md-2 offset-md-1">
        {!! Form::label('status', 'Published: ') !!}
        <input type="hidden" name="status" id="status" class="form-checkbox" checked value="0">
        <input type="checkbox" name="status" id="status" class="form-checkbox" value="1" {{$article->status == 1 ? 'checked' : ''}}>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-8 offset-md-2 mt-2">
        {!! Form::label('body', 'Description: ') !!}
        {!! Form::textarea('body',$article->body ? $article->body : ('body' ? old('body') : ''),['class' => 'form-control', 'placeholder' => 'Article Description'])!!}
        @error('body')
        <span class="alert-danger form-control">{{$errors->first('body')}} </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-4 offset-md-2 mt-2">
        {!! Form::label('published_at', 'Published On: ') !!}
        {!! Form::date('published_at', \Carbon\Carbon::now(),['class' => 'form-control'])!!}
    </div>

    <div class="col-md-4 offset-md-1 mt-2">
        {!! Form::label('priority', 'Listing Priority: ') !!}
        {{ Form::select('priority', [0,1,2,3,4,5,6,7,8,9] , $article->priority, ['class' => 'form-control','placeholder' => 'Listing Priority..']) }}
        @error('priority')
        <span class="alert-danger form-control">{{$errors->first('priority')}} </span>
        @enderror
    </div>
</div>

<div class="row">

    <div class="col-md-4 offset-md-2 mt-2">
        {!! Form::label('tag_list', 'Tags: ') !!}
        {{ Form::select('tag_list[]', $tags ,  $article->tags->pluck('id')->toArray(), ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) }}
        @error('tag_list')
        <span class="alert-danger form-control">
            {{$errors->first('tag_list')}} </span>
        @enderror
    </div>

    <div class="col-md-4 offset-md-1 mt-2">
        {!! Form::label('category_id', 'Category: ') !!}
        {{ Form::select('category_id', $cats ,  $article->category_id, ['id' => 'category_id', 'class' => 'form-control']) }}
        @error('category_id')
        <span class="alert-danger form-control">
            {{$errors->first('category_id')}} </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-4 offset-md-2 mt-4 text-center">
        @if($article->imageOne)
        <img src="{{App\Wed\Happy::ARTIMGPATH.$article->imageOne}}" alt="" width="100px" id="imageOneTag" height="100px">
        @else
        <img src="{{App\Wed\Happy::ARTIMGPATH.'articleDefault.png'}}" alt="" width="100px" height="100px" id="imageOneTag">
        @endif
        <hr>
        {!! Form::label('imageOne', 'Cover Image: ') !!}
        {!! Form::file('imageOne')!!}
        @error('imageOne')
        <span class="invalid-feedback" role="alert">
            <strong> {{$errors->first('imageOne')}}</strong>
        </span>
        @enderror
    </div>


    <div class="col-md-4 offset-md-1 mt-5">
        <div class="user-image mb-3 text-center">
            <div class="imgPreview"> </div>
        </div>
        <div class="custom-file">
            <input type="file" name="imageGallery[]" class="custom-file-input" id="images" multiple="multiple">
            <label class="custom-file-label" for="images">Upload ImageGallery</label>
        </div>
    </div>
</div>

<div class="row text-center">
    <div class="col-md-8 offset-md-2 mt-3">
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