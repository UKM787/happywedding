

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

@routes
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>


<script>
    let footDrop = document.querySelectorAll('.foot-drop');
    footDrop.forEach(function(item) {
        item.addEventListener('click', function(e) {
            footDrop.forEach(function(all) {
                if (all !== item) {
                    all.nextElementSibling.classList.remove('show-mobile-foot');
                }
            });
            item.nextElementSibling.classList.toggle('show-mobile-foot');
        });
    });
</script>

{{--<script>
    let notifyContainer = document.querySelector(".wed-host-notif-cont");
    let count = document.querySelector(".wed-host-notif-alert");
    let btn = document.querySelector(".wed-host-notif-btn");
    if (notifyContainer.childElementCount > 0) {
        count.classList.toggle('show');
    }
    btn.addEventListener('click', () => {
        notifyContainer.classList.toggle('show');
        count.classList.remove('show');
    });
</script>
--}}
<script type="text/javascript">
    jQuery(function($) {
        var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $('ul li a').each(function() {
            if (this.href === path) {
                $(this).parent().addClass('active');
            }
        });
    });
</script>

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

<!-- main navbar -->
{{--<script>
    document.addEventListener('DOMContentLoaded', function() {
        const splideNavLinks = document.querySelectorAll('.wed-host-main-nav-items  > li > a');
        var allLinks = [];
        splideNavLinks.forEach(function(singleLink) {
            allLinks.push(singleLink.href);
        });
        const activeLink = window.location.href;
        let activeIndex = allLinks.indexOf(activeLink);
        //console.log(activeIndex);
        new Splide('.vendor-dash-main-nav', {
            type: "slide",
            perPage: 6,
            perMove: 0,
            pagination: false,
            trimSpace: true,
            rewind: true,
            start: activeIndex,
            height: '2.7rem',
            padding: { left: '3em', right: '3em' },
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
</script>--}}
<!-- main navbar ends -->
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
        var formLoad = document.querySelector(".form-loader");
        if (formLoad !== null) {
            var bod = document.body.children;
            formLoad.addEventListener('submit', function() {
                if (bod[0].style.display) {
                    bod[0].style.display = "none";
                }
                bod[0].style.display = "block";
                for (i = 1; i < bod.length; i++) {
                    if ((bod[i].nodeName) !== "SCRIPT") {
                        bod[i].style.filter = "blur(3px)";
                    }
                }
            });
        }
    }
</script>
<!-- upload spinner ends -->
<!-- accordian and sort -->

<script>
    // var accordian = [...document.querySelectorAll(".wed-log-accord")];
    // console.log(accordian.forEach(function(item){
    //     console.log(item);
    // }));
    // accordian.forEach(function(item) {
    //     item.addEventListener('click', function() {
    //         console.log(item);
    //         var drop = item.nextElementSibling;
    //         if (drop.style.maxHeight) {
    //             drop.style.maxHeight = null;
    //             item.style.paddingBottom = "5px";
    //         } else {
    //             accordian.forEach(function(element) {
    //                 if (element !== item) {
    //                     element.nextElementSibling.style.maxHeight = null;
    //                     element.style.paddingBottom = "5px";
    //                 } else {
    //                     drop.style.maxHeight = drop.scrollHeight + "px";
    //                     if (item.style.paddingBottom) {
    //                         item.style.paddingBottom = null;
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // });


    function toggleBoot(e1, e2){
        let allNav = document.getElementsByClassName("nav-link");
        let allTab = document.getElementsByClassName("tab-pane");
        let nav = document.getElementById(e1);
        let tab = document.getElementById(e2);

        allNav.forEach(function(item){
            if(item.classList.contains('active')){
                item.classList.remove('active');
            }
        })
        allTab.forEach(function(item){
            if(item.classList.contains('active') || item.classList.contains('show')){
                item.classList.remove('active');
                item.classList.remove('show');
            }
        })
        nav.classList.add('active');
        tab.classList.add("active");
        tab.classList.add("show");
    }


    function display_sort(e) {
        e.stopPropagation();
        var sortBtn = document.querySelector('.wed-log-sort');
        if (sortBtn.style.display === "none") {
            sortBtn.style.display = "block";
        } else {
            sortBtn.style.display = "none";
        }

    }


    if (document.querySelector(".jsNav")) {
        var jsNav = document.querySelector(".jsNav").children;
        var jsTab = document.querySelector(".jsTab").children;
        for (let i = 0; i < jsNav.length; i++) {
            jsNav[i].addEventListener('click', function() {
                for (let j = 0; j < jsTab.length; j++) {
                    if (jsTab[j] !== jsTab[i]) {
                        jsTab[j].classList.add("jsTabHide");
                        jsNav[j].classList.remove("wed-host-gallery-active");

                    }
                }
                jsTab[i].classList.remove("jsTabHide");
                jsNav[i].classList.add("wed-host-gallery-active");
            });
        }

    }
</script>
<!-- accodian and sort ends -->

<!-- remove invalid characters in input type number starts  -->

<script>
    document.querySelectorAll('input[type="number"]').forEach(function(item){
        item.addEventListener("keypress", function (evt) {
            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
            {
                evt.preventDefault();
            }
        });
        // item.addEventListener("input", function (evt) {
        //     if(evt.target.value.length > 10){
        //         evt.target.value = evt.target.value.slice(0,10);
        //     }
        // });
    });
</script>

<!-- <script type="text/javascript">
    async function statesInviCall(){
        await new Promise(function(resolve){
            let time = setInterval(function(){
                if(typeof axios !== "undefined"){
                    clearInterval(time);
                    resolve();
                }
            }, 250);
        })
        let locationMaster = [];
        let states = [];
        let districts = [];
        let stateCont  = document.getElementById('state');
        let districtConnt = document.getElementById('location_id');
                console.log('sss');
        console.log('sss');

        if(districtConnt != null) {
            axios
            .get(`/api/vendor/addacc`)
                .then(function (response) {
                        locationMaster = response.data[0];
                        states = [
                            ...new Set(
                                locationMaster.map((item) => item.state)
                            ),
                        ];
                        let cont = $('#state');
                        let cityId =  null;
                        let stateName = null;
                        if(districtConnt.dataset.old != '' ){
                            cityId = parseInt(districtConnt.dataset.old);
                            stateName = locationMaster.find(x => x.id === cityId).state;
                            console.log(cityId);
                        }
                        for(i=0;i<states.length;i++){
                            const node = document.createElement("option");
                            const textnode = document.createTextNode(states[i]);
                            node.appendChild(textnode);
                            node.setAttribute("value", states[i]);
                            if(states[i] == stateName){
                                console.log(stateName);
                                node.setAttribute("selected", true);
                                getDistricts();
                            }
                            cont.append(node);
                        }
                })
                .catch((errors) => {
                        console.log("Get All: " + errors);
                });
        }
        

        if(stateCont != null){
            stateCont.addEventListener('change', function(){
                districts = [];
                locationMaster.map(function (el) {
                    if ('"' + el.state + '"' == '"' + stateCont.value + '"') {
                        districts.push({ id: el.id, name: el.name });
                    }
                });
                districtConnt.innerHTML = "<option value=''>Select your City</option>"
                for(i=0;i<districts.length;i++){
                    const node = document.createElement("option");
                    const textnode = document.createTextNode(districts[i].name);
                    node.appendChild(textnode);
                    node.setAttribute("value", districts[i].id);
                    districtConnt.appendChild(node);
                    // if(districtConnt.dataset.old == districts[i].id){
                    //     node.setAttribute("selected", true);
                    // }
                }
            });
            function getDistricts(){
                districts = [];
                locationMaster.map(function (el) {
                    if ('"' + el.state + '"' == '"' + stateCont.value + '"') {
                        districts.push({ id: el.id, name: el.name });
                    }
                });
                districtConnt.innerHTML = "<option value=''>Select your City</option>"
                for(i=0;i<districts.length;i++){
                    const node = document.createElement("option");
                    const textnode = document.createTextNode(districts[i].name);
                    node.appendChild(textnode);
                    node.setAttribute("value", districts[i].id);
                    districtConnt.appendChild(node);
                    if(districtConnt.dataset.old == districts[i].id){
                        node.setAttribute("selected", true);
                    }
                }
            }
        } 
    }      
    statesInviCall();
</script>  -->

<!-- remove invalid characters in input type number ends -->
@yield('wed-host-script')
@yield('wed-ceramony-slider')
@yield('wed-host-page-script')
@yield('gallery')
@yield('payment')
@yield('weddingvenuesoverlay')


</body>

</html>
