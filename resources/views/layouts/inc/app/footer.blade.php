<!-- <span id="last" style="background-color: rgb(70, 25, 82); display:flex; justify-content:center">
    <button style="display: none" id="buttonInstallPwa">
        Install PWA
    </button>
</span> -->
<div id="pwa-installer-cont">
    <div>
        <div class="pwa-head">
            Install App?
            <img style="cursor:pointer" src="/assets/pwa-cross.svg" alt="">
        </div>
        <div class="pwa-mid">
            <img src="/assets/PWA/72x72.png" alt="">
            Happywed
        </div>
        <div class="pwa-end">
            {{--<button type="button" id="pwa-cancel-btn">Cancel</button>--}}
            <button type="button" id="pwa-install-btn">Install</button>
        </div>
    </div>    
</div>

<script>
    var bod = document.body.children;
    // setTimeout(function(){
    //     bod[0].style.display = "none";
    //     for (var i = 1; i < bod.length; i++) {
    //         if ((bod[i].nodeName) !== "SCRIPT") {
    //             bod[i].style.display = "block";
    //         }
    //     }
    // },1000);
    window.addEventListener('load', function() {
        bod[0].style.display = "none";
        for (var i = 1; i < bod.length; i++) {
            //console.log(bod[i].getAttribute('id'));
            if ((bod[i].nodeName) !== "SCRIPT" && bod[i].getAttribute('id') != 'pwa-installer-cont') {
                bod[i].style.display = "block";
            }
        }
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>



<!-- Scripts -->
@routes
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>


<script type="text/javascript">
    let deferredPrompt;
    let buttonInstall = $('#pwa-installer-cont');
    let cross = $('#pwa-installer-cont .pwa-head img');
    let install = $('#pwa-installer-cont #pwa-install-btn');
    let cancel = $('#pwa-installer-cont #pwa-cancel-btn');
    if(cross.length > 0){
        cross[0].addEventListener('click', (e) => {
            buttonInstall.css("display","none");
        });
    }
    if(cancel.length > 0){
        cancel[0].addEventListener('click', (e) => {
            buttonInstall.css("display","none");
        });
    }
    if (document.cookie.indexOf("PWA=") === -1) {
        document.cookie = "PWA=clicked; max-age=600; path=/";
        // document.cookie = "PWA=clicked; max-age=1800; path=/";
            window.addEventListener('beforeinstallprompt', (e) => {
        buttonInstall.css("display","flex");
        // Prevent the mini-infobar from appearing on mobile
        e.preventDefault();
        // Stash the event so it can be triggered later.
        deferredPrompt = e;
        // Update UI notify the user they can install the PWA
        //showInstallPromotion();
        //let resp = confirm("Do you want to install PWA!");
        // Optionally, send analytics event that PWA install promo was shown.
        install[0].addEventListener('click', async () => {
            if (deferredPrompt !== null) {
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    deferredPrompt = null;
                }
            }
        });
    });
    window.addEventListener('appinstalled', () => {
        console.log('sss');
        // Hide the app-provided install promotion
        //hideInstallPromotion();
        // Clear the deferredPrompt so it can be garbage collected
        deferredPrompt = null;
        // Optionally, send analytics event to indicate successful install
        console.log('PWA was installed');
    });
    }
</script>


<script>
    function nav() {
        var disp = document.getElementById('nav-header').style.display;
        if (disp == "none") {
            document.getElementById('nav-header').style.display = "flex";
        } else {
            document.getElementById('nav-header').style.display = "none";
        }
    }
</script>
<script>
    $('.mobile-foot-heading').parent().on('click', function(e) {
        console.log($(e.currentTarget).next().css('display'));
        if ($(e.currentTarget).next().css('display') === "flex") {
            $(e.currentTarget).next().css('display', 'none');
        } else {
            $('.mobile-foot-heading').parent().next().each(function(index, element) {
                element.style.display = "none";
            })
            $(e.currentTarget).next().css('display', 'flex');
        }
    })
</script>
<!-- loader spinner -->

<!-- spinner loader ends -->

<!-- remove invalid characters in input type number starts  -->

<script>
    document.querySelectorAll('input[type="number"]').forEach(function(item) {
        item.addEventListener("keypress", function(evt) {
            console.log(evt);
            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57) {
                evt.preventDefault();
            }
        });
    });
</script>

<!-- remove invalid characters in input type number ends -->

<!-- Toogle password script -->
<script>
    function TogglePassLogin(type){
        if(type == "confirm"){
             var x =  document.getElementById("password-confirm");
        }else{
             var x = document.getElementById("password")
        }
       
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
    }
</script>

@yield('qr-script')
@yield('appscript')
@yield('wed-host-script')
@yield('weddingvenues')
@yield('ideas')
@yield('registerscript')
@yield('vendorshome')

    <script src="{{ asset('enable-push.js') }}"></script>
</body>

</html>
