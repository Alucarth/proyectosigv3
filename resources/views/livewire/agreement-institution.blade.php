<div>

        <div class="box py-8 px-6 mt-5">
            <h1 class="text-xl text-gray-900">Lista de Convenios</h1>
            <div class="overflow-x-auto mt-6" style="padding: 5px;">
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center pl-2 pb-3">
                    <button class="btn btn-secondary w-24 mr-1 mb-2">{{$tipoConsulta}}</button>
                    <div class="dropdown" style="margin-top: -8px;margin-left: -5px;">
                        <button class="dropdown-toggle btn px-2  " aria-expanded="false">
                            <span class="w-5 h-5 flex items-center justify-center">
                                <i class="fa fa-chevron-down fa-lg"></i>
                            </span>
                        </button>
                        <div class="dropdown-menu w-40">
                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                <a wire:click="getListaConvenios('CONVENIOS')" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                    <i class="fa fa-list-alt w-4 h-4 mr-2"></i> Todos
                                </a>
                                <a wire:click="getListaConvenios('PENDIENTES')" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                    <i class="fa fa-exclamation w-4 h-4 mr-2"></i> Pendientes
                                </a>
                                <a wire:click="getListaConvenios('FIRMADOS')" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                    <i class="fa fas fa-file w-4 h-4 mr-2"></i> Firmados
                                </a>                                
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="whitespace-nowrap uppercase">#</th>
                            {{-- <th class="whitespace-nowrap uppercase">Nombre Comercial</th> --}}
                            <th class="whitespace-nowrap uppercase">Razon Social</th>
                            <th class="whitespace-nowrap uppercase">Estado Convenio </th>
                            <th class="whitespace-nowrap uppercase">Inicio </th>
                            <th class="whitespace-nowrap uppercase">Fin</th>
                            <th class="whitespace-nowrap uppercase">Descripción </th>
                            <th class="whitespace-nowrap uppercase">Convenio</th>
                            <th class="whitespace-nowrap uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($assignments as $assignament)
                        
                            {{-- @if ($assignament->institution->estado == 'REGISTRADO') --}}
                            <tr>
                                <td class="border-b dark:border-dark-5">{{ $assignament->institution_id }}</td>
                                {{-- <td class="border-b dark:border-dark-5">
                                    {{ $assignament->institution->nombre_comercial }}</td> --}}
                                <td class="border-b dark:border-dark-5">
                                    {{ $assignament->razon_social }}
                                </td>
                                <td class="border-b dark:border-dark-5">{{ ($assignament->institution_estado == 'ACTIVO')?'FIRMADO':'PENDIENTE' }}</td>

                                <td class="border-b dark:border-dark-5">
                                    {{ ($assignament->fecha_convenio!="")? date('d/m/Y', strtotime($assignament->fecha_convenio)):"" }}
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    {{ ($assignament->fin_convenio!="")? date('d/m/Y', strtotime($assignament->fin_convenio)):"" }}                                    
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    {{ $assignament->detalle }}
                                </td>

                                <th class="whitespace-nowrap uppercase">
                                    @if ($assignament->institution_estado == 'ACTIVO')
                                        <button type="button" wire:click="verArchivo({{$assignament->institution_id}})"  class="" > <i class="fa fa-file-pdf fa-2x" style="color:#E70012"></i></button>    
                                    @endif                                    
                                </th>

                                <td class="border-b dark:border-dark-5">
                                    @if ($assignament->institution_estado == 'ACTIVO')
                                        <button type="button" wire:click="alertEliminarConvenio({{$assignament->institution_id}})" class="btn  p-1" ><i class="fa fa-trash fa-lg" style="color:rgba(255, 0, 0, 0.801)"> </i></button>    
                                    @else
                                        <button type="button" wire:click="showModal({{$assignament->institution_id}})"  class="btn btn-linkedin p-1" ><i class="fa fa-file-upload fa-lg"> </i></button>
                                    @endif
                                    
                                    {{-- <div class="mt-2">
                                        <div class="form-check">
                                            <input wire:model='institution_id' class="form-check-switch"
                                                type="checkbox" value="{{ $assignament->institution_id }}">
                                            <label class="form-check-label">
                                                Registrar
                                            </label>
                                        </div>
                                    </div> --}}
                                </td>
                            </tr>
                            {{-- @endif --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    <div id="ver-archivo-modal" class="modal overflow-y-auto {{$dialogArchivo?'show':'hide'}}" data-backdrop="static" tabindex="-1" aria-hidden="false" style="padding-left: 0px; margin-top: 0px; margin-left: 0px; z-index: 10000;">
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
    <div id="preview-modal" class="modal overflow-y-auto {{$dialog?'show':'hide'}}" data-backdrop="static" tabindex="-1" aria-hidden="false" style="padding-left: 0px; margin-top: 0px; margin-left: 0px; z-index: 10000;">
        <div class="modal-dialog modal-lg">
            
                <div class="modal-content"  style="height: 500px;"> 
                    <div class="modal-header">
                        <h2 class="font-medium text-base mr-auto">Cargar Convenio</h2>                         
                        <div class=" text-right"> <button type="button" wire:click="closeModal()" class="btn btn-default  "> <i class="fa fa-times"></i> </button> </div>
                    </div> <!-- END: Modal Header -->                                    
                    <div class="modal-body p-0">
                        {{-- {{$urlfile}} --}}
                        
                        <div class="box py-8 px-6 mt-2">
                            <form wire:submit.prevent='createAgreement' enctype="multipart/form-data"
                                class="items-center">
                                <div class="col-span-12 sm:col-span-3">
                                    <label class="form-label">Convenio digital</label>
                                    <input wire:model='archivoConvenio' type="file" class="form-control">
                                    @error('archivoConvenio') <small class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-span-12 sm:col-span-3">
                                    <label class="form-label">Fecha de Inicio</label>
                                    <input wire:model='fechaConvenio' type="date" class="form-control">
                                    @error('fechaConvenio') <small class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-span-12 sm:col-span-3">
                                    <label class="form-label">Fecha de Fin</label>
                                    <input wire:model='finConvenio' type="date" class="form-control">
                                    @error('finConvenio') <small class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-span-12 sm:col-span-3">
                                    <label class="form-label">Detalle</label>
                                    <textarea wire:model='detalle' type="text" class="form-control"></textarea>
                                    @error('detalle') <small class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-span-12 sm:col-span-3 pt-6 text-center">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
           
        </div>
    </div>    

    {{-- <a class="btn btn-outline-primary py-3 px-4 xl:w-80 mt-3 xl:mt-2 align-left"
        href="{{ route('page.dashboard') }}">Finalizar</a> --}}
</div>
