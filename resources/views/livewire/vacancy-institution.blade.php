<div class="py-2 px-1 sm:py-1">
    <h2 class="text-lg uppercase text-gray-700 text-center font-medium">EMPRESA</h2>
    <h2 class="text-lg uppercase text-gray-700 text-center">{{ $institution->razon_social }}</h2>

    {{-- @include('layout.partials.errors')
    @include('layout.partials.flashMessage') --}}

    <div class="col-span-12 md:col-span-6">
        <div class="box mb-3 p-5">
            <button type="button" wire:click="$toggle('showDivVacancias')" class="btn btn-outline-primary ">
                <span style="font-size: 1em">
                    <i class="fas fa-plus"></i>
                </span> Agregar Vacancia
            </button>
            @if ($showDivVacancias)
                <form wire:submit.prevent='addVacancy' enctype="multipart/form-data"
                    class="intro-y grid grid-cols-12 gap-2 items-center pt-5">
                    <div class="col-span-12 sm:col-span-3">
                        <label class="form-label">Casa Matriz / Sucursales</label>
                        <select wire:model="sucursal" class="form-select">
                            <option value="">Seleccione un opcion</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->tipo }} -
                                    {{ $branch->department->nombre }} - {{ $branch->direccion }}
                                </option>
                            @endforeach
                        </select>
                        @error('sucursal')<small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-3">
                        <label class="form-label">Denominación del cargo</label>
                        <input wire:model='nombreVacacia' type="text" class="form-control" placeholder="">
                        @error('nombreVacacia')<small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-3">
                        <label class="form-label">Grado Académico</label>
                        <select wire:model='gradoAcademico' class="form-select">
                            <option value="">Seleccione un opcion</option>
                            <option>TÉCNICO</option>
                            <option>LICENCIATURA</option>
                            <option>POSGRADO</option>
                        </select>
                        @error('gradoAcademico')<small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-3">
                        <label class="form-label">Area de Formacion</label>
                        <select wire:model="carrera" class="form-select">
                            <option value="">Seleccione un opcion</option>
                            @foreach ($careers as $career)
                                <option value="{{ $career->id }}">{{ $career->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('carrera')<small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-3">
                        <label class="form-label">Descripcion del trabajo</label>
                        <input wire:model='descripcion' type="text" class="form-control" placeholder="">
                        @error('descripcion')<small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-3">
                        <label class="form-label">Salario Mensual</label>
                        <input wire:model='salario' type="text" class="form-control" placeholder="">
                        @error('salario')<small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-3">
                        <label class="form-label">Cantidad de Personal</label>
                        <input wire:model='cantidad' type="number" class="form-control" placeholder="">
                        @error('cantidad')<small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-3 pt-6">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>

            @endif

            <div class="overflow-x-auto pt-4">
                <table class="table intro-y">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Sucursal</th>
                            <th class="whitespace-nowrap">Vacancia</th>
                            <th class="whitespace-nowrap">Descripcion</th>
                            <th class="whitespace-nowrap">Cantidad</th>
                            <th class="whitespace-nowrap">Estado</th>
                            <th class="whitespace-nowrap">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacancies as $vacancy)
                            <tr>
                                <td class="border-b dark:border-dark-5">{{ $vacancy->id }}</td>
                                <td class="border-b dark:border-dark-5">{{ $vacancy->branch->department->nombre }} -
                                    {{ $vacancy->branch->direccion }}</td>
                                <td class="border-b dark:border-dark-5">{{ $vacancy->nombre }}</td>
                                <td class="border-b dark:border-dark-5">{{ $vacancy->descripcion }}</td>
                                <td class="border-b dark:border-dark-5">{{ $vacancy->cantidad }}</td>
                                <td class="border-b dark:border-dark-5">{{ $vacancy->estado }}</td>
                                <td class="border-b dark:border-dark-5">
                                    @if ($vacancy->estado == 'PENDIENTE') {{--   AND $vacancy->estado == 'ACTIVO' --}}
                                        <a wire:click="alertInactiveVacancy({{ $vacancy->id }})"
                                            class="btn btn-danger">Dar de
                                            baja</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <a class="btn btn-outline-primary py-3 px-4 xl:w-80 mt-3 xl:mt-2 align-left"
                                    href="{{ route('page.dashboard') }}">Finalizar</a> --}}
        </div>
    </div>
</div>
