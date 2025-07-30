@extends('layouts.guestinvitation')

@section('content')

@include('host.partials.views._ceramony')

@endsection

@section('wed-ceramony-slider')

{{--<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('.wed-host-ceramonies', {
            type: "loop",
            perPage: 1,
            perMove: 0,
            //focus:center,
            autoWidth: true,
            fixedHeight: '100',
            heightRatio: 0.3,
            autoHeight: true,
            pagination: false,
            rewind: true,
            arrows: true,
            trimSpace: true,
            rewind: true
        }).mount();
    });
</script>--}}

@endsection
