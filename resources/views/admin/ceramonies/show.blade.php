@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminceramony.index')}}" class="btn wed-btn-main">back</a></p>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Ceramony</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('adminceramony.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $ceramony->name }}
        </div>
    </div>
    <!-- <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Category:</strong>
            {{ $ceramony->state }}
        </div>
    </div> -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
             @foreach($ceramony->imageOne as $ceraimg)
                        <img src="{{App\Wed\Happy::CERIMGPATH. $ceraimg}}" alt="{{$ceraimg.'Image'}}" width="100" height="100px" class="px-1">
                        @endforeach
        </div>
    </div>
</div>
@endsection