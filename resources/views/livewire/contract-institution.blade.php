<div>
    @include('layout.partials.errors')
    @include('layout.partials.flashMessage')
    @if ($ventana == 1)
        <div class="box py-8 px-6">
            <h1 class="text-xl text-gray-900">Lista de Vacancias Pendientes</h1>
            <div class="overflow-x-auto mt-6">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Entidad economica</th>
                            <th class="whitespace-nowrap">Denominación del cargo</th>
                            <th class="whitespace-nowrap">Personal requerido</th>
                            <th class="whitespace-nowrap">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacancies as $vacancy)
                            <tr>
                                <td class="border-b dark:border-dark-5">{{ $vacancy->id }}</td>
                                <td class="border-b dark:border-dark-5 text-gray-700 uppercase">
                                    {{ $vacancy->institution->nombre_comercial }}
                                    <br>
                                    <span class="text-gray-600">
                                        {{ $vacancy->institution->razon_social }}
                                    </span>
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    {{ $vacancy->nombre }}
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    {{ $vacancy->cantidad }}
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    <div class="mt-2">
                                        <div class="form-check">
                                            <input wire:model='vacancia_id' class="form-check-switch" type="checkbox"
                                                value="{{ $vacancy->id }}">
                                            <label class="form-check-label">
                                                Registrar Contrato
                                            </label>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="mt-2">
                                        <div class="form-check">
                                            <input wire:model='vacanciaId' class="form-check-switch" type="checkbox"
                                                value="{{ $vacancy->id }}">
                                            <label class="form-check-label">
                                                Liberar
                                            </label>
                                        </div>
                                    </div>
                                -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if ($ventana == 2)
        <h1 class="text-xl text-gray-900"></h1>
        <div class="box py-8 px-6 mt-2">
            <form wire:submit.prevent='addContract' enctype="multipart/form-data"
                class="intro-y grid grid-cols-12 gap-2 items-center">
                <div class="col-span-12 sm:col-span-3">
                    <label class="form-label">Persona</label>
                    <select wire:model="payroll_id" class="form-select">
                        <option value="">Seleccione un opcion</option>
                        @foreach ($payrolls as $payroll)
                            <option class="uppercase" value="{{ $payroll->id }}">
                                {{ $payroll->people->nombres }} {{ $payroll->people->paterno }}
                                {{ $payroll->people->materno }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-3">
                    <label class="form-label">Paquete</label>
                    <select wire:model="package_id" class="form-select">
                        <option value="">Seleccione un opcion</option>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-3">
                    <label class="form-label">Fecha Inicio</label>
                    <input wire:model='fecha_inicio' type="date" class="form-control">
                </div>
                <div class="col-span-12 sm:col-span-3">
                    <label class="form-label">Fecha Fin</label>
                    <input wire:model='fecha_fin' type="date" class="form-control">
                </div>
                <div class="col-span-12 sm:col-span-3">
                    <label class="form-label">Contrato</label>
                    <input wire:model='archivoContrato' type="file" class="form-control">
                </div>
                <div class="col-span-12 sm:col-span-3">
                    <label class="form-label">Codigo</label>
                    <input wire:model='codigo' type="text" class="form-control" placeholder="MPD/INF/001-2021">
                </div>
                <div class="col-span-12 sm:col-span-3 pt-6">
                    <button type="submit" class="btn btn-secondary">Guardar</button>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto mt-6">
            <table class="table">
                <thead>
                    <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Nombre Beneficiario</th>
                        <th class="whitespace-nowrap">Cite</th>
                        <th class="whitespace-nowrap">Contrato</th>
                        <th class="whitespace-nowrap"></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($contratos as $key=>$contrato)
                        <tr>
                            <td class="border-b dark:border-dark-5">{{ $key+=1 }}</td>
                            <td class="border-b dark:border-dark-5 text-gray-700 uppercase">
                                
                                <span class="text-gray-600">
                                    {{ $contrato->person->nombres }} {{ $contrato->person->paterno }} {{ $contrato->person->materno }}
                                </span>
                            </td>
                            <td class="border-b dark:border-dark-5">
                                {{ $contrato->codigo }}
                            </td>
                            <td class="border-b dark:border-dark-5">
                                <button type="button" wire:click="verArchivo({{$contrato->id}})"  class="" > <i class="fa fa-file-pdf fa-2x" style="color:#E70012"></i></button>
                            </td>
                            <td class="border-b dark:border-dark-5">
                                <button class="btn btn-sm btn-danger" wire:click="deleteContrato({{$contrato->id}})" > <i class="fas fa-trash w-4 h-4 mr-2"></i> </button>
                            </td>
                            
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a class="btn btn-outline-primary py-3 px-4 xl:w-80 mt-3 xl:mt-2 align-left"
        href="{{ route('contract.institution') }}">Salir</a>
    @endif
    <div id="ver-archivo-modal-contrato" class="modal overflow-y-auto {{$dialogArchivo?'show':'hide'}}" data-backdrop="static" tabindex="-1" aria-hidden="false" style="padding-left: 0px; margin-top: 0px; margin-left: 0px; z-index: 10000;">
        <div class="modal-dialog modal-lg">
            
                <div class="modal-content"  style="height: 500px;"> 
                    <div class=" text-right"> <button type="button" wire:click="closeModal()" class="btn btn-default  "> <i class="fa fa-times"></i> </button> </div>
                    {{-- <button  type="button" class=" w-8 h-8"  wire::click="closeModal()"> <i  class="fa fa-times"></i> </button> --}}
                    <div class="modal-body p-0">
                        {{-- {{$urlfile}} --}}
                        <iframe src="{{$urlfile}}" frameborder="0" class="w-full" style="height: 500px;" >
                        </iframe>
                    </div>
                </div>
            
        </div>
    </div>
</div>

