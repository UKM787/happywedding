@extends('layouts.app')
@section('content')

<wear-style-makeup-filtered :cities ="{{$states}}" :subcat ="{{$subCat}}" :vendorcat ="{{$vendorCat}}" :type="{{$type}}" city="{{$city}}" :venues="{{$venues}}"></vendor-venue-all>

@endsection 