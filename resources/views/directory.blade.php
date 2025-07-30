@extends('layouts.app')

@section('content')


<vendor-landing testimonials = "{{$testimonials}}"></vendor-landing>
<!-- <div id="ven-cards-overlay" style="background: rgba(0, 0,0, 0.6); width: 100%;height: 100vh; position: fixed; top: 0%;"></div> -->


@endsection

@section('vendorshome')

<!-- <script>
    $(document).on('click', function(e){
        if($(e.target).parents('.price-card-container').length === 0){
            $('.cards').css('display', 'none');
            $('#ven-cards-overlay').css('display', 'none');
        }
    })
</script> -->

@endsection
