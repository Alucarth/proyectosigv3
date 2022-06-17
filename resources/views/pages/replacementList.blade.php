@extends('layout.main')

@section('subhead')
    <title>Dashboard - Rubick - Tailwind HTML Admin Template</title>
@endsection

@section('content')
    @include('layout.components.mobil-menu')
    <div class="flex">
        @include('layout.components.side-menu')
        <div class="content">
            @include('layout.components.top-bar')
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 xxl:col-span-12">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 mt-8">
                            {{-- <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    Reposiciones
                                </h2>
                            </div> --}}
                            <div class="box py-8 px-6">
                                <h1 class="text-xl text-gray-900"> Reposiciones </h1>
                                <br>

                                <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">

                                    <div class="sm:grid grid-cols-3 gap-2">
                                        <div class="input-group">
                                            <div id="input-group-3" class="input-group-text">CI</div>
                                            <input type="text" class="form-control" placeholder="CI Beneficiario"   aria-describedby="input-group-3">
                                        </div>
                                        <div class="input-group mt-2 sm:mt-0">
                                            <div id="input-group-4" class="input-group-text">Nombre</div>
                                            <input type="text" class="form-control" placeholder="Nombre Beneficiario"  aria-describedby="input-group-4">
                                        </div>
                                        <div class="input-group mt-2 sm:mt-0">
                                            <div id="input-group-5" class="input-group-text">Empresa</div>
                                            <input type="text" class="form-control" placeholder="Empresa"   aria-describedby="input-group-5">
                                        </div>
                                        <button type="button" class="btn btn-primary shadow-md " data-bind="click: buscarBeneficiario()"  >Buscar</button>
                                        {{-- <button class="btn btn-primary shadow-md "  wire:click="buscar()"> <i class="fa fa-search mr-2 w-32  "></i> Buscar</button> --}}
                                    </div>


                                    <div class="hidden md:block mx-auto text-slate-500"></div>
                                    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

                                        <a href="{{url('importar-reposiciones')}}" class="btn btn-outline-success btn-sm" > Importar Reposiciones </a>

                                    </div>

                                </div>

                                <div class="overflow-x-auto mt-6">
                                    <table class="table">
                                        <thead>
                                            <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                                                {{-- <th class="whitespace-nowrap">#</th> --}}
                                                <th class="whitespace-nowrap">Nro Pago</th>
                                                <th class="whitespace-nowrap">CI</th>
                                                <th class="whitespace-nowrap">Nombre</th>
                                                <th class="whitespace-nowrap">Periodo</th>
                                                <th class="whitespace-nowrap">Monto</th>
                                                <th class="whitespace-nowrap">Descuentos/Bonos </th>
                                                <th class="whitespace-nowrap">Salario Basico </th>
                                                <th class="whitespace-nowrap">Oficial Operativo </th>
                                            </tr>
                                        </thead>
                                        <tbody data-bind="foreach: reposiciones">

                                            <tr >
                                                {{-- <td> 1 </td> --}}
                                                <td data-bind="text: nro_pago"> </td>
                                                <td data-bind="text: ci"> </td>
                                                <td data-bind="text: nombres"> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    console.log("haber si funciona")
    var viewModel = {
        ci: ko.observable(),
        beneficiario: ko.observable(),
        reposiciones: ko.observableArray([]),
        buscarBeneficiario: function(){
            axios.get('/repositions')
            .then(function (response) {
                // handle success
                console.log(response.data.repositions)
                viewModel.reposiciones(response.data.repositions)
                // response.data.repositions.forEach(item => {
                //     viewModel.reposiciones.push(item)

                // });
                console.log(viewModel.reposiciones());
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        }
    }
    ko.applyBindings(viewModel);



</script>

@endsection
