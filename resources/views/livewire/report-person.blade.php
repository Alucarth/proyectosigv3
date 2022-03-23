<div>
    {{-- {{ $estadistica }}
    <br>
    {{ $estadistica_edad }}
    <br>
    {{ $estadistica_estado_civil }} --}}
    <div class="box py-5 px-8 sm:py-20 mt-5">
        <canvas id="myChart" width="200" height="200" data ="{{$estadistica}}"></canvas>
    </div>
    <div class="box py-5 px-8 sm:py-20 mt-5">
        <canvas id="chartEdad" width="200" height="200" data ="{{$estadistica_edad}}"></canvas>
    </div>
    <div class="box py-5 px-8 sm:py-20 mt-5">
        <canvas id="chartCivil" width="200" height="200" data ="{{$estadistica_estado_civil}}"></canvas>
    </div>
    <div class="box py-10 px-8 sm:py-20 mt-5">
        <div class="grid grid-cols-12 gap-2 items-center">
            <div class="col-span-12 sm:col-span-3">
                <label class="form-label">Departamento</label>
                <select wire:model="departamento" class="form-select">
                    <option value="">Seleccione un opcion</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->nombre }}</option>
                    @endforeach
                </select>
            </div>
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
            <div class="col-span-12 sm:col-span-3">
                <label class="form-label">Estado</label>
                <select wire:model="estado" class="form-select">
                    <option value="">Seleccione un opcion</option>
                    <option value="REGISTRADO">REGISTRADO</option>
                    <option value="BENEFICIADO">BENEFICIADO</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-3 pt-6">
                <button wire:click='clearReport' class="btn btn-secondary">
                    <x-feathericon-refresh-cw class="w-4 h-4 mr-1" /> Reiniciar
                </button>
            </div>
            <div class="col-span-12 sm:col-span-3 pt-6">
                <button wire:click='exportExcel' class="btn btn-secondary">
                    <x-feathericon-file-text class="w-4 h-4 mr-1" /> Exportar Excel
                </button>
            </div>
        </div>

        <div class="overflow-x-auto mt-4">
            <table class="table">
                <thead>
                    <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Combre Completo</th>
                        <th class="whitespace-nowrap">CI</th>
                        <th class="whitespace-nowrap">Genero</th>
                        <th class="whitespace-nowrap">Es Padre/Madre/Ambos</th>
                        <th class="whitespace-nowrap">Estado Civil</th>
                        <th class="whitespace-nowrap">Fecha de Nacimiento</th>
                        <th class="whitespace-nowrap">Edad</th>
                        <th class="whitespace-nowrap">Departamento</th>
                        <th class="whitespace-nowrap">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($people as $person)
                        <tr>
                            <td class="border-b dark:border-dark-5">{{ $person->id }}</td>
                            <td class="border-b dark:border-dark-5 uppercase">{{ $person->nombres }}
                                {{ $person->paterno }} {{ $person->materno }}</td>
                            <td class="border-b dark:border-dark-5">{{ $person->ci }} {{ $person->expedido }}</td>
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
                                {{ $person->estado_civil }}
                            </td>
                            <td class="border-b dark:border-dark-5">
                                {{ $person->nacimiento }}
                            </td>
                            <td class="border-b dark:border-dark-5">
                                @if (\Carbon\Carbon::parse($person->nacimiento)->age > 35)
                                    <div class="text-theme-6">
                                        {{ $person->edad }}
                                    </div>
                                @else
                                    @if ($person->edad == \Carbon\Carbon::parse($person->nacimiento)->age)
                                        {{ $person->edad }}
                                    @else
                                        <div class="text-theme-6">
                                            {{ $person->edad }}
                                        </div>
                                    @endif
                                @endif
                            </td>
                            <td class="border-b dark:border-dark-5">
                                {{ $person->department->nombre }}
                            </td>
                            <td class="border-b dark:border-dark-5">
                                {{ $person->estado }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $people->links() }}
        </div>
    </div>
</div>

