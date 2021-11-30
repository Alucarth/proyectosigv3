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
                            <th class="whitespace-nowrap uppercase">#</th>
                            <th class="whitespace-nowrap uppercase">Entidad Económica</th>
                            <th class="whitespace-nowrap uppercase">Departamento</th>
                            <th class="whitespace-nowrap uppercase">Denominación del Cargo</th>
                            <th class="whitespace-nowrap uppercase">Personal Requerido</th>
                            <th class="whitespace-nowrap uppercase">Acciones</th>
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
                                    {{ $vacancy->branch->department->nombre }}
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    {{ $vacancy->nombre }}
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    {{ $vacancy->cantidad }}
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    <!--<a wire:click='searchPeople({{ $vacancy->id }})'
                                        class="flex items-center mr-3 cursor-pointer">
                                        <x-feathericon-file-text class="w-4 h-4 mr-1" /> Generar Lista
                                    </a>-->
                                    @if ($vacancy->payrolls()->where('estado', 'ACTIVO')->count() == 3)
                                        <div class="mt-2">
                                            <div class="form-check">
                                                <input wire:model='ver' class="form-check-switch" type="checkbox"
                                                    value="{{ $vacancy->id }}">
                                                <label class="form-check-label">
                                                    Ver Lista
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="mt-2">
                                            <div class="form-check">
                                                <input wire:model='vacancia_id' class="form-check-switch"
                                                    type="checkbox" value="{{ $vacancy->id }}">
                                                <label class="form-check-label">
                                                    Generar Lista
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if ($ventana == 2)

        <div class="box grid grid-cols-12 gap-4 items-center py-8 px-6">
            <h1 class="col-span-12 text-xl font-medium leading-none mt-3 text-center">
                {{ $vacancia->institution->nombre_comercial }}</h1>
            <h1 class="col-span-12 text-xl font-medium leading-none mt-3 text-center">
                {{ $vacancia->institution->razon_social }}</h1>
            <div class="col-span-12 md:col-span-3 mt-8">
                <h1 class="text-lg font-medium leading-none mt-3 text-center">Casa Matriz / Sucursal</h1>
                <br>
                <h1 class="font-medium leading-none mt-3">{{ $vacancia->branch->department->nombre }}</h1>
                <br>
                <h1 class="font-medium leading-none">{{ $vacancia->branch->direccion }}</h1>
            </div>
            <div class="col-span-12 md:col-span-3 mt-8">
                <h1 class="text-lg font-medium leading-none mt-3 text-center">Denominacion del cargo</h1>
                <br>
                <h1 class="font-medium leading-none mt-3">{{ $vacancia->nombre }}</h1>
                <br>
                <h1 class="font-medium leading-none">{{ $vacancia->descripcion }}</h1>
            </div>
            <div class="col-span-12 md:col-span-3 mt-8">
                <h1 class="text-lg font-medium leading-none mt-3 text-center">Perfil</h1>
                <br>
                <h1 class="font-medium leading-none mt-3">{{ $vacancia->grado_academico }}</h1>
                <br>
                <br>
            </div>
            <div class="col-span-12 md:col-span-3 mt-8">
                <h1 class="text-lg font-medium leading-none mt-3 text-center">Area de formacion</h1>
                <br>
                <h1 class="font-medium leading-none mt-3">{{ $vacancia->career->nombre }}</h1>
                <br>
                <br>
            </div>
        </div>

        <div class="box gird gird-cols-12 flex gap-4 items-center mt-2 py-4 px-6">
            <div class="col-span-12 sm:col-span-3">
                <label class="form-label">Genero</label>
                <select wire:model="genero" class="form-select">
                    <option value="">Seleccione un opcion</option>
                    <option value="M">Femenino</option>
                    <option value="H">Masculino</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-3">
                <label class="form-label">Estado Civil</label>
                <select wire:model='estadoCivil' class="form-select">
                    <option value="">Seleccione un opcion</option>
                    <option>Soltero</option>
                    <option>Casado</option>
                    <option>Viudo</option>
                    <option>Divorciado</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-3">
                <label class="form-label">Es Padre/Madre/Ambos</label>
                <select wire:model="hijo" class="form-select">
                    <option value="">Seleccione un opcion</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>            
            <div class="col-span-12 sm:col-span-3 pt-6">
                <button wire:click='clearList' class="btn btn-secondary">
                    <x-feathericon-refresh-cw class="w-4 h-4 mr-1" /> Reiniciar
                </button>
            </div>
        </div>

        <div class="box mt-2 py-8 px-6">
            <h1 class="text-lg font-medium leading-none mt-3 text-center">Posibles Beneficiarios</h1>
            <div class="overflow-x-auto mt-6">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Nombre Completo</th>
                            <th class="whitespace-nowrap">Departamento</th>
                            <th class="whitespace-nowrap">Estado Civil</th>
                            <th class="whitespace-nowrap">Genero</th>
                            <th class="whitespace-nowrap">Es Padre/Madre/Ambos</th>
                            <th class="whitespace-nowrap">Formacion</th>
                            <th class="whitespace-nowrap">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($people as $person)
                            <tr>
                                <td class="border-b dark:border-dark-5">{{ $person->id }}</td>
                                <td class="border-b dark:border-dark-5 text-gray-700 uppercase">
                                    {{ $person->nombres }} {{ $person->paterno }} {{ $person->materno }}
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    {{ $person->department->nombre }}
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    {{ $person->estado_civil }}
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    @if ($person->genero == 'M')
                                        Femenino
                                    @else
                                        Masculino
                                    @endif
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    @if ($person->hijos == 1)
                                        Si
                                    @else
                                        No
                                    @endif
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    <ul>
                                        @foreach ($person->careers as $career)
                                            <li>
                                                {{ $career->nombre }}
                                                <a class="flex cursor-pointer"
                                                    wire:click="downloadFile({{ $career->id }}, {{ $person->id }})">
                                                    <x-feathericon-hard-drive class="w-4 h-4 mr-2" /> Descargar
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    <a wire:click='addPayroll({{ $person->id }})'
                                        class="flex items-center mr-3 cursor-pointer">
                                        <x-feathericon-plus-circle class="w-4 h-4 mr-1" /> Agregar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $people->links() }}
            </div>
            <a class="btn btn-outline-primary py-3 px-4 xl:w-80 mt-3 xl:mt-2 align-left"
            href="{{ route('page.dashboard') }}">Finalizar</a>
        </div>
    @endif
    @if ($ventana == 3)
        <div class="box mt-2 py-8 px-6">
            <h1 class="text-lg font-medium leading-none mt-3 text-center">Lista Corta</h1>
            <!-- <button wire:click='downloadPDF' class="btn btn-secondary">
                <x-feathericon-refresh-cw class="w-4 h-4 mr-1" /> Exportar a PDF
            </button> -->
            <div class="overflow-x-auto mt-6">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Vacancia</th>
                            <th class="whitespace-nowrap">Nombre completo</th>
                            <th class="whitespace-nowrap">Estado</th>
                            <th class="whitespace-nowrap">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listacorta as $lista)
                            @if ($lista->estado == 'PENDIENTE') {{--  @if ($lista->estado == 'ACTIVO')  --}}
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $lista->id }}</td>
                                    <td class="border-b dark:border-dark-5">
                                        {{ $lista->vacancy->nombre }}
                                    </td>
                                    <td class="border-b dark:border-dark-5 text-gray-700 uppercase">
                                        {{ $lista->person->nombres }} {{ $lista->person->paterno }}
                                        {{ $lista->person->materno }}
                                    </td>
                                    <td class="border-b dark:border-dark-5">
                                        {{ $lista->estado }}
                                    </td>
                                    <td class="border-b dark:border-dark-5">
                                        <div class="text-theme-6">
                                            <a wire:click='removePayroll({{ $lista->id }})'
                                                class="flex items-center mr-3 cursor-pointer">
                                                <x-feathericon-trash class="w-4 h-4 mr-1" /> Quitar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a class="btn btn-outline-primary py-3 px-4 xl:w-80 mt-3 xl:mt-2 align-left"
            href="{{ route('page.dashboard') }}">Finalizar</a>
        </div>
    @endif
</div>
