@extends('layouts.app')
@section('content')



{{--
<table style=" border-spacing: 5px;border:4px solid black">
@foreach($checkins as $key=>$value)
        <tr style="border:4px solid black">   
            @foreach($value as $iKey=>$iValue)       
                <td style="border:1px solid red"> {{$iKey}} </td>
@endforeach
</tr>
@break
@endforeach
@foreach($checkins as $key=>$value)
<tr style="border:4px solid black">
    @foreach($value as $iKey=>$iValue)
    <td style="border:1px solid red"> {{$iValue}} </td>

    @endforeach
</tr>
@endforeach
</table>
{{dd('aa')}}
--}}


<landing-page :testimonials="{{$testimonials}}"></landing-page>


@endsection