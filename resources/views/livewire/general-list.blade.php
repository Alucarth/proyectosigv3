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
                                <th class="whitespace-nowrap uppercase">Estado </th>
                                <th class="whitespace-nowrap uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{json_encode($persons)}}
                            {{-- @foreach ($officials as $index => $official)
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

                                                <button class="btn btn-sm btn-twitter" wire:click="setOficial({{$official->id}})">  Asignaciones <i class="fas fa-angle-right w-4 h-4 ml-2"></i> </button>
                                                                                          </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach --}}
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
                        {{-- {{$oficial->getFullname()}} --}}
                        Lista Corta

                    </h2>
                    {{-- <button type="button" class="btn btn-primary btn-sm"  wire:click="showAsignacion()">  <i class="fa fa-plus w-4 h-4 mr-2 "></i>  Adicionar </button> --}}

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
                                {{-- @foreach ($assignments as $index => $assignament)
                                    <tr>
                                        <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>

                                        <td class="border-b dark:border-dark-5">{{ $assignament->institution->razon_social  }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $assignament->estado  }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $assignament->user->email  }}</td>

                                        <td class="border-b dark:border-dark-5">
                                            <div class="text-theme-6">
                                                <a wire:click='softdeletedAssignment({{ $assignament->id }})'
                                                    class="flex items-center mr-3 cursor-pointer">
                                                    <x-feathericon-trash class="w-4 h-4 mr-1" /> Dar de Baja
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>


        {{-- end panel asignaciones --}}



    </div>

</div>
