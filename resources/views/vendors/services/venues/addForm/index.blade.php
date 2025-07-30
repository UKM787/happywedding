	@extends('layouts.vendor')
	@section('content')

    <vendor-venue-register vendor-cat="{{ $vendorCat }}" vendor ="{{$vendor}}" subcat ="{{$subCat}}" :selected-sub-cat="{{$selectedSubCat}}" :services="{{$services}}"></vendor-venue-register>

    @endsection 