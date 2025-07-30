@extends('layouts.host')

@section('content')
<h1>Edit members form here</h1>
<form method="POST" action="#" enctype="multipart/form-data">

    @include('host.partials._member', ['submitBtn' => 'Create'])

</form>
@endsection
