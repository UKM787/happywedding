@extends('layouts.vendor')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            <a href="{{route('vendorprofile.edit', [$vendor, $vendor->profile])}}"> {{$vendor->name }} Offering following Services</a>

            <ul>

                @foreach($services as $wservice)

                <li class="text-primary" style="list-style-type:none;">
                    <a href="{{route('vendorwservices.index', [$vendor, $wservice])}}" style="text-decoration: none">{{Str::slug($wservice->name)}}</a>
                </li>

                @endforeach
            </ul>
        </div>

    </div>
</div>
@endsection
