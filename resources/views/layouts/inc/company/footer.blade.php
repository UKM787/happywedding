<!-- Scripts -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

@routes
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>


<script type="text/javascript">
    jQuery(function($) {
        var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $('.vendor-dash-main-nav li a').each(function() {
            if (this.href === path) {
                console.log(this.href);
                $(this).parent().addClass('active');
            }
        });
    });
</script>


<!-- main navbar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const splideNavLinks = document.querySelectorAll('.wed-host-main-nav-items  > li > a');
        var allLinks = [];
        splideNavLinks.forEach(function(singleLink) {
            allLinks.push(singleLink.href);
        });
        const activeLink = window.location.href;
        let activeIndex = allLinks.indexOf(activeLink);
        new Splide('.vendor-dash-main-nav', {
            type: "slide",
            perPage: 5,
            perMove: 0,
            pagination: false,
            trimSpace: true,
            padding: { left: '3em', right: '3em' },
            rewind: true,
            start: activeIndex,
            height: '2.7rem',
            arrows: true,
            width: '95%',
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
</script>
<!-- main navbar ends -->


</body>

</html>
