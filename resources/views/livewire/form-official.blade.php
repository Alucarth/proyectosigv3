<div>
    
        @include('layout.partials.errors')
        @include('layout.partials.flashMessage')

        <div class="intro-y box col-span-12 lg:col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    <span style="font-size: 2em; color: #C5CAE9;">
                        <i class="fas fa-user-shield"></i>
                    </span>
                    Oficiales Operativos
                </h2>
                <button type="button" class="btn btn-primary btn-sm"  wire:click="showOficial()">  <i class="fa fa-plus w-4 h-4 mr-2"></i>  Adicionar </button>
                
            </div>
            <div class="p-5">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="whitespace-nowrap uppercase">#</th>
                            <th class="whitespace-nowrap uppercase">Nombre Completo</th>
                            <th class="whitespace-nowrap uppercase">Correo</th>
                            <th class="whitespace-nowrap uppercase">Rol</th>
                            <th class="whitespace-nowrap uppercase">Estado</th>
                            <th class="whitespace-nowrap uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($officials as $index => $official)
                            <tr>
                                <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                                <td class="border-b dark:border-dark-5 uppercase">{{ $official->nombres }}
                                    {{ $official->paterno }} {{ $official->materno }}</td>
                                <td class="border-b dark:border-dark-5">{{ $official->user->email }}</td>
                                <td class="border-b dark:border-dark-5 uppercase">{{ $official->user->getRoleNames()[0] }}</td>
                                <td class="border-b dark:border-dark-5">
                                    @if ($official->user->activation == 1)
                                    <span class="px-1 py-1 rounded bg-theme-9 text-xs text-white mr-1">ACTIVO</span> 
                                       
                                    @else
                                    
                                        <span class="px-1 py-1 rounded bg-gray-200 text-xs text-black mr-1">INACTIVO </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($official->user->activation == 1)
                                        @if ($official->user->id != 1)
                                            <a class="flex cursor-pointer text-theme-6 mr-2"
                                                wire:click="softDeleteOfficial({{ $official->id }})">
                                                <x-feathericon-trash class="w-4 h-4 mr-1" />Dar de Baja
                                            </a>
                                        @endif
                                    @else
                                        @if ($official->user->id != 1)
                                            <a class="flex cursor-pointer text-theme-9 mr-2"
                                                wire:click="activateOfficial({{ $official->id }})">
                                                <x-feathericon-power class="w-4 h-4 mr-1" />Dar de Alta
                                            </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


<!-- BEGIN: Modal Content  check event listener--> 

<div id="oficial-modal" class="modal overflow-y-auto {{$dialog_oficial?'show':'hide'}}" data-backdrop="static" tabindex="-1" aria-hidden="false" style="padding-left: 0px; margin-top: 0px; margin-left: 0px; z-index: 10000;">
    <div class="modal-dialog modal-lg">
        
            <div class="modal-content"  > 
                <form wire:submit.prevent='addOfficial' >
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Registro de Oficial</h2> 
                    {{-- <button class="btn btn-outline-secondary hidden sm:flex"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs </button> --}}
                    
                </div> <!-- END: Modal Header -->
                <div class="modal-body ">
                    <div class="grid grid-cols-12 gap-4 items-center col-span-12 sm:col-span-12">
                        <div class="col-span-12 sm:col-span-6">
                            <label class="form-label">Nombres</label>
                            <input wire:model='nombres' type="text" class="form-control" placeholder="Jose Luis">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label class="form-label">Apellido Paterno</label>
                            <input wire:model='paterno' type="text" class="form-control" placeholder="Delgado">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label class="form-label">Apellido Materno</label>
                            <input wire:model='materno' type="text" class="form-control" placeholder="Mamani">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label class="form-label">Correo</label>
                            <input wire:model='correo' type="text" class="form-control" placeholder="micorreo@gmail.com">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label class="form-label">Rol</label>
                            <select wire:model="rolleOfficial" class="form-select">
                                <option value="">Seleccione un opcion</option>
                                <option value="oficial">Oficial Operativo</option>
                                <option value="responsable">Responsable Técnico Administrativo</option>
                                <option value="fiduciario">Fiduciario</option>
                            </select>
                        </div>
                        {{-- <div class="col-span-12 sm:col-span-1 pt-6">
                            <a wire:click='referencia' class="btn btn-secondary">Añadir</a>
                        </div>
                         --}}
                        
                    </div>
                </div>
                <div class="modal-footer text-right"> 
                    <button type="button" wire:click="closeOficial" class="btn btn-outline-secondary w-20 mr-1">Cancelar</button>
                    <button type="submit" class="btn btn-primary w-20">Guardar</button>
                 </div> <!-- END: Modal Footer -->
                </form>
            </div>
       
    </div>
