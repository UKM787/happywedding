@extends('layouts.app')

@section('content')
<div class="row venue-box container guest-form d-flex">
    <div class="col-sm-8">
        <div class="row">
            @foreach($venues as $listedvenue)
                <div class="col-sm-4">
                    <div class="v-box">
                        @if(is_null($listedvenue))
                        <a href="{{$listedvenue->reachHere}}">
                            <img src="{{asset('storage').'/venues/venueDefault.png'}}" alt="{{$listedvenue->nameOfPlace}}">
                        </a>
                        @else
                        <a href="{{$listedvenue->reachHere}}">
                            <img src="{{asset('storage').$listedvenue->imageOne}}" alt="{{$listedvenue->nameOfPlace}}">
                        </a>
                        @endif
                        <h3 class="v-title"> {{$listedvenue->nameOfPlace}} <a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></h3>
                        <p class="text-muted">{{$listedvenue->address}}</p>
                        <p>{{$listedvenue->city}},{{$listedvenue->state}},{{$listedvenue->country}}-{{$listedvenue->pincode}}</p>
                        <p class="text-muted">
                        <div id="map" style="height:200px; width:100%"></div>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-4">


    </div>

</div>






@endsection

@section('wed-host-script')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1vfhqHr3ukWp1q55-YObQ1LdWlhTTC5k&callback=initMap&libraries=&v=weekly" async></script>

<script>
    let map;

    function initMap() {

        //location
        const location = {
            lat: 13.0827,
            lng: 80.2702
        };
        // map showing general marker using lat, lng coordinationes
        const map = new google.maps.Map(document.getElementById("map"), {
            center: location,
            zoom: 12,
        });
        /*
             google.maps.addListener(map,"click",(event) => {
               addMarker({location:event.latLng});
             }); */

        // specifing differnet marker than default
        /*  const marker= new google.maps.Marker({
           position: location,
           map: map,
           icon: "https://img.icons8.com/nolan/2x/marker.png"
         }); */

        // content to marker by clicking on it
        /*   const detailWindow = new google.maps.InfoWindow({
            content: `<h2>Chennai</h2>`
          });


          marker.addListener("mouseover", () => {
            detailWindow.open(map,marker);
          }); */

        //addMarker function

        let props = [{
                location: {
                    lat: 13.0827,
                    lng: 80.2702
                },
                imageIcon: "https://img.icons8.com/nolan/1x/marker.png",
                content: `<h2>Mumbai</h2>`
            },
            {
                location: {
                    lat: 13.1827,
                    lng: 80.2702
                },
                imageIcon: "https://img.icons8.com/nolan/1x/marker.png",
                content: `<h2>Chennai</h2>`

            },
            {
                location: {
                    lat: 13.2827,
                    lng: 80.2702
                },
                imageIcon: "https://img.icons8.com/nolan/1x/marker.png",
                content: `<h2>Madurai</h2>`

            },
            {
                location: {
                    lat: 13.3827,
                    lng: 80.2702
                },
                imageIcon: "https://img.icons8.com/nolan/1x/marker.png",
                content: `<h2>Coimbatore</h2>`
            }
        ];

        for (let i = 0; i <= props.length; ++i) {
            addMarker(props[i]);
        }

        function addMarker(props) {
            const marker = new google.maps.Marker({
                position: props.location,
                map: map,
                //icon: props.imageIcon,

            });

            if (props.imageIcon) {
                marker.setIcon(props.imageIcon);
            }

            if (props.content) {
                const detailWindow = new google.maps.InfoWindow({
                    content: props.content
                });

                marker.addListener("mouseover", () => {
                    detailWindow.open(map, marker);
                });
            }


        }


    }
</script>
@endsection
