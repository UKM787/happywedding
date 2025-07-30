@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminservice.index')}}" class="btn wed-btn-main">back</a></p>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Service</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Service:</strong>
            {{ $service->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Vendor Cate:</strong>
            {{ $service->description }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <img src="{{ App\Wed\Happy::SERIMGPATH.$service->imageOne }}" width="300px" height="auto">
        </div>
    </div>
</div>
@endsection