</div>

<!-- END: Modal Content -->


{{-- 
        <h2 class="text-lg uppercase text-gray-900 py-2 text-left mt-4">Datos: </h2>
        <form wire:submit.prevent='addOfficial' class="grid grid-cols-12 gap-2 items-center">
            <div class="col-span-12 sm:col-span-3">
                <label class="form-label">Nombres</label>
                <input wire:model='nombres' type="text" class="form-control" placeholder="Jose Luis">
            </div>
            <div class="col-span-12 sm:col-span-3">
                <label class="form-label">Apellido Paterno</label>
                <input wire:model='paterno' type="text" class="form-control" placeholder="Delgado">
            </div>
            <div class="col-span-12 sm:col-span-3">
                <label class="form-label">Apellido Materno</label>
                <input wire:model='materno' type="text" class="form-control" placeholder="Mamani">
            </div>
            <div class="col-span-12 sm:col-span-3">
                <label class="form-label">Correo</label>
                <input wire:model='correo' type="text" class="form-control" placeholder="micorreo@gmail.com">
            </div>
            <div class="col-span-12 sm:col-span-3">
                <label class="form-label">Rol</label>
                <select wire:model="rolleOfficial" class="form-select">
                    <option value="">Seleccione un opcion</option>
                    <option value="oficial">Oficial Operativo</option>
                    <option value="responsable">Responsable Técnico Administrativo</option>
                    <option value="fiduciario">Fiduciario</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-3 pt-6">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form> --}}
    

    {{-- <div class="overflow-x-auto pt-4">
        <table class="table">
            <thead>
                <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                    <th class="whitespace-nowrap uppercase">#</th>
                    <th class="whitespace-nowrap uppercase">Nombre Completo</th>
                    <th class="whitespace-nowrap uppercase">Correo</th>
                    <th class="whitespace-nowrap uppercase">Rol</th>
                    <th class="whitespace-nowrap uppercase">Estado</th>
                    <th class="whitespace-nowrap uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($officials as $official)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{ $official->id }}</td>
                        <td class="border-b dark:border-dark-5 uppercase">{{ $official->nombres }}
                            {{ $official->paterno }} {{ $official->materno }}</td>
                        <td class="border-b dark:border-dark-5">{{ $official->user->email }}</td>
                        <td class="border-b dark:border-dark-5 uppercase">{{ $official->user->getRoleNames()[0] }}</td>
                        <td class="border-b dark:border-dark-5">
                            @if ($official->user->activation == 1)
                                ACTIVO
                            @else
                                INACTIVO
                            @endif
                        </td>
                        <td>
                            @if ($official->user->activation == 1)
                                @if ($official->user->id != 1)
                                    <a class="flex cursor-pointer text-theme-6 mr-2"
                                        wire:click="softDeleteOfficial({{ $official->id }})">
                                        <x-feathericon-trash class="w-4 h-4 mr-1" />Dar de Baja
                                    </a>
                                @endif
                            @else
                                @if ($official->user->id != 1)
                                    <a class="flex cursor-pointer text-theme-9 mr-2"
                                        wire:click="activateOfficial({{ $official->id }})">
                                        <x-feathericon-power class="w-4 h-4 mr-1" />Dar de Alta
                                    </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $officials->links() }}
    </div> --}}

    {{-- <a class="btn btn-outline-primary py-3 px-4 xl:w-80 mt-3 xl:mt-2 align-left"
        href="{{ route('page.dashboard') }}">Finalizar</a> --}}
</div>
