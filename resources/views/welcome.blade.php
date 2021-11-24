@extends('layout.login')

@section('head')
    <title>Login - SIG</title>
@endsection


@section('content')

    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="{{ route('welcome') }}" class="-intro-x flex items-center pt-5">
                    <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3">
                        SIG<span class="font-medium">v3</span>
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="Imagen Principal" class="-intro-x w-1/2 -mt-16"
                        src="{{ asset('img/logomain.svg') }}">
                    <!--
                                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">A few more clicks to <br> sign
                                            in to your account.</div>
                                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500">Manage all your
                                            e-commerce accounts in one place</div>
                                        -->
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    
                    @include('layout.partials.errors')
                    @include('layout.partials.flashMessage')
                    <div id="panelRegistro" class="">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left mt-8">Registro de Postulaciones:</h2>
                        <div class="intro-x">
                            <div class="box px-5 py-3 flex items-left ">
                            <a class="btn btn-outline-secondary py-3 px-4 w-full xl:w-80 mt-3 xl:mt-2 align-top zoom-in"
                                href="{{ route('form.person') }}" style="text-align: left;">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <i data-feather="users" class="w-50 block mx-auto mt-2 text-theme-9"></i>
                                </div>
                                <div class="ml-4 mr-auto text-left">
                                    <div class="font-medium text-lg">Registro de Jóvenes</div>                                    
                                </div>                            
                            </a>
                            </div>
                        </div>

                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-left">
                            <a class="btn btn-outline-secondary py-3 px-4 w-full xl:w-80 mt-3 xl:mt-2 align-top zoom-in"
                                href="{{ route('form.institution') }}" style="text-align: left;">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <i data-feather="home" class="w-50 block mx-auto mt-2 text-theme-1"></i>
                                </div>
                                <div class="ml-4 mr-auto text-left">
                                    <div class="font-medium text-lg">Registro de Empresas</div>                                    
                                </div>                                
                            </a>
                            </div>
                        </div>
                        <div class="intro-x text-center">
                            <a  href="javascript:;" data-toggle="modal"  data-target="#header-footer-modal-preview" class="text-theme-2 block font-extrabold text-lg"><u>Iniciar Sesión</u></a>
                        </div>
                    </div>


                    <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                
                                    <!-- BEGIN: Modal Header -->
                                    <div class="modal-header text-right">
                                        <h2 class="font-medium text-base mr-auto">Iniciar Sesión</h2>                                        
                                    </div>
                                    <!-- END: Modal Header -->
                                    <!-- BEGIN: Modal Body -->
                                    <form id="formlogin" action="{{ route('auth.login') }}" method="POST" class="">
                                    <div class="modal-body"> 
                                
                                        <!-- <h2 class="intro-x font-bold"></h2> -->
                                        <div class="h-full flex items-center">
                                            <div class="mx-auto text-center">
                                                <div class="">
                                                    <img alt="Plan de Empleo" src="{{ asset('img/logo.png') }}">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                        
                                        @method('POST')
                                        <div class="intro-x mt-8">
                                            @csrf
                                            <div class="input-form">
                                                <input id="email" type="text"
                                                    class="intro-x login__input form-control py-3 px-4 border-gray-300 block"
                                                    placeholder="Email" name="email" value="{{ old('email') }}" required>
                                                <div id="error-email" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
                                            </div>
                                            <div class="input-form">
                                                <input id="password" type="password"
                                                    class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                                                    placeholder="Password" name="password" required>
                                                <div id="error-password" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
                                            </div>

                                        </div>
                                        
                                    </div>
                                    <!-- END: Modal Body -->
                                    <!-- BEGIN: Modal Footer -->
                                    <div class="modal-footer text-right">
                                        <button id="btn-login" type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Iniciar</button>
                                        <!-- <button  class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button> -->
                                            
                                            <!-- <button id="hideLogin" type="button" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" >Ir a inicio.</button> -->
                                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Cancel</button>                                        
                                    </div>
                                    </form>
                                <!-- END: Modal Footer -->
                            </div>
                        </div>
                    </div>
                    <!-- END: Modal Content -->                                     
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
$(function(){
    var controlPanelLogin = {
        showPanelLogin: function(){            
            $("#panelLogin").removeClass("hidden");
            $("#panelRegistro").addClass("hidden");
        },
        hidePanelLogin: function(){
            $("#panelLogin").addClass("hidden");
            $("#panelRegistro").removeClass("hidden");
        }          
    }    
    $('#showLogin').click(function(){
        controlPanelLogin.showPanelLogin(); 
    });
    $('#hideLogin').click(function(){
        controlPanelLogin.hidePanelLogin(); 
    });
    $("#formlogin").on('submit', function(evt){        
        //$('#iconLoad').addClass("hidden");                
    });

    
       
})

cash(function () {
    cash('#btn-login').on('click', function() {
        cash('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        helper.delay(1500)
    })
})
</script>
@endsection