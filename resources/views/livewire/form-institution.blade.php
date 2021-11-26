<div class="py-2 px-1 sm:py-1">
    <h2 class="text-lg uppercase text-gray-700 text-center font-medium">EMPRESA</h2>
    <h2 class="text-lg uppercase text-gray-700 text-center">{{ $institution->razon_social }}</h2>
    {{-- @include('layout.partials.errors') --}}
    {{-- @include('layout.partials.flashMessage') --}}


    <div class="col-span-12 md:col-span-6">
        <div class="box mb-3">
            <div
                class="flex flex-col lg:flex-row items-center  pl-5 pt-2 pb-2 border-b border-gray-400 dark:border-dark-5">
                <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                    <span style="font-size: 3em; color: #FAC428;">
                        <i class="fas fa-edit"></i>
                    </span>
                </div>
                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                    <div class="font-medium text-base">Datos Generales</div>
                    <div class="text-gray-600">Complete la información solicitada</div>
                </div>
            </div>

            <div class="text-center lg:text-left p-5 ">
                <form wire:submit.prevent='updateInstitution' enctype="multipart/form-data"
                    class="grid grid-cols-12 gap-2 items-center">


                    <div class="col-span-12 sm:col-span-6">
                        
                            <div class="col-span-12 sm:col-span-12 pb-3">
                                <label class="form-label">Gran Actividad:</label>
                                <input wire:model='rubro' type="text" class="form-control" placeholder="">
                                @error('rubro') <small
                                        class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label class="form-label">Actividad Principal:</label>
                                <input wire:model='actividad' type="text" class="form-control" placeholder="">
                                @error('actividad') <small
                                        class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                                @enderror
                            </div>
                        
                    </div>

                    <div class="col-span-12 sm:col-span-4">
                        <label class="form-label">Subir respaldo de NIT</label>
                        @if ($showFileNit)
                            <div class="mt-1">
                                <div class="mt-1">
                                    <div class="border-2 border-dashed dark:border-dark-5 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div class="w-10 h-10 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                {{-- <img class="rounded-md" alt="Rubick Tailwind HTML Admin Template" src=""> --}}
                                                <a href="/storage/{{ $file_nit }}" target="_blank"><span
                                                        style="font-size: 3em; color: #E4E7DF;">
                                                        <i class="fas fa-file"></i>
                                                    </span></a>
                                                <div wire:click="eliminarArchivoNit" title="Eliminar Archivo?"
                                                    class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                                                    <i class="fas fa-times w-4 h-4"></i>
                                                </div>
                                            </div>
                                            Archivo NIT Digital.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <input wire:model='archivoNit' type="file" class="form-control">
                        @endif
                    
                        @error('archivoNit') <small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div
                        class="col-span-12 sm:col-span-12 flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="col-span-12 md:col-span-6">
        <div class="box mb-5">
            <div
                class="flex flex-col lg:flex-row items-center pl-5 pt-2 pb-2 border-b border-gray-400 dark:border-dark-5 ">
                <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                    <span style="font-size: 3em; color: #FAC428;">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                    <div class="font-medium text-base">Representante Legal</div>
                    <div class="text-gray-600">Complete la información solicitada</div>
                </div>
            </div>

            <div class="text-center lg:text-left p-5">
                <form wire:submit.prevent='updateLegalRepresentative' enctype="multipart/form-data"
                    class="grid grid-cols-12 gap-2 items-center">
                    <div class="col-span-12 sm:col-span-4">
                        <label class="form-label">Nombres</label>
                        <input wire:model='nombreRepresentante' type="text" class="form-control" placeholder="">
                        @error('nombreRepresentante') <small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <label class="form-label">Apellido Paterno</label>
                        <input wire:model='paternoRepresentante' type="text" class="form-control" placeholder="">
                        @error('paternoRepresentante') <small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <label class="form-label">Apellido Materno</label>
                        <input wire:model='maternoRepresentante' type="text" class="form-control" placeholder="">
                        @error('maternoRepresentante') <small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label class="form-label">Teléfono / Celular</label>
                        <input wire:model='telefonoRepresentante' type="text" class="form-control" placeholder="">
                        @error('telefonoRepresentante') <small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label class="form-label">Correo</label>
                        <input wire:model='emailRepresentante' type="text" class="form-control" placeholder="">
                        @error('emailRepresentante') <small
                                class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                        @enderror
                    </div>
                    <div
                        class="col-span-12 sm:col-span-12 flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class=" col-span-12 md:col-span-6">
        <div class="box mb-5">
            <div
                class="flex flex-col lg:flex-row items-center pl-5 pt-2 pb-2 border-b border-gray-400 dark:border-dark-5 ">
                <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                    <span style="font-size: 3em; color: #FAC428;">
                        <i class="fas fa-home"></i>
                    </span>
                </div>
                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                    <div class="font-medium text-base">Registro de Casa Matriz y Sucursales</div>
                    <div class="text-gray-600">Complete la información solicitada</div>
                </div>
            </div>

            <div class="text-center lg:text-left p-5">
                <button type="button" wire:click="$toggle('showDivSucursal')" class="btn btn-outline-primary ">
                    <span style="font-size: 1em">
                        <i class="fas fa-plus"></i>
                    </span> Agregar Sucursal
                </button>
                @if ($showDivSucursal)
                    <div class="pt-5">
                        <form wire:submit.prevent='addBranch' class="grid grid-cols-12 gap-2 items-center">
                            <div class="col-span-12 sm:col-span-4">
                                <label class="form-label">Tipo</label>
                                <select wire:model="tipo" class="form-select">
                                    <option value="">SELECCIONE UN OPCION</option>
                                    <option value="CASA MATRIZ" @if (old('tipo') == 'CASA MATRIZ') {{ 'selected' }} @endif>CASA MATRIZ</option>
                                    <option value="SUCURSAL" @if (old('tipo') == 'SUCURSAL') {{ 'selected' }} @endif>SUCURSAL</option>
                                </select>
                                @error('tipo') <small
                                        class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="col-span-12 sm:col-span-4">
                                <label class="form-label">Departamento</label>
                                <select wire:model="departamento" class="form-select">
                                    <option value="">SELECCIONE UN OPCION</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('departamento') <small
                                        class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-4">
                                <label class="form-label">Dirección</label>
                                <input wire:model='direccion' type="text" class="form-control" placeholder="">
                                @error('direccion') <small
                                        class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-4">
                                <label class="form-label">Teléfono / Celular</label>
                                <input wire:model='telefono' type="text" class="form-control" placeholder="">
                                @error('telefono') <small
                                        class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-4 pt-6">
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </div>
                @endif


                <div class="overflow-x-auto pt-4">
                    <table class="table">
                        <thead>
                            <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                                <th class="whitespace-nowrap">#</th>
                                <th class="whitespace-nowrap">Tipo</th>
                                <th class="whitespace-nowrap">Departamento</th>
                                <th class="whitespace-nowrap">Dirección</th>
                                <th class="whitespace-nowrap">Teléfono / Celular</th>
                                <th class="whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branchs as $branch)
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $branch->id }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $branch->tipo }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $branch->department->nombre }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $branch->direccion }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $branch->telefono }}</td>
                                    <td>
                                        <button wire:click="deleteBranch({{ $branch->id }})"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $branchs->links() }}
                </div>

            </div>
        </div>
    </div>


    <div class=" col-span-12 md:col-span-6">
        <div class="box">
            <div
                class="flex flex-col lg:flex-row items-center pl-5 pt-2 pb-2 border-b border-gray-400 dark:border-dark-5 ">
                <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                    <span style="font-size: 3em; color: #FAC428;">
                        <i class="fas fa-address-book"></i>
                    </span>
                </div>
                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                    <div class="font-medium text-base">Registro de Contactos</div>
                    <div class="text-gray-600">Complete la información solicitada</div>
                </div>
            </div>

            <div class="text-center lg:text-left p-5">
                <button type="button" wire:click="$toggle('showDivContacto')" class="btn btn-outline-primary ">
                    <span style="font-size: 1em">
                        <i class="fas fa-plus"></i>
                    </span> Agregar Contacto
                </button>
                @if ($showDivContacto)
                    <div class="pt-5">
                        <form wire:submit.prevent='addCoordinator' class="grid grid-cols-12 gap-2 items-center">
                            <div class="col-span-12 sm:col-span-3">
                                <label class="form-label">Nombres</label>
                                <input wire:model='nombresEnlace' type="text" class="form-control" placeholder="">
                                @error('nombresEnlace') <small
                                        class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-3">
                                <label class="form-label">Apellido Paterno</label>
                                <input wire:model='paternoEnlace' type="text" class="form-control" placeholder="">
                                @error('paternoEnlace') <small
                                        class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-3">
                                <label class="form-label">Apellido Materno</label>
                                <input wire:model='maternoEnlace' type="text" class="form-control" placeholder="">
                                @error('maternoEnlace') <small
                                        class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-3">
                                <label class="form-label">Teléfono / Celular</label>
                                <input wire:model='telefonoEnlace' type="text" class="form-control" placeholder="">
                                @error('telefonoEnlace') <small
                                        class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-3">
                                <label class="form-label">Correo</label>
                                <input wire:model='correoEnlace' type="text" class="form-control" placeholder="">
                                @error('correoEnlace') <small
                                        class="intro-x sm:ml-auto mt-1 sm:mt-0 text-theme-6 block ">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-3 pt-6">
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </div>
                @endif

                <div class="overflow-x-auto pt-4">
                    <table class="table">
                        <thead>
                            <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                                <th class="whitespace-nowrap">#</th>
                                <th class="whitespace-nowrap">Nombre Completo</th>
                                <th class="whitespace-nowrap">Teléfono / Celular</th>
                                <th class="whitespace-nowrap">Correo</th>
                                <th class="whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coordinators as $coordinator)
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $coordinator->id }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $coordinator->nombres }}
                                        {{ $coordinator->paterno }} {{ $coordinator->materno }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $coordinator->telefono }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $coordinator->email }}</td>
                                    <td>
                                        <button wire:click="deleteCoordinator({{ $coordinator->id }})"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $coordinators->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12 sm:col-span-12 flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
        {{-- <a class="btn btn-outline-primary py-3 px-4 xl:w-80 mt-3 xl:mt-2 align-left"
            href="{{ route('page.dashboard') }}">Concluir Registro</a> --}}
        <a wire:click="alertSuccess" class="btn btn-outline-primary py-3 px-4 xl:w-80 mt-3 xl:mt-2 align-left"
            href="#">Concluir Registro</a>
    </div>
</div>
