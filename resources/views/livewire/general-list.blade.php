<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="grid grid-cols-12 gap-4 items-center col-span-12 sm:col-span-12">

        {{-- panel lista --}}
        <div class="intro-y box col-span-12 lg:col-span-6">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    <span style="font-size: 2em; color: #C5CAE9;">
                        <i class="fas fa-clipboard-list"></i>
                    </span>
                    Lista General
                    <br>
                    <br>
                    <button type="button" wire:click="generateList()" class="btn btn-outline-success btn-sm"> <i class="fas fa-users-cog w-4 h-4 mr-2"></i> Generar Lista  </button>

                </h2>
                    <br>
                    Vacante : {{$vacancy->nombre}}
                    <br>
                    Grado Academico: {{$vacancy->grado_academico}}
                    <br>
                    Formacion: {{$vacancy->career->nombre}}
                    <br>
                    Salario: {{$vacancy->salario}}



                {{-- <button type="button" class="btn btn-primary btn-sm"  wire:click="showHijo()">  <i class="fa fa-plus w-4 h-4 mr-2 "></i>  Adicionar </button> --}}
                {{-- <button class="btn btn-outline-secondary hidden sm:flex"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file w-4 h-4 mr-2"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> Download Excel </button> --}}
            </div>
            <div class="p-5">
                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    <table class="table">
                        <thead>
                            <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                                <th class="whitespace-nowrap uppercase">#</th>
                                <th class="whitespace-nowrap uppercase">Nombres</th>
                                <th class="whitespace-nowrap uppercase">Apellido Paterno</th>
                                <th class="whitespace-nowrap uppercase">Apellido MAterno</th>
                                {{-- <th class="whitespace-nowrap uppercase">Estado </th> --}}
                                <th class="whitespace-nowrap uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($general_list as $index => $item)

                                    <tr>
                                        <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                                        <td class="border-b dark:border-dark-5 text-gray-700 uppercase">
                                            {{ $item->people->nombres }}
                                        </td>
                                        <td class="border-b dark:border-dark-5 uppercase">
                                            {{ $item->people->paterno }}
                                        </td>
                                        <td class="border-b dark:border-dark-5 uppercase">
                                            {{ $item->people->materno }}
                                        </td>
                                        {{-- <td class="border-b dark:border-dark-5">
                                            {{ $item->estado }}
                                        </td> --}}
                                        <td class="border-b dark:border-dark-5">
                                            <div class="mt-2">

                                                <button class="btn btn-sm btn-twitter" wire:click="addList({{$item->id}})">  Agregar <i class="fas fa-angle-right w-4 h-4 ml-2"></i> </button>
                                                                                          </div>
                                        </td>
                                    </tr>

                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        {{-- final panel --}}

        {{-- panel asignaciones --}}



            <div class="intro-y box col-span-12 lg:col-span-6">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        <span style="font-size: 2em; color: #C5CAE9;">
                            <i class="fas fa-list-ol"></i>
                        </span>
                        Lista Corta
                    </h2>
                </div>
                <div class="p-5">
                    {{-- <strong>Lista de Empresas Asignadas</strong> --}}
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                        <table class="table">
                            <thead>
                                <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                                    <th class="whitespace-nowrap uppercase">#</th>
                                    <th class="whitespace-nowrap uppercase">Nombres</th>
                                    <th class="whitespace-nowrap uppercase">Apellido Paterno</th>
                                    <th class="whitespace-nowrap uppercase">Apellido MAterno</th>
                                    {{-- <th class="whitespace-nowrap uppercase">Estado </th> --}}
                                    <th class="whitespace-nowrap uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($short_list as $index => $item)

                                        <tr>
                                            <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                                            <td class="border-b dark:border-dark-5 text-gray-700 uppercase">
                                                {{ $item->people->nombres }}
                                            </td>
                                            <td class="border-b dark:border-dark-5 uppercase">
                                                {{ $item->people->paterno }}
                                            </td>
                                            <td class="border-b dark:border-dark-5 uppercase">
                                                {{ $item->people->materno }}
                                            </td>
                                            {{-- <td class="border-b dark:border-dark-5">
                                                {{ $item->estado }}
                                            </td> --}}
                                            <td class="border-b dark:border-dark-5">
                                                <div class="mt-2">

                                                    <button class="btn btn-sm btn-secondary" wire:click="removeList({{$item->id}})"> <i class="fas fa-angle-left w-4 h-4 mr-2"></i>  devolver   </button>

                                                    <button class="btn btn-sm btn-danger"> <i class="fas fa-trash w-4 h-4 mr-2"></i>  Eliminar </button>
                                                </div>
                                            </td>
                                        </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        {{-- end panel asignaciones --}}

    </div>
<!-- BEGIN: Modal Content  check event listener-->

<div id="referencia-delete" class="modal overflow-y-auto {{$dialog_delete?'show':'hide'}}" data-backdrop="static" tabindex="-1" aria-hidden="false" style="padding-left: 0px; margin-top: 0px; margin-left: 0px; z-index: 10000;">
    <div class="modal-dialog modal-lg">

            <div class="modal-content"  >

                {{-- <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Registro de Referencia Laboral</h2>


                </div>
                 <!-- END: Modal Header --> --}}
                <div class="modal-body ">
                    <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-gray-600 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                    </div>
                    <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button> <button type="button" class="btn btn-danger w-24">Delete</button> </div>
                </div>
                {{-- <div class="modal-footer text-right"> <button type="button" wire:click="closeReferencia" class="btn btn-outline-secondary w-20 mr-1">Cancelar</button> <button wire:click='referencia' class="btn btn-primary w-20">Guardar</button> </div> <!-- END: Modal Footer --> --}}

            </div>

    </div>
</div>

<!-- END: Modal Content -->
</div>
