@extends('layouts.hostinvitation')

@section('content')

<div class="ecard-main-container wed_story_container">
    <h1 class="text-preview">Preview</h1>
    <div class="ecard-buttons">
        <button class="button-ecard-1"><a href="#" class="btn-left-ecard">Upload</a></button>
        <button type="button" class="btn-right-ecard">Submit</button>
    </div>
    <div class="e_card_container" style="background: url('/img/ecard_background.png'); background-repeat: no-repeat; background-size: cover; background-position: center; width: 90%; height: 100%; position: relative; left: 50%; top: 50%; transform: translate(-50%, -50%);">

        <div class="center-para-ecard">
            <h2 class="ecard-heading">{{$invitation->brideName}} & {{$invitation->groomName}}</h2>
            <h3 class="ecard-text"> {{\Carbon\Carbon::parse($invitation->startDate)->format('j F, Y')}} <br><span> @foreach($invitation->venues as $venue)
                    <div>
                        {{ucwords($venue->name)}}

                    </div>
                    <div>
                        {{ucwords($venue->city)}}
                    </div>
                    @endforeach</span></h3>
            <h1 class="ecard-ceremonies">CEREMONIES</h1>
            <img class="ecard-design" src="{{url('/img/ecardImage2.png')}}" />
        </div>
    </div>
</div>

@endsection
