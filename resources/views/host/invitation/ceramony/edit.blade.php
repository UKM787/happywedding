@extends('layouts.hostinvitation')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="box-wrap admin-form">
            <span class="h3">{{ ucwords($ceramony->name) }}<sup style="font-size: 0.6em; color:white; background-color:red; border-radius:1em; padding: 0.2em">{{$ceramony->type}}</sup></span>

            <form method="POST" action="{{route('hostceramony.update',[$invitation,$ceramony])}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('host.partials._ceramony', ['submitBtn' => 'update', 'wedform' => '','ceramonyName' => $ceramony->name, 'val' => $val])
            </form>

        </div>
    </div>
</div>
@endsection
