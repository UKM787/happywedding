@extends('layouts.guestinvitation')

@section('content')

@include('host.partials.views._savedate')



@endsection

@section('wed-savedate')

<script>
    const fixedDate = document.querySelector(".date-decided").innerHTML;
    const deadlineTimer = document.querySelectorAll(".countdown-timer div span:nth-child(1)");
    const futureDate = new Date(fixedDate);
    

    



    const futureTime = futureDate.getTime();

    function getRemainingTime() {
        today = new Date().getTime();

        totalRemainingMS = futureTime - today;
        console.log(totalRemainingMS);
        if (totalRemainingMS < 0) {
            clearInterval(countdown);
            return;
        }

        //values in ms
        const Oneday = 24 * 60 * 60 * 1000;
        const Onehour = 60 * 60 * 1000;
        const Oneminutes = 60 * 1000;

        //remaining time calulation
        let Day = Math.floor(totalRemainingMS / Oneday);
        let Hour = Math.floor((totalRemainingMS % Oneday) / Onehour);
        let Minutes = Math.floor((totalRemainingMS % Onehour) / Oneminutes);
        let Seconds = Math.floor((totalRemainingMS % Oneminutes) / 1000);

        const value = [Day, Hour, Minutes, Seconds];

        function format(item) {
            if (item < 10) {
                return (item = `0${item}`);
            } else {
                return item;
            }
        }
        deadlineTimer.forEach(function(item, index) {
            item.innerHTML = format(value[index]);
        });

    }
    let countdown = setInterval(getRemainingTime, 1000);
    getRemainingTime();
</script>


@endsection
