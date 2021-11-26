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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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

        window.addEventListener('swal:modal', event => { 
            swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
            });
        });
        
        window.addEventListener('swal:confirmEntidad', event => { 
            swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
            buttons: true,
            dangerMode: true,
            buttons: ["Cancelar", "Si, continuar"],
            })
            .then((willDelete) => {
            if (willDelete) {
                window.livewire.emit('concluirRegistro');
            }
            });
        });


    </script>
@endsection