@extends('layouts.hostinvitation')

@section('content')
<form method="POST" action="{{route('hostinvitations.store', $host)}}" enctype="multipart/form-data">
  @csrf
  @include('host.partials._foodmenu', ['submitBtn' => 'Create', 'wedform' => 'disabled'])

</form>

@endsection