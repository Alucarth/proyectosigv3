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
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 xxl:col-span-9">
                    <div class="grid grid-cols-12 gap-6">
                        <!-- BEGIN: General Report -->
                        <div class="col-span-12 mt-8">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    Bienvenido
                                </h2>
                            </div>
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
@endsection