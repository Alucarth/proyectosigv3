<div>
    <div class="box py-8 px-6">
        @include('layout.partials.errors')
        @include('layout.partials.flashMessage')
        <form wire:submit.prevent='addAbility' class="intro-y grid grid-cols-12 gap-2 items-center">
            <div class="col-span-12 sm:col-span-6">
                <label class="form-label">Registra tus habilidades</label>
                
                <input wire:model="habilidad" type="text" class="form-control" placeholder="Soy una persona Proactiva">
            </div>
            <div class="col-span-12 sm:col-span-3 pt-6">
                <button type="submit" class="btn btn-secondary">Guardar</button>
            </div>
        </form>
    </div>

    <div class="box py-8 px-6 mt-3">
        <div class="overflow-x-auto pt-4">
            <table class="table">
                <thead>
                    <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Habilidad</th>
                        <th class="whitespace-nowrap">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($abilities as $index => $abbility)
                        <tr>
                            <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                            <td class="border-b dark:border-dark-5">
                                {{ $abbility->descripcion }}
                            </td>
                            <td class="border-b dark:border-dark-5">
                                <button type="button" wire:click="deleteHabilidad({{$abbility->id}})" class="btn btn-danger btn-sm" >
                                    <i  class="fa fa-trash" ></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a class="btn btn-outline-primary py-3 px-4 xl:w-80 mt-3 xl:mt-2 align-left"
                            href="{{ route('page.dashboard') }}">Finalizar</a>
</div>
