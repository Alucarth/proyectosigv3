<div>
    @include('layout.partials.errors')
    @include('layout.partials.flashMessage')
    {{-- @if ($ventana == 1) --}}
    <div class="grid grid-cols-12 gap-4 items-center col-span-12 sm:col-span-12">

        {{-- panel lista --}}
        <div class="intro-y box col-span-12 lg:col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    <span style="font-size: 2em; color: #C5CAE9;">
                        <i class="fas fa-user-shield"></i>
                    </span>
                    Lista de Oficiales

                </h2>
                {{-- <button type="button" class="btn btn-primary btn-sm"  wire:click="showHijo()">  <i class="fa fa-plus w-4 h-4 mr-2 "></i>  Adicionar </button> --}}
                {{-- <button class="btn btn-outline-secondary hidden sm:flex"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file w-4 h-4 mr-2"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> Download Excel </button> --}}
            </div>
            <div class="p-5">
                <div class=" gap-4 gap-y-5 mt-5">
                    <table class="table">
                        <thead>
                            <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                                <th class="whitespace-nowrap uppercase">#</th>
                                <th class="whitespace-nowrap uppercase">Nombres</th>
                                <th class="whitespace-nowrap uppercase">Apellido Paterno</th>
                                <th class="whitespace-nowrap uppercase">Apellido MAterno</th>
                                <th class="whitespace-nowrap uppercase">Estado </th>
                                <th class="whitespace-nowrap uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($officials as $index => $official)
                                @if ($official->user->getRoleNames()[0] == 'oficial')
                                    <tr>
                                        <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                                        <td class="border-b dark:border-dark-5 text-gray-700 uppercase">
                                            {{ $official->nombres }}
                                        </td>
                                        <td class="border-b dark:border-dark-5 uppercase">
                                            {{ $official->paterno }}
                                        </td>
                                        <td class="border-b dark:border-dark-5 uppercase">
                                            {{ $official->materno }}
                                        </td>
                                        <td class="border-b dark:border-dark-5">
                                            {{ $official->estado }}
                                        </td>
                                        <td class="border-b dark:border-dark-5">
                                            <div class="mt-2">
                                                {{-- <button class="btn btn-facebook w-32 mr-2 mb-2"> <i data-feather="facebook" class="w-4 h-4 mr-2"></i> Facebook </button>
                                                <button class="btn btn-twitter w-32 mr-2 mb-2"> <i data-feather="twitter" class="w-4 h-4 mr-2"></i> Twitter </button>
                                                <button class="btn btn-instagram w-32 mr-2 mb-2"> <i data-feather="instagram" class="w-4 h-4 mr-2"></i> Instagram </button>
                                                 <button class="btn btn-linkedin w-32 mr-2 mb-2"> <i data-feather="linkedin" class="w-4 h-4 mr-2"></i> Linkedin </button>  --}}

                                                <button class="btn btn-sm btn-twitter" wire:click="setOficial({{$official->id}})">  Asignaciones <i class="fas fa-angle-right w-4 h-4 ml-2"></i> </button>
                                                {{-- <div class="form-check">
                                                    <input wire:model='official_id' class="form-check-switch"
                                                        type="checkbox" value="{{ $official->id }}">
                                                    <label class="form-check-label">
                                                        Asignar
                                                    </label>
                                                </div> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        {{-- final panel --}}

        {{-- panel asignaciones --}}

        @if($oficial)

            <div class="intro-y box col-span-12 lg:col-span-12">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        <span style="font-size: 2em; color: #1E88E5;">
                            <i class="fas fa-user"></i>
                        </span>
                        {{$oficial->getFullname()}}

                    </h2>
                    <button type="button" class="btn btn-primary btn-sm"  wire:click="showAsignacion()">  <i class="fa fa-plus w-4 h-4 mr-2 "></i>  Adicionar </button>
                    {{-- <button class="btn btn-outline-secondary hidden sm:flex"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file w-4 h-4 mr-2"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> Download Excel </button> --}}
                </div>
                <div class="p-5">
                    <strong>Lista de Empresas Asignadas</strong>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                        <table class="table col-span-12 sm:col-span-12">
                            <thead>
                                <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                                    <th class="whitespace-nowrap uppercase">#</th>
                                    {{-- <th class="whitespace-nowrap uppercase">Nombre Comercial</th> --}}
                                    <th class="whitespace-nowrap uppercase">Razon Social</th>
                                    <th class="whitespace-nowrap uppercase">Estado </th>
                                    <th class="whitespace-nowrap uppercase">Registrado por</th>
                                    <th class="whitespace-nowrap uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignments as $index => $assignament)
                                    <tr>
                                        <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                                        {{-- <td class="border-b dark:border-dark-5">{{ $assignament->institution->nombre_comercial }}</td> --}}
                                        <td class="border-b dark:border-dark-5">{{ $assignament->institution->razon_social  }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $assignament->estado  }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $assignament->user->email  }}</td>
                                        {{-- <td class="border-b dark:border-dark-5">{{ $assignament->user->email }}</td> --}}
                                        <td class="border-b dark:border-dark-5">
                                            <div class="text-theme-6">
                                                <a wire:click='softdeletedAssignment({{ $assignament->id }})'
                                                    class="flex items-center mr-3 cursor-pointer">
                                                    <x-feathericon-trash class="w-4 h-4 mr-1" /> Dar de Baja
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        @endif

        {{-- end panel asignaciones --}}



    </div>




    {{-- @endif --}}
    {{-- @if ($ventana == 2)
        <div class="box py-8 px-6">
            <form wire:submit.prevent='addAssignment' class="grid grid-cols-12 gap-2 items-center">
                <div class="col-span-12 sm:col-span-3">
                    <label class="form-label">Unidad Economica</label>
                    <select wire:model="institution_id" class="form-select">
                        <option value="">Seleccione un opcion</option>
                        @foreach ($institutions as $institution)
                            <option value="{{ $institution->id }}">{{ $institution->razon_social }} -
                                {{ $institution->nombre_comercial }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-3 pt-6">
                    <button type="submit" class="btn btn-primary">Asignar</button>
                </div>
            </form>
        </div>

        <div class="box py-8 px-6 mt-2">
            <h1 class="text-xl text-gray-900">Lista de Vacancias Pendientes</h1>
            <div class="overflow-x-auto mt-6">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="whitespace-nowrap uppercase">#</th>
                            <th class="whitespace-nowrap uppercase">Nombre Comercial</th>
                            <th class="whitespace-nowrap uppercase">Razon Social</th>
                            <th class="whitespace-nowrap uppercase">Estado </th>
                            <th class="whitespace-nowrap uppercase">Registrado por</th>
                            <th class="whitespace-nowrap uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $assignament)
                            <tr>
                                <td class="border-b dark:border-dark-5">{{ $assignament->id }}</td>
                                <td class="border-b dark:border-dark-5">{{ $assignament->institution->nombre_comercial }}</td>
                                <td class="border-b dark:border-dark-5">{{ $assignament->institution->razon_social  }}</td>
                                <td class="border-b dark:border-dark-5">{{ $assignament->estado  }}</td>
                                <td class="border-b dark:border-dark-5">{{ $assignament->user->email }}</td>
                                <td class="border-b dark:border-dark-5">
                                    <div class="text-theme-6">
                                        <a wire:click='removePayroll({{ $assignament->id }})'
                                            class="flex items-center mr-3 cursor-pointer">
                                            <x-feathericon-trash class="w-4 h-4 mr-1" /> Dar de Baja
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif --}}

    <!-- BEGIN: Modal Content  check event listener-->

<div id="asignacion-modal" class="modal overflow-y-auto {{$dialog_asignacion?'show':'hide'}}" data-backdrop="static" tabindex="-1" aria-hidden="false" style="padding-left: 0px; margin-top: 0px; margin-left: 0px; z-index: 10000;">
    <div class="modal-dialog modal-lg">

            <div class="modal-content"  >
                <form wire:submit.prevent='addAssignment' >

                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Adicionar Empresa</h2>
                    {{-- <button class="btn btn-outline-secondary hidden sm:flex"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs </button> --}}

                </div> <!-- END: Modal Header -->
                <div class="modal-body ">
                    <div class="grid grid-cols-12 gap-4 items-center col-span-12 sm:col-span-12">
                        <div class="col-span-12 sm:col-span-8">
                            <label class="form-label">Unidad Economica</label>
                            <select wire:model="institution_id" class="form-select">
                                <option value="">Seleccione un opcion</option>
                                @foreach ($institutions as $institution)
                                    <option value="{{ $institution->id }}">{{ $institution->razon_social }} -
                                        {{ $institution->nombre_comercial }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="col-span-12 sm:col-span-1 pt-6">
                            <a wire:click='referencia' class="btn btn-secondary">Añadir</a>
                        </div>
                         --}}

                    </div>
                </div>
                <div class="modal-footer text-right"> <button type="button" wire:click="closeAsignacion" class="btn btn-outline-secondary w-20 mr-1">Cancelar</button> <button type="submit" class="btn btn-primary w-20">Guardar</button> </div> <!-- END: Modal Footer -->

                </form>
            </div>

    </div>
</div>

<!-- END: Modal Content -->

</div>
