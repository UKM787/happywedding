
@extends('layouts.guestinvitation')

@section('content')

<guest-invitation-banner :guest="{{$user}}" :family="{{$family}}" :ceramonies="{{$ceramonies}}" :invi-status="{{$inviStatus}}" :accomodation-info="{{$accomodationInfo}}" :guest-accommodation-info="{{$guestAccommodationInfo ? $guestAccommodationInfo : 'null'}}" :arrival-details="{{$arrivalDetails ? $arrivalDetails : 'null'}}" :departure-details="{{$departureDetails ? $departureDetails : 'null'}}" :help-line="{{$helpLine ? $helpLine : 'null'}}" :story="{{$story ? $story : 'null'}}" :albums="{{$albums ? $albums : 'null'}}" :galleries="{{$galleries ? $galleries : 'null'}}" :videos="{{$videos ? $videos : 'null'}}"></guest-invitation-banner> 


@endsection
