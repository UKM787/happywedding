@extends('layouts.admin')

@section('content')

</div class="d-flex justify-content-around text-center">
<div>
    <div class="form-group">
        <img src="{{App\Wed\Happy::LOCIMGPATH.$location->imageOne}}" width="100px" height="auto">
    </div>
    <div class="form-group">
        {{ $location->name }} | <strong>Longitude:</strong> {{ $location->longitude }} | <strong>Latitude:</strong> {{ $location->latitude }}
    </div>
    <div class="form-group">
        <strong>Priority:</strong>
        {{ $location->priority }} | <strong>Listed:</strong> {{ $location->status ? 'listed' : 'notlisted' }}
    </div>
</div>
<div>
    <a class="btn btn-primary" href="{{ route('adminlocation.index') }}"> Back</a>
</div>
</div>

@endsection