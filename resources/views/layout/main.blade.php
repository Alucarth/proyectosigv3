@extends('layout.base')

@section('body')
    <body class="main">
        @yield('content')
        <!-- BEGIN: JS Assets-->
        {{-- <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script> --}}
        <script src="{{ asset('dist/js/app.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- END: JS Assets-->

        @yield('script')
    </body>    
    <script>        
        window.addEventListener('alert', event => { 
            toastr[event.detail.type](event.detail.message,event.detail.title ?? ''), 
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });
    </script>
@endsection