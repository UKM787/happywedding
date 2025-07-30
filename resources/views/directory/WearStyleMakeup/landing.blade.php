@extends('layouts.app')
@section('content')

<wear-style-makeup :states ="{{$states}}" :subcat ="{{$subCat}}" :vendorcat ="{{$vendorCat}}"></vendor-venue-all>

@endsection 