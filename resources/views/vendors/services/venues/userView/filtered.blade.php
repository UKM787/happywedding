	@extends('layouts.app')
	@section('content')

    <landing-wedding-venue-filtered :cities="{{$states}}" city = "{{$city}}" type = "{{$type}}" :venues = "{{$venues}}"></landing-wedding-venue-filtered>

    
{{--<vendor-venue-filtered venues = "{{$venues}}" city = "{{$city}}" type = "{{$type}}" states= "{{$states}}" stateselected= "{{$stateSelected}}" subcat ="{{$subCat}}"></vendor-venue-filtered>--}}

    @endsection 