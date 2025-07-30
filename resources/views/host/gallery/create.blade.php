@extends('layouts.host')

@section('styles')
<style>
    /* Gallery Page Css starts */

    .wed-host-gallery {
        background-color: white;
        margin-top: 2em;
    }

    .wed-host-gallery>div:nth-child(1) {
        display: flex;
        justify-content: center;
    }

    .wed-host-gallery-active {
        font-weight: bold !important;
        color: #7f004b !important;
        border-bottom: 4px solid #7f004b !important;
    }

    .wed-host-gallery>div:nth-child(1)>div {
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 17.8211px;
        line-height: 21px;
        color: #968585;
        flex: 1;
        text-align: center;
        padding: 2em 0;
        border: 0.891053px solid #cbc7c7;
    }

    .wed-host-gallery-items>div {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        grid-auto-rows: 1fr;
        padding: 1em;
        grid-column-gap: 1em;
        grid-row-gap: 1.5em;
    }

    .gallery_upload_form {
        background: rgba(226, 226, 226, 0.6);
        backdrop-filter: blur(4px);
        border-radius: 17.8211px;
    }

    .gallery_upload_form>input {
        display: none;
    }

    .gallery_upload_form>label {
        display: flex;
        justify-content: center;
        width: 100%;
        height: 100%;
        cursor: pointer;
        flex-direction: column;
    }

    .gallery_upload_form>label>span {
        align-self: center;
    }

    .wed-host-gallery-items>div img {
        width: 100%;
    }

    .wed-host-album-button {
        position: relative;
        cursor: pointer;
    }

    .wed-host-album-button>div:nth-child(1) {
        position: absolute;
        right: 0;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
        line-height: 19px;
        color: #ffffff;
        margin: 10px;
    }

    .wed-host-album-button>div:nth-child(3) {
        position: absolute;
        bottom: 0;
        margin: 10px;
        display: flex;
        flex-direction: column;
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 15px;
        line-height: 18px;
        color: #ffffff;
    }

    .wed-host-album-button>div:nth-child(3)>span:nth-child(2) {
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 12px;
        color: #ffffff;
    }

    .album-head {
        display: flex;
        flex-direction: column;
        margin-bottom: 1.5em;
    }

    .album-head>span>i {
        font-size: 25px;
        color: #461952;
        margin-right: 5px;
        cursor: pointer;
    }

    .album-head>span:nth-child(1) {
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 28px;
        line-height: 33px;
        color: #000000;
    }

    .album-head>span:nth-child(2) {
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 22px;
        line-height: 26px;
        color: #000000;
    }

    .wed-host-album-items {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        grid-auto-rows: 1fr;
        grid-column-gap: 1em;
        grid-row-gap: 1.5em;
    }

    /* Gallery Page Css ends */
</style>

@endsection

