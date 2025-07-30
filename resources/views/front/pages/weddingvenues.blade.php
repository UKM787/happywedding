@extends('layouts.app')

@section('content')



<landing-wedding-venue :cities="{{$states}}" :subcat="{{$subCat}}"></landing-wedding-venue>



@endsection