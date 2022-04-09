@extends('layout.main')

@section('subhead')
    <title>Dashboard - SIG</title>
@endsection

@section('content')
    @include('layout.components.mobil-menu')
    <div class="flex">
        @include('layout.components.side-menu')
        <div class="content">
            @include('layout.components.top-bar')
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">Bienvenido</h2>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 xxl:col-span-12">
                    <div class="intro-y box px-5 pt-5 mt-5">
                        <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
                            <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                                <div class="w-10 h-0 sm:w-35 sm:h-0 flex-none lg:w-5 lg:h-5 image-fit relative">
                                    <span style="font-size: 3em; color: #444444;">
                                        <i class="fas fa-id-card"></i>
                                    </span>
                                </div>
                                <div class="ml-5">
                                    <div class="font-medium text-lg">{{ $person->nombres }} {{ $person->paterno }}
                                        {{ $person->materno }}
                                    </div>
                                    <div class="text-gray-600">Cedula identidad: <b> {{ $person->ci }}
                                            {{ $person->expedido }} </b> </div>
                                    <div class="text-gray-600">Fecha nacimiento: <b>
                                            {{ Carbon\Carbon::parse($person->nacimiento)->format('d/m/Y') }} </b> </div>
                                </div>

                            </div>
                            <div
                                class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
                                <div class="font-medium text-center lg:text-left lg:mt-3">LUGAR DE RECIDENCIA</div>
                                <div class="flex flex-col justify-center items-center lg:items-start ">
                                    <div class="">
                                        <div class="text-gray-600">Departamento: <b> {{ $person->department->nombre }}
                                            </b> </div>
                                    </div>
                                    <div class="">
                                        <div class="text-gray-600">Dirección: <b> {{ $person->direccion }} </b> </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">

                                <div class="text-center rounded-md w-20 py-3">
                                    <a href="{{ route('person.pdfRegistroPerson') }}">
                                        <div class="btn font-medium text-theme-1 dark:text-theme-10 text-xl">
                                            <span style="font-size: 1em; color: #444444;">
                                                <i class="fas fa-file-pdf"></i>
                                            </span>
                                        </div>
                                        <div class="text-gray-600" style="font-size: 11px;">Ficha Personal</div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