@section('content')
<section class="wed-host-gallery">
    <div class="jsNav">
        <div class="wed-host-gallery-active">
            Pictures
        </div>
        <div>
            Albums
        </div>
        <div>
            Videos
        </div>
    </div>
    <div class="jsTab wed-host-gallery-items">
        <div>
            <form action="{{route('hostgallery.store', $host)}}" method="POST" class="gallery_upload_form" enctype="multipart/form-data">
                @csrf
                <label for="upload">
                    <span>
                        <i class="fas fa-upload"></i> Upload new</span>
                </label>
                <input class="gallery_upload" id="upload" type="file" name="galleryImage[]" multiple>
            </form>
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
        </div>
        <div class="wed-host-gallery-albums jsTabHide">
            <div class="album-head" style="display:none;">
                <span>
                    <i class="fas fa-arrow-alt-circle-left" id="back-album"></i>
                    Pre- wedding
                </span>
                <span>
                    Chennai
                </span>
            </div>
            <form action="" class="gallery_upload_form">
                <label for="upload">
                    <span>
                        <i class="fas fa-upload"></i> Upload new</span>
                </label>
                <input class="gallery_upload" id="upload" type="file" multiple>
            </form>
            <div>
                <div class="wed-host-album-button">
                    <div>
                        <i class="fas fa-images"></i> 27
                    </div>
                    <img src="/assets/Rectangle 119.png" alt="">
                    <div>
                        <span>
                            Pre- wedding
                        </span><span>
                            Chennai
                        </span>
                    </div>
                </div>
                <div class="wed-host-album-items" style="display:none">
                    <form action="" class="gallery_upload_form">
                        <label for="upload">
                            <span>
                                <i class="fas fa-upload"></i> Upload new</span>
                        </label>
                        <input class="gallery_upload" id="upload" type="file" multiple>
                    </form>
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                </div>
            </div>
            <div>
                <div class="wed-host-album-button">
                    <div>
                        <i class="fas fa-images"></i> 27
                    </div>
                    <img src="/assets/Rectangle 119.png" alt="">
                    <div>
                        <span>
                            Pre- wedding
                        </span><span>
                            Chennai
                        </span>
                    </div>
                </div>
                <div class="wed-host-album-items" style="display:none">
                    <form action="" class="gallery_upload_form">
                        <label for="upload">
                            <span>
                                <i class="fas fa-upload"></i> Upload new</span>
                        </label>
                        <input class="gallery_upload" id="upload" type="file" multiple>
                    </form>
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                </div>
            </div>
            <div>
                <div class="wed-host-album-button">
                    <div>
                        <i class="fas fa-images"></i> 27
                    </div>
                    <img src="/assets/Rectangle 119.png" alt="">
                    <div>
                        <span>
                            Pre- wedding
                        </span><span>
                            Chennai
                        </span>
                    </div>
                </div>
                <div class="wed-host-album-items" style="display:none">
                    <form action="" class="gallery_upload_form">
                        <label for="upload">
                            <span>
                                <i class="fas fa-upload"></i> Upload new</span>
                        </label>
                        <input class="gallery_upload" id="upload" type="file" multiple>
                    </form>
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                    <img src="/assets/Rectangle 119.png" alt="">
                </div>
            </div>
        </div>
        <div class="jsTabHide">
            <form action="" class="gallery_upload_form">
                <label for="upload">
                    <span>
                        <i class="fas fa-upload"></i> Upload new</span>
                </label>
                <input class="gallery_upload" id="upload" type="file" multiple>
            </form>
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
            <img src="/assets/Rectangle 119.png" alt="">
        </div>
    </div>
</section>




@endsection

@section('gallery')
<script>
    let uploads = document.querySelector('.gallery_upload');
    let form = document.querySelector('.gallery_upload_form');
    const num = document.createElement('span');
    uploads.addEventListener('change', function() {
        console.log(uploads.files.length);
        num.textContent = uploads.files.length;
        console.log(uploads.previousElementSibling.firstElementChild);
        uploads.previousElementSibling.firstElementChild.after(num);
        form.submit();
        form.addEventListener('submit', function() {
            num.textContent = null;
        });
    });
</script>

<script>
    var albumForm = document.querySelector('.wed-host-gallery-albums > form');
    var albumCont = document.querySelector('.wed-host-gallery-albums');
    var albumHead = document.querySelector('.album-head');
    var albumBack = document.querySelector('#back-album');
    var album = document.querySelectorAll(".wed-host-album-button");
    var items = document.querySelectorAll(".wed-host-album-items");
    let tabs = document.querySelectorAll('.jsNav > div')
    album.forEach(function(element) {
        element.addEventListener('click', function() {
            album.forEach(function(all) {
                all.style.display = "none";
            });
            element.nextElementSibling.style.display = "grid";
            albumForm.style.display = "none";
            albumCont.style.display = "block";
            albumHead.style.display = "block";
        });
    });
    albumBack.addEventListener('click', back);
    tabs.forEach(function(tab){
        tab.addEventListener('click', back);
    });

    function back() {
        album.forEach(function(all) {
            all.style.display = "block";
        });
        items.forEach(function(item) {
            item.style.display = "none";
        });
        albumForm.style.display = "block";
        albumCont.style.display = "grid";
        albumHead.style.display = "none";
    }
</script>
@endsection
