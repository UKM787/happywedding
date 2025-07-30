@extends('layouts.hostinvitation')


@section('styles')
@endsection

@section('content')


<invitation-ceremony-list :host="{{$host}}" :invitation="{{$invitation}}" :venues="{{$venues}}" :ceramonies="{{$ceramonies}}" :ceramonylist="{{json_encode($ceramonyName)}}" :hostvenues="{{$hostvenues}}"></invitation-ceremony-list>  

{{--

@include('host.partials.views._ceramony')

--}}


@endsection

@section('wed-ceramony-slider')
{{--<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('#wed-host-ceramoony', {
            type: "slide",
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
</script> -->--}}
@endsection
