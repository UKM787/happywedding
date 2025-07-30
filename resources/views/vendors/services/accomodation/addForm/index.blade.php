	@extends('layouts.vendor')
	@section('content')

    <vendor-accomodation-register vendor-cat="{{ $vendorCat }}" vendor ="{{$vendor}}" subcat ="{{$subCat}}" :selected-sub-cat="{{$selectedSubCat}}" :services="{{$services}}"></vendor-accomodation-register>

    @endsection 