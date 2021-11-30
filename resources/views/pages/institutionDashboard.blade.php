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
                                    <div class="font-medium text-lg">
                                        {{ $institution->razon_social }}</div>
                                    <div class="text-gray-600">NIT: {{ $institution->nit }}</div>
                                    <div class="text-gray-600">ESTADO: {{ $institution->estado }}</div>
                                </div>

                            </div>
                            <div
                                class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
                                <div class="font-medium text-center lg:text-left lg:mt-3">DETALLE DE CONTACTO</div>
                                <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                                    <div class="truncate sm:whitespace-normal flex items-center">
                                        <span style="font-size: 1em; color: #444444;" class="pr-2">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        {{ $institution->nombre }} {{ $institution->paterno }}
                                        {{ $institution->materno }}
                                    </div>
                                    <div class="truncate sm:whitespace-normal flex items-center mt-3">
                                        <span style="font-size: 1em; color: #444444;" class="pr-2">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        {{ $institution->email }}
                                    </div>
                                    <div class="truncate sm:whitespace-normal flex items-center mt-3">
                                        <span style="font-size: 1em; color: #444444;" class="pr-2">
                                            <i class="fas fa-phone-square-alt"></i>
                                        </span>
                                        {{ $institution->telefono }}
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
                                <div class="text-center rounded-md w-20 py-3">
                                    <a href="{{ route('institution.editEstadoIntitution') }}">
                                        <div class="btn font-medium text-theme-1 dark:text-theme-10 text-xl">
                                            <span style="font-size: 1em; color: #444444;">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                        </div>
                                        <div class="text-gray-600" style="font-size: 11px;">Editar<br>Registro</div>
                                    </a>
                                </div>
                                @if($institution->estado == 'REGISTRADO')
                                <div class="text-center rounded-md w-20 py-3">
                                    <a href="{{ route('institution.activeVacanciasIntitution') }}">
                                        <div class="btn font-medium text-theme-1 dark:text-theme-10 text-xl">
                                            <span style="font-size: 1em; color: #444444;">
                                                <i class="fas fa-box"></i>
                                            </span>
                                        </div>
                                        <div class="text-gray-600" style="font-size: 11px;">Activar Vacancias</div>
                                    </a>
                                </div>
                                @endif
                                {{-- <div class="text-center rounded-md w-20 py-3">
                                    <div class="font-medium text-theme-1 dark:text-theme-10 text-xl">492</div>
                                    <div class="text-gray-600">Reviews</div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
