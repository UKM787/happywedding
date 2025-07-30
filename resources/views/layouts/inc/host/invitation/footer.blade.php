<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

@routes
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>


{{--<script>
    document.addEventListener('DOMContentLoaded', function() {
        const splideNavLinks = document.querySelectorAll('.wed-host-invitation-nav-items  > li > a');
        var allLinks = [];
        splideNavLinks.forEach(function(singleLink) {
            allLinks.push(singleLink.href);
        });
        const activeLink = window.location.href;
        let activeIndex = allLinks.indexOf(activeLink);
        new Splide('.vendor-dash-main-nav', {
            type: "slide",
            perPage: 6,
            perMove: 0,
            pagination: false,
            trimSpace: true,
            rewind: true,
            start: activeIndex,
            height: '2.7rem',
            arrows: true,
            width: '95%',
            drag: true,
            padding: { left: '3rem', right: '3rem' },
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

<script type="text/javascript">
    $(function() {
        //this returns the whole url
        var current = window.location.href;

        //this identifies the list you are targeting
        $('ul li a').each(function() {
            var $this = $(this);

            // if the current path is exactly like this link, make it active

            if ($this.attr('href') === current) {

                //this takes care of ul inside a ul, it opens and make active the selected li
                $(this).parent().addClass('active');
                // $this.parents('.dropdown-menu').toggle();
                // $this.css('color', 'red');
            }
        })
    });
</script>

<!-- image file preview javascript selector -->
<script type="text/javascript">
    function imageOne(input) {
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


<!-- image file preview javascript selector -->
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageTwoTag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageTwo").change(function() {
        readURL(this);
    });
</script>


<!-- image file preview javascript selector -->
<script type="text/javascript">
    function imageThree(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageThreeTag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageThree").change(function() {
        imageThree(this);
    });
</script>

<!-- image file preview javascript selector -->
<script type="text/javascript">
    function imageFour(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageFourTag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageFour").change(function() {
        imageFour(this);
    });
</script>

<!-- image file preview javascript selector -->
<script type="text/javascript">
    function imageFive(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageFiveTag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageFive").change(function() {
        imageFive(this);
    });
</script>

<!-- image file preview javascript selector -->
<script type="text/javascript">
    function imageSix(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageSixTag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageSix").change(function() {
        imageSix(this);
    });
</script>
<!-- image file preview javascript selector -->

<!-- unchecked checkbox return 0 and checked return 1 -->
<script>
    $("form").submit(function() {

        var this_master = $(this);

        this_master.find('input[type="checkbox"]').each(function() {
            var checkbox_this = $(this);


            if (checkbox_this.is(":checked") == true) {
                checkbox_this.attr('value', '1');
            } else {
                checkbox_this.prop('checked', true);
                //DONT' ITS JUST CHECK THE CHECKBOX TO SUBMIT FORM DATA
                checkbox_this.attr('value', '0');
            }
        })
    })
</script>

<!-- upload spinner -->
<script>
    {
        // var formLoad = document.querySelector(".form-loader");
        // var bod = document.body.children;
        // formLoad.addEventListener('submit', function() {
        //     if (bod[0].style.display) {
        //         bod[0].style.display = "none";
        //     }
        //     bod[0].style.display = "block";
        //     for (i = 1; i < bod.length; i++) {
        //         if ((bod[i].nodeName) !== "SCRIPT") {
        //             bod[i].style.filter = "blur(3px)";
        //         }
        //     }
        // });
    }   
</script>
<!-- upload spinner ends -->

<script>
        var formLoad = document.querySelectorAll(".form-loader");
        var bod = document.body.children;
        formLoad.forEach(function(item){
            item.addEventListener('submit', function(e) {
                if (bod[0].style.display) {
                    bod[0].style.display = "none";
                }else{
                    bod[0].style.display = "block";
                for (i = 1; i < bod.length; i++) {
                    if ((bod[i].nodeName) !== "SCRIPT") {
                        bod[i].style.filter = "blur(3px)";
                    }
                }
                   uploadFile(e);
                }
            });
        });
        function uploadFile(e){
            let file = $(e.target).find("[type=file]")[0].files[0]
            var formdata = new FormData();
            formdata.append("file1", file);
            let ajax = new XMLHttpRequest();

            ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.addEventListener("load", completeHandler, false);
            ajax.open("POST", "#"); 
            ajax.send(formdata);

            function progressHandler(event) {
                console.log(event);
                var percent = Math.round((event.loaded / event.total) * 100);
                $('#percent').text(`${percent} %`);
                $('#bytes').text("Uploaded " + event.loaded + " bytes of " + event.total);
            }
            function completeHandler(event) {
                // $('#percent').text(``);
                // bod[0].style.display = "none";
                // for (i = 1; i < bod.length; i++) {
                //     if ((bod[i].nodeName) !== "SCRIPT") {
                //         bod[i].style.filter = "none";
                //     }    
                // }
                $($('#bytes')).after("<div>Please Wait!</div>");


                $('#upload-success').text('Uploaded' + file.name);
            }
        }
</script>

<!-- Countdown timer JS starts -->

<!-- Countdown timer JS ends -->

<!-- remove invalid characters in input type number starts  -->

<script>
    document.querySelectorAll('input[type="number"]').forEach(function(item){
        item.addEventListener("keypress", function (evt) {
            console.log(evt);
            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
            {
                evt.preventDefault();
            }
        });
    });
</script>

<!-- remove invalid characters in input type number ends -->


<script>
    var accordian = document.querySelectorAll(".guest-list-accord");
    accordian.forEach(function(item) {
        item.addEventListener('click', function() {
            var drop = item.nextElementSibling;
            if (drop.style.maxHeight) {
                drop.style.maxHeight = null;
                item.style.paddingBottom = "5px";
            } else {
                accordian.forEach(function(element) {
                    if (element !== item) {
                        element.nextElementSibling.style.maxHeight = null;
                        element.style.paddingBottom = "5px";
                    } else {
                        drop.style.maxHeight = drop.scrollHeight + "px";
                        if (item.style.paddingBottom) {
                            item.style.paddingBottom = null;
                        }
                    }
                });
            }
        });
    });
</script>




@yield('wed-host-script')
@yield('wed-host-slider')
@yield('wed-ceramony-slider')



</body>

</html>
