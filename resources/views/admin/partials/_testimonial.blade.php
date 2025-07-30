<div class="row">
    <div class="col-md-7 offset-md-1">
        {!! Form::label('title', 'Title: ') !!}
        {!! Form::text('title', $testimonial->title ? $testimonial->title : ('title' ? old('title') : ''),['class' => 'form-control', 'placeholder' => 'Testimonial Title', 'autofocus'] )!!}
        @error('title')
        <span class="alert-danger form-control">
            {{$errors->first('title')}} </span>
        @enderror
    </div>
    @if(auth()->guard('admin')->user() != null && auth()->guard('admin')->user()->role == 'admin')
    <div class="col-md-2 offset-md-1">
        {!! Form::label('status', 'Published: ') !!}
        <input type="hidden" name="status" id="status" class="form-checkbox" checked value="0">
        <input type="checkbox" name="status" id="status" class="form-checkbox" value="1" {{$testimonial->status == 1 ? 'checked' : ''}}>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-9 offset-md-1 mt-2">
        {!! Form::label('body', 'Description: ') !!}
        {!! Form::textarea('body',$testimonial->body ? $testimonial->body : ('body' ? old('body') : ''),['class' => 'form-control', 'placeholder' => 'Testimonial Description'])!!}
        @error('body')
        <span class="alert-danger form-control">{{$errors->first('body')}} </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-2 offset-md-1 mt-2">
        {!! Form::label('published_at', 'Published On: ') !!}
        {!! Form::date('published_at', \Carbon\Carbon::now(),['class' => 'form-control'])!!}
    </div>

    <div class="col-md-2 offset-md-1 mt-2">
        {!! Form::label('priority', 'Listing Priority: ') !!}
        {{ Form::select('priority', [0,1,2,3,4,5,6,7,8,9] , $testimonial->priority, ['class' => 'form-control','placeholder' => 'Listing Priority..']) }}
        @error('priority')
        <span class="alert-danger form-control">{{$errors->first('priority')}} </span>
        @enderror
    </div>
    <div class="col-md-3 offset-md-1 mt-2">
        {!! Form::label('tag_list', 'Tags: ') !!}
        {{ Form::select('tag_list[]', $tags ,  $testimonial->tags->pluck('id')->toArray(), ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) }}
        @error('tag_list')
        <span class="alert-danger form-control">
            {{$errors->first('tag_list')}} </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-4 offset-md-3 mt-4 text-center">
        @if($testimonial->imageOne)
        <img src="{{App\Wed\Happy::TSTIMGPATH.$testimonial->imageOne}}" alt="" width="100px" height="100px" id="imageOneTag">
        @else
        <img src="{{App\Wed\Happy::TSTIMGPATH.'testimonialDefault.png'}}" alt="" width="100px" height="100px" id="imageOneTag">
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
    <div class="col-md-3 offset-md-1 mt-2 text-center">
        {{-- @if($testimonial->imageOne)
        <img src="{{asset('assets/testimonials\/'.$testimonial->imageOne)}}" alt="" width="100px" height="100px">
        @else
        <img src="{{asset('assets\testimonials'.'\testimonialDefault.png')}}" alt="" width="100px" height="100px">
        @endif --}}
    </div>
</div>
<div class="row">
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