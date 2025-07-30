<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<style>
    @page { margin: 0; background-color: #efdee4ff }
    * {
    box-sizing: border-box;
    }
    body { margin: 0; 
    padding: 0; overflow: hidden;  background-color: #efdee4ff;}
    .guest-acc-room-head{
        width: 100%; height: 97%; 
    } 
    .guest-invi-room-all{
        background-color: white !important;
        margin: 2em 5em;
        overflow: hidden;
    }
    .guest-invi-heading{
        font-family: 'Perpetua';
        font-style: normal;
        font-weight: 700;
        font-size: 29.5136px;
        line-height: 34px;
        /* identical to box height */
        text-align: center;
        color: #333333;
    }
    .guest-invi-room-head ,.guest-invi-room-single{
        width: 100%;
    }
    .guest-invi-room-head > div{
        font-family: 'Segoe UI';
        font-style: normal;
        font-weight: 400;
        font-size: 12.7985px;
        line-height: 17px;
        color: #8792A2;
        padding: 7px;
        /* display: inline-block; */
        float: left;
    }
    .guest-invi-room-single{

    }
    .guest-invi-room-single > span{
        font-family: 'Segoe UI';
        font-style: normal;
        font-weight: 400;
        font-size: 12.7985px;
        line-height: 17px;
        color: #8792A2;
        padding: 7px;
        float: left;
    }
    .bride-groom-name{
        font-family: 'STSong';
        font-style: normal;
        font-weight: 400;
        font-size: 33.861px;
        line-height: 44px;
        text-transform: uppercase;
        text-align: center;
        color: black;
        clear: left;
    }
    .bride-groom-name > span {
        font-family: 'Stalemate';
        font-style: normal;
        font-weight: 400;
        font-size: 61.5655px;
        line-height: 90px;

        color: black;
    }
    .logo {
        background-color: #461952;
        padding: 10px;
    }
    .logo > img{
        width: 150px;
        height: 55px;
    }
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
</style>
</head>
<body>
<div class="guest-acc-room-head">
    <div class="logo">
        <img src="{{storage_path('app/public/theme/logo-old.png')}}" alt="">
    </div>
    <h1 class="bride-groom-name"> brode <span>weds</span> grppm</h1>
    <h1 class="guest-invi-heading">Accomodation</h1>

    <div class="guest-invi-room-all">
        <div class="guest-invi-room-head clearfix">
            <div style="width: 15%;">Name</div>
            <div style="width: 15%;">Phone Number</div>
            <div style="width: 20%;">Hotel</div>
            <div style="width: 10%;">Block</div>
            <div style="width: 10%;">Floor</div>
            <div style="width: 10%;">Room.No</div>
        </div>
        @if($privileges->guest_invitation->accommodationStatus == 4)
        <div
            class="guest-invi-room-single clearfix"
        >
            <span style="width: 15%">{{$user->name}}</span>
            <span style="width: 15%">{{$user->mobile}}</span>
            <span style="width: 20%">{{
                $guestAccommodationInfo?->hotelName
            }}</span>
            <span style="width: 10%">{{
                $guestAccommodationInfo?->block
            }}</span>
            <span style="width: 10%">{{
                $guestAccommodationInfo?->floor
            }}</span>
            <span style="width: 10%">{{
                $guestAccommodationInfo?->roomno
            }}</span>
        </div>
        @endif
        @foreach($accomodationInfo as $single)
        <div
            class="guest-invi-room-single clearfix"
        >
            <span style="width: 15%">{{$single->family->familyname}}</span>
            <span style="width: 15%">{{$single->family->familymobile}}</span>
            <span style="width: 20%">{{
                $single->hotelName
            }}</span>
            <span style="width: 10%">{{
                $single->block
            }}</span>
            <span style="width: 10%">{{
                $single->floor
            }}</span>
            <span style="width: 10%">{{
                $single->roomno
            }}</span>
        </div>
        @endforeach           
    </div> 
</div>
</body>
</html>