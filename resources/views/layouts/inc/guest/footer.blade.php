<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

@routes
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
@yield('wed-guest-script')

<script>
    // let notifyContainer = document.querySelector(".wed-host-notif-cont");
    // let count = document.querySelector(".wed-host-notif-alert");
    // let btn = document.querySelector(".wed-host-notif-btn");
    // if (notifyContainer.childElementCount > 0) {
    //     count.classList.toggle('show');
    // }
    // if(btn.l)
    // btn.addEventListener('click', () => {
    //     notifyContainer.classList.toggle('show');
    //     count.classList.remove('show');
    // });
</script>

<script type="text/javascript">
    jQuery(function($) {
        var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $('ul li h5 a').each(function() {
            if (this.href === path) {
                $(this).parent().parent().addClass('active');
            }
        });
    });
</script>

{{--<script>
    document.addEventListener('DOMContentLoaded', function() {
        const splideNavLinks = document.querySelectorAll('.wed-guest-main-nav-items  > li > h5 > a');
        var allLinks = [];
        splideNavLinks.forEach(function(singleLink) {
            allLinks.push(singleLink.href);
        });
        const activeLink = window.location.href;
        let activeIndex = allLinks.indexOf(activeLink);
        new Splide('.vendor-dash-main-nav', {
            type: "slide",
            perPage: 4,
            perMove: 0,
            pagination: false,
            trimSpace: true,
            rewind: true,
            start: activeIndex,
            height: '2.7rem',
            arrows: true,
            width: '95%',
            padding: { left: '3rem', right: '3rem' },
            drag: true,
            // isNavigation: 'true',
            // mediaQuery: 'max',
            breakpoints: {
                768: {
                    perPage: 1,
                    height: '6rem',
                    width: '90%',
                }
            }
        }).mount();
    });
</script>--}}


{{--<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('.guest-invitation-slider', {
            type: 'slide',
            perPage: 3,
            perMove: 1,
            pagination: false,
            trimSpace: false,
            rewind: true,
            breakpoints: {
                600: {
                    perPage: 1,
                    height: '3rem',
                }
            }
        }).mount();
    });
</script>--}}

<script type="text/javascript">
    function imageOne(input) {
        console.log('ss');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageOneTag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageOne").change(function() {
        imageOne(this);
    });
</script>

<script type="text/javascript">
    function imageTwo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageTwoTag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageTwo").change(function() {
        imageTwo(this);
    });
</script>


<script src="{{ asset('enable-push.js') }}"></script>
</body>

</html>
