<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    {{--DropZone CSS--}}
    <link rel="stylesheet" href="{{ url('assets/dist/dropzone.css') }}">

    <link rel="stylesheet" href="{{ url('assets/formbuilder/vendor/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ url('assets/formbuilder/dist/formbuilder.css') }}">
    <link rel="stylesheet" href="{{ url('assets/admin.custom.css') }}">
    <link rel="stylesheet" href="{{ url('assets/Ideal-Image-Slider-JS-master/ideal-image-slider.css') }}">
    <link rel="stylesheet" href="{{ url('assets/Ideal-Image-Slider-JS-master/ideal-image-slider.css') }}">
    <link rel="stylesheet" href="{{ url('assets/Ideal-Image-Slider-JS-master/themes/default/default.css') }}">
    <link href="{{ url('assets/light_gallery/dist/css/lightgallery.css') }}" rel="stylesheet">
    <link href="{{ url('assets/light_gallery/dist/css/custom.css') }}" rel="stylesheet">


    <style type="text/css">
       .gallery-image-wrapper{
            width: 100%;
            height: 127px;
            overflow: hidden;
        }

        .file-detail{
            font-size: 70%;
        }

       #slider {
           max-width: 900px;
           margin: 50px auto;
       }

       ul.drop-search{
           border: solid grey 1px;
           list-style-type: none;
           padding: 3px;
       }

       ul.drop-search li.selected{
           background-color: #6b9dbb;
       }

       ul.drop-search li{
           border-bottom: solid 1px #5bc0de;
       }

       ul.drop-search li img{
           height: 25px;
       }

       ul#side-nav li{
           position: relative;
       }
        .create-link{
            position: absolute; right: 6px; top: 12px;
            /*display: none;*/
            transition: opacity 1s ease-out;
            opacity: 0;
            height: 0;
            overflow: hidden;

        }

       ul#side-nav li:hover .create-link{
           /*display: block;*/
           opacity: 1;
           height: auto;
       }

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/assets/theme1/admin.js"></script>

    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script src="{{url('assets/light_gallery/dist/js/lightgallery-all.min.js')}}"></script>
    <script src="{{url('assets/light_gallery/lib/jquery.mousewheel.min.js')}}"></script>

    @if(isset($reCaptcha))
        {!! html_entity_decode($reCaptcha) !!}
    @endif

    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script type="text/javascript">
        var base_url = "{{url('/')}}";
        var CKEditorStartupMode = '{{env('CKEDITORMODE','wysiwyg')}}';
    </script>
    <title>{{ config('app.name', 'Laravel') }} ADMIN</title>
</head>
<body>


<header class="navbar navbar-expand navbar-dark  flex-column flex-md-row bd-navbar border" style="background-color: #373a3d">
    <a class="navbar-brand mr-0 mr-md-2" href="/" aria-label="Bootstrap">
        {{ config('app.name','WDDS') }}
    </a>

    <span style="color: white" class="debug"></span>



    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    <form id="delete-record" action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="">
    </form>


</header>

<div class="container-fluid">
    <div class="row flex-xl-nowrap">
        <div class="col-12 col-md-3 col-xl-2 bd-sidebar border" style="background-color: #f2f2f2">

            <ul class="nav flex-column" id="side-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{url('admin/passers/1')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        School Leader Board <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/passers') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        Passers
                    </a>
                    <a href="/admin/passers/create" class="create-link" style="">
                        <svg class="feather feather-plus-circle sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" data-reactid="971"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    </a>
                </li>
            </ul>

        </div>


        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-5 bd-content" role="main">

            @yield('content')

        </main>

    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" id="flash-message-trigger" data-toggle="modal" data-target="#exampleModal" style="display: none">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: none">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" id="alert-message" role="alert">
                    This is a success alert—check it out!
                </div>
            </div>
            <div class="modal-footer" style="">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<script type="text/javascript">
    var successMessage = '{!! html_entity_decode(addslashes(session('success'))) !!}';
</script>




</body>
</html>
