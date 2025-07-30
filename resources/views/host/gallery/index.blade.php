@extends('layouts.host')

@section('styles')
   {{--<style>
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
        .wed-host-gallery-items{
            padding-bottom: 1em;
        }
        .host-gal-vid-name{

            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            padding: 0;
        }
        .host-gal-pic-album-name{
            grid-column-start: 1;
            grid-column-end:-1 ;
            font-family: Suprema;
            font-style: normal;
            font-weight: 600;
            font-size: 20.1118px;
            line-height: 25px;
            text-align:center

        }

        .wed-host-gallery-items>div {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-auto-rows: max-content;
            padding: 1em;
            grid-column-gap: 1em;
            grid-row-gap: 1.5em;
        }
        .img-wrap > form {
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
        }
        .wed-image-form {
            grid-column-start: 1;
            grid-column-end:3 ;
        }


        .gallery_upload_form {
            background: rgba(226, 226, 226, 0.6);
            backdrop-filter: blur(4px);
            border-radius: 17.8211px;
        }

        .gallery_album_form {
            background: rgba(226, 226, 226, 0.6);
            backdrop-filter: blur(4px);
            border-radius: 17.8211px;
        }

        /* .gallery_upload_form>input {
            display:none;
        } */

        .gallery_upload_form1>label {
            display: flex;
            justify-content: center;
            width: 100%;
            height: 100%;
            cursor: pointer;
            flex-direction: column;
        }

        .gallery_upload_form1>label>span {
            align-self: center;
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
            height: 100%;
            object-fit: cover;
            border-radius: 17.8211px;
        }
        .img-wrap > span {
            bottom: 0;
            position: absolute;
            display: inline-block;
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
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-auto-rows: 1fr;
            grid-column-gap: 1em;
            grid-row-gap: 1.5em;
        }
        .wed-host-album-items > .img-wrap > form{
            height: 100%;
        }

        .wed-image-form1 {
            grid-column-start: 1;
            grid-column-end: 2;

        }
        .wed-image-form1 > div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .close-icon {
            border-radius: 50%;
            position: absolute;
            right: 5px;
            top: -10px;
            padding: 5px 8px;
        }
        .img-wrap {
            position: relative;
            padding-top: 100% ;
        }

        .img-wrap .close {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 100;
        }

        .gallery_upload_form1 {
            background: rgba(226, 226, 226, 0.6);
            backdrop-filter: blur(4px);
            border-radius: 17.8211px;

        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn1 {
            border: 2px solid gray;
            color: gray;
            background-color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: bold;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 30px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

        /* Gallery Page Css ends */

    </style>
    --}}
@endsection

@section('content')
<host-gallery :host="{{$host}}" :invitations="{{$invitations}}" :albums="{{$albums ? $albums : 'null'}}" :galleries="{{$galleries ? $galleries : 'null'}}" :videos="{{$videos ? $videos : 'null'}}"></host-gallery>

    {{--<section class="wed-host-gallery">
        <!-- <div class="jsNav">
            <div class="wed-host-gallery-active">
                <a href="{{route('hostgallery.index',  $host)}}" style="text-decoration: none; font-weight:normal; color:#968585">Pictures</a>
            </div>
            <div>
                Albums
            </div>
            <div>
                Videos
            </div>
        </div>
        <div class="jsTab  wed-host-gallery-items ">
            <div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                </div>
                @endif
                <form action="{{ route('addAlbum', $host) }}" method="POST" class="wed-image-form gallery_upload_form" enctype="multipart/form-data">
                    @csrf
                    <div class="p-3">
                        <div class="row p-2"><label for="album" class="form-label"> Create new or add images to album</label>
                            <input type="text" name="album" class="form-control " />
                            @error('album')
                                <div class="text-danger">Enter the Album Name</div>
                            @enderror
                        </div>
                        <div class="row mb-2 p-2">
                            <label for="image" class="form-label">Add Image</label>
                            <input type="file" name="galleryImage[]" class="form-control form-control-sm" id="" multiple />
                            @error('galleryImage')
                                <div class="text-danger">Please enter a valid name</div>
                            @enderror
                        </div>
                        <div class="row p-3">
                            <button class="btn btn-sm btn-primary ">Create Album</button>
                        </div>
                    </div>
                </form>

                 @foreach($galleries as $image)
                <div class="img-wrap">
                    <form action="{{ route('hostgallery.destroy', ['host' => $host, 'gallery' => $image->id]) }}" method="POST">
                        @method('delete')
                        @csrf
                        <span class="close"><button type="submit"
                                class=" btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this image?')"><i
                                    class="fas fa-remove"></i></button></span>
                        <img src="/files/{{ $host->id }}/{{ $image->imageName }}" />
                        
                    </form>
                    <span class="text-center fw-bold">{{$image->album->name}}</span>
                </div>            
                @endforeach 
                @isset($albums)
                @foreach($albums as $album)
                <div class="host-gal-pic-album-name">{{ $album->name }}</div>
                @foreach ($album->images as $image)
                <div class="img-wrap">
                    <form action="{{ route('hostgallery.destroy', ['host' => $host, 'gallery' => $image->id]) }}" method="POST">
                        @method('delete')
                        @csrf
                        <span class="close"><button type="submit"
                                class=" btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this image?')"><i
                                    class="fas fa-remove"></i></button></span>
                        <img src="/files/{{ $host->id }}/{{ $image->imageName }}" />
                        
                    </form>
                </div>    
                @endforeach         
                @endforeach 
                @endisset

                 @isset($albums)
                @foreach ($albums as $album)
                    <div>
                        
                        <div class="wed-host-album-button">
                            <div>
                                <i class="fas fa-images"></i> {{ $album->images->where('video', 0)->count() }}
                            </div>
                            <img src="/assets/Rectangle 119.png" alt="">
                            <div>
                                <span>
                                    @isset($album){{ $album->name }}@endisset
                                </span>
                            </div>
                        </div>
                        <div class="wed-host-album-items" style="display:none">
                            <form action="{{ route('hostgallery.store', $host) }}" method="POST" class="wed-image-form1 gallery_upload_form1" id="{{ $album->id }}" enctype="multipart/form-data">
                                @csrf
                                <div class="p-3">
                                    <input type="hidden" name="albumId" value="{{ $album->id }}">
                                    <div class="row p-3">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn1"><i class="fas fa-upload"></i> Upload Image</span></button>
                                            <input type="file" name="galleryImage[]" multiple />
                                        </div>
                                    </div>
                                    <div class="row p-2">
                                        <button type="submit" class="form-control p-2 btn btn-sm btn-primary">submit</button>
                                    </div>
                                </div>   
                            </form>
                            @foreach ($galleries as $image)
                                @if ($image->video == 0)
                                    <div class="img-wrap">
                                        <form action="{{ route('hostgallery.destroy', ['host' => $host, 'gallery' => $image->id]) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <span class="close"><button type="submit"
                                                    class=" btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this image?')"><i
                                                        class="fas fa-remove"></i></button></span>
                                            <img src="/files/{{ $host->id }}/{{ $image->imageName }}" />
                                        </form>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
                @endisset

            </div>
            <div class="wed-host-gallery-albums jsTabHide">
                <div class="album-head" style="display:none;">
                    <span>
                        <i class="fas fa-arrow-alt-circle-left" id="back-album"></i>
                        @isset($album){{$album->name}}@else Back @endisset
                    </span>
                </div>
                <form action="" class="gallery_upload_form" hidden>
                  
                </form> 
                @isset($albums)
                @foreach ($albums as $album)
                    <div>
                        <div class="wed-host-album-button">
                            <div>
                                <i class="fas fa-images"></i> {{ $album->images->count() }}
                            </div>
                            <img src="/assets/Rectangle 119.png" alt="">
                             <div class="img-wrap">
                                <form
                                    action="{{ route('deleteAlbum', ['host' => $host, 'album' => $album->id]) }}"
                                    method="POST">
                                    @method('delete')
                                    @csrf
                                    <span class="close"><button type="submit" 
                                             onclick="return confirm('Are you sure want to delete this image?')" ><i
                                                class="fas fa-remove"></i></button></span>
                                    
                                </form>
                            </div>
                            
                            <div>
                                <span>
                                    {{ $album->name }} 
                                </span>
                            </div>
                         
                        </div>
                        <div class="wed-host-album-items" style="display:none">
                           
                            <form action="{{ route('hostgallery.store', $host) }}" method="POST" class="wed-image-form1 gallery_upload_form1" id="{{ $album->id }}" enctype="multipart/form-data">
                                @csrf
                                <div class="p-3">
                                    <input type="hidden" name="albumId" value="{{ $album->id }}">
                                    <div class="row p-3">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn1"><i class="fas fa-upload"></i> Upload Image</span></button>
                                            <input type="file" name="galleryImage[]" multiple />
                                        </div>
                                    </div>
                                    <div class="row p-2">
                                        <button type="submit" class="form-control p-2 btn btn-sm btn-primary">submit</button>
                                    </div>
                                </div>   
                            </form>
                            @foreach ($album->images as $image)
                               
                                    <div class="img-wrap">
                                        <form
                                            action="{{ route('hostgallery.destroy', ['host' => $host, 'gallery' => $image->id]) }}"
                                            method="POST">
                                            @method('delete')
                                            @csrf
                                            <span class="close"><button type="submit" 
                                                    class=" btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this image?')" ><i
                                                        class="fas fa-remove"></i></button></span>
                                            <img src="/files/{{ $host->id }}/{{ $image->imageName }}" />
                                        </form>
                                    </div>
                                
                            @endforeach 
                        </div>
                    </div>
                @endforeach
                @endisset
            </div>
            <div class="jsTabHide">
                <form action="{{route('hostvideoUpload',$host)}}" method="POST" class="wed-image-form gallery_upload_form" enctype="multipart/form-data">
                    @csrf
                    <div class="p-3">
                        <div class="row p-2"><label for="album" class="form-label"> Video Name</label>
                            <input type="text" name="album" class="form-control " />
                            @error('album')
                                <div class="text-danger">Enter the Name</div>
                            @enderror
                        </div>
                        <div class="row mb-2 p-2">
                            <label for="image" class="form-label">Add Image</label>
                            <input type="file" name="galleryVideo" class="form-control form-control-sm" id="" multiple />
                            @error('galleryImage')
                                <div class="text-danger">Please enter a valid name</div>
                            @enderror
                        </div>
                        <div class="row p-3">
                            <button class="btn btn-sm btn-primary ">Upload</button>
                        </div>
                    </div>

                </form>
                @php
                 function after($str1, $inthat)
                    {
                        if (!is_bool(strpos($inthat, $str1)))
                        return substr($inthat, strpos($inthat,$str1)+strlen($str1));
                    };
                @endphp
                @isset($videos)
                @foreach($videos as $video)
                        <div class='m-2 p-2'>
                            <div class="row">
                                <video width="320" height="200" controls>
                                    <source src="{{URL::asset("/videos/$host->id/$video->name")}}" type="video/{{after('.',$video->name)}}">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="row p-2">
                                <div class="col-8 host-gal-vid-name">
                                    {{$video->name}}
                                </div>
                                <div class="col-4" style="text-align: left;">
                                    <form action="{{ route('deleteVideo', ['host' => $host, 'video' => $video->id]) }}"
                                        method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" 
                                                class=" btn btn-sm btn-danger p-2" onclick="return confirm('Are you sure want to delete this image?')" >Delete</button>
                                    </form>
                                </div>
                                        
                            </div>
                            
                        </div>                          
                @endforeach
                @endisset
                
            </div>
        </div> -->
    </section>--}}

@endsection

@section('gallery')
    {{--<script>
        // let uploads = document.querySelector('.gallery_upload');
        // let form = document.querySelector('.gallery_upload_form');
        // const num = document.createElement('span');
        // uploads.addEventListener('change', function() {
        //     console.log(uploads.files.length);
        //     num.textContent = uploads.files.length;
        //     console.log(uploads.previousElementSibling.firstElementChild);
        //     uploads.previousElementSibling.firstElementChild.after(num);
        //     form.submit();
        //     form.addEventListener('submit', function() {
        //         num.textContent = null;
        //     });
        // });
    </script>

    <script>
        var albumForm = document.querySelector('.wed-host-gallery-albums > form');
        var web_gallery=document.querySelector('.wed-host-gallery-items>div')
        var album_form=document.querySelector('.wed-host-gallery-items > div > form');
        var albumCont = document.querySelector('.wed-host-gallery-albums');
        var albumHead = document.querySelector('.album-head');
        var albumBack = document.querySelector('#back-album');
        var album = [...document.querySelectorAll(".wed-host-album-button")];
        var items = [...document.querySelectorAll(".wed-host-album-items")];
        let tabs = [...document.querySelectorAll('.jsNav > div')];
        album.forEach(function(element) {
            element.addEventListener('click', function() {
                album.forEach(function(all) {
                    all.style.display = "none";
                    //web_gallery.style.display="none";
                });
                    
                //items.nextElementSibling.style.display = "grid";
                element.nextElementSibling.style.display = "grid";
                albumForm.style.display = "none";
                album_form.style.display="none";
                albumCont.style.display = "block";
                albumHead.style.display = "block";
            });
        });
        albumBack.addEventListener('click', back);
        tabs.forEach(function(tab) {
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
    <script>
        // var select =document.getElementById('file_input1');
        // console.log(select);
        // select.addEventListener('change',function(){
        //     this.form.submit();
        //     console.log(select);
        // },false);



        // $(document).on('click','.gallery_upload_form',function(){
        //     console.log('ok');
        //     let id=$(this).attr('id');
        //     $(function() {
        //     $("#file_input"+id).on("change", function() {
        //     alert($(this).val()); 
        //     });
        //     });

        // });

        // $(document).on('change','.gallery_upload',function(){
        //     console.log('ok');
        //     let id=$(this).attr('id');
        //     alert(id);
        // });



        // $(function(){
        //     $('#file_input1').on('keyup',function(){
        //     alert('Change Happened');

        // });
        // });
    </script>--}}
@endsection
