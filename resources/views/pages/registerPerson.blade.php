@extends('layout.login')

@section('head')
    <title>Registro - SIG</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="{{ route('welcome') }}" class="-intro-x flex items-center pt-5">
                    <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3">
                        SIG<span class="font-medium">v3</span>
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="Rubick Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                        src="{{ asset('img/logomain.svg') }}">
                    <!--<div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">Unos pocos clics más para<br>
                        regístrar en su cuenta. </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500">Encuentra ofertas
                        laborales para ti en un solo lugar</div>-->
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div
                    class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Registro Jóvenes</h2>
                    <!--<div class="intro-x mt-2 text-gray-500 dark:text-gray-500 xl:hidden text-center">Unos pocos clics más
                        para registrar en su cuenta. Encuentra ofertas laborales para ti en un solo lugar
                    </div>-->
                    {{-- @include('layout.partials.errors') --}}
                    <form method="post" action="{{ route('register.person') }}">
                        @csrf
                        <div class="intro-x mt-8">
                            <input type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block"
                                placeholder="Nombres" name="nombres" value="{{ old('nombres') }}">
                                @error('nombres') <small class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small> @enderror
                            <input type="text"
                                class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                                placeholder="Apellido Paterno" name="paterno" value="{{ old('paterno') }}">
                                @error('paterno') <small class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small> @enderror
                            <input type="text"
                                class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                                placeholder="Apellido Materno" name="materno" value="{{ old('materno') }}">
                                @error('materno') <small class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small> @enderror
                            <input type="text"
                                class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                                placeholder="Email" name="email" value="{{ old('email') }}">
                                @error('email') <small class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small> @enderror
                            <input type="password"
                                class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                                placeholder="Password" name="password">
                                @error('password') <small class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small> @enderror
                            <div class="intro-x py-3 px-4 block mt-4 flex items-center">
                                <span>{!! captcha_img() !!}</span>
                            </div>
                            <input type="text" name="captcha"
                                class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                                placeholder="captcha">
                                @error('captcha') <small class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small> @enderror
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit"
                                class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Registrar</button>

                            <button id="hideLogin" type="button" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" onclick="window.location='/';" >Ir a inicio.</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>
@endsection
