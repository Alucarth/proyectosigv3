<div>

        <div class="box py-8 px-6">
            <h1 class="text-xl text-gray-900"> Reposiciones </h1>
            <br>

            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <div class="sm:grid grid-cols-3 gap-2">
                    <div class="input-group">
                        <div id="input-group-3" class="input-group-text">CI</div>
                        <input type="text" class="form-control" placeholder="CI Beneficiario"  wire:model="ci" aria-describedby="input-group-3">
                    </div>
                    <div class="input-group mt-2 sm:mt-0">
                        <div id="input-group-4" class="input-group-text">Nombre</div>
                        <input type="text" class="form-control" placeholder="Nombre Beneficiario" wire:model="beneficiario" aria-describedby="input-group-4">
                    </div>
                    <div class="input-group mt-2 sm:mt-0">
                        <div id="input-group-5" class="input-group-text">Empresa</div>
                        <input type="text" class="form-control" placeholder="Empresa" wire:model="empresa"  aria-describedby="input-group-5">
                    </div>
                    <button class="btn btn-primary shadow-md "  wire:click="buscar()"> <i class="fa fa-search mr-2 w-32  "></i> Buscar</button>
                </div>


                <div class="hidden md:block mx-auto text-slate-500"></div>
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

                    <a href="{{url('importar-reposiciones')}}" class="btn btn-outline-success btn-sm" > Importar Reposiciones </a>

                </div>
                {{json_encode($replacement)}}
            </div>

            <div class="overflow-x-auto mt-6">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">CI</th>
                            <th class="whitespace-nowrap">Nombre</th>
                            <th class="whitespace-nowrap">Periodo</th>
                            <th class="whitespace-nowrap">Nro Pago</th>
                            <th class="whitespace-nowrap">Monto</th>
                            <th class="whitespace-nowrap">Descuentos/Bonos </th>
                            <th class="whitespace-nowrap">Salario Basico </th>
                            <th class="whitespace-nowrap">Oficial Operativo </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>


</div>
