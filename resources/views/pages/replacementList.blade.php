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
                                            <div id="input-group-3" class="input-group-text"  >CI</div>

                                            <input type="text" class="form-control" placeholder="CI Beneficiario" data-bind="textInput: ci, event:{ keyup: buscarBeneficiario}"  aria-describedby="input-group-3">
                                        </div>
                                        <div class="input-group mt-2 sm:mt-0">
                                            <div id="input-group-4" class="input-group-text">Nombre</div>
                                            <input type="text" class="form-control" placeholder="Nombre Beneficiario" data-bind="textInput: nombres, event:{ keyup: buscarBeneficiario}" aria-describedby="input-group-4">
                                        </div>
                                        <div class="input-group mt-2 sm:mt-0">
                                            <div id="input-group-5" class="input-group-text">Empresa</div>
                                            <input type="text" class="form-control" placeholder="Empresa"  data-bind="textInput: razon_social, event:{ keyup: buscarBeneficiario}" aria-describedby="input-group-5">
                                        </div>
                                        <button type="button" class="btn btn-primary shadow-md " data-bind="click: clickBuscarBeneficiario"  >Buscar</button>
                                        {{-- <button class="btn btn-primary shadow-md "  wire:click="buscar()"> <i class="fa fa-search mr-2 w-32  "></i> Buscar</button> --}}
                                    </div>
                                    {{-- <pre data-bind="text: ko.toJSON(ci, null, 2)"></pre> --}}

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
                                                <th class="whitespace-nowrap">Empresa</th>
                                                <th class="whitespace-nowrap">Periodo</th>
                                                <th class="whitespace-nowrap">Monto</th>
                                                <th class="whitespace-nowrap">Descuentos/Bonos </th>
                                                <th class="whitespace-nowrap">Salario Basico </th>
                                                <th class="whitespace-nowrap">Oficial Operativo </th>
                                                <th class="whitespace-nowrap">Total Ganado </th>
                                            </tr>
                                        </thead>
                                        <tbody data-bind="foreach: reposiciones">

                                            <tr  >
                                                {{-- <td> 1 </td> --}}
                                                <td data-bind="text: nro_pago"> </td>
                                                <td data-bind="text: ci"> </td>
                                                <td data-bind="text: nombres"> </td>
                                                <td data-bind="text: razon_social"> </td>
                                                <td data-bind="text: fecha_periodo"> </td>
                                                <td data-bind="text: monto"> </td>
                                                <td data-bind="text: descuentos_bonos"> </td>
                                                <td data-bind="text: salario_basico"> </td>
                                                <td data-bind="text: email"> </td>
                                                <td data-bind="text: total_ganado"> </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                    <table class="table">

                                        <tbody>
                                            <tr class="bg-gray-700 dark:bg-dark-1 text-white" >
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>

                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>Total <strong data-bind="text: total_repo"></strong></td>
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
        ci: ko.observable(""),
        nombres: ko.observable(""),
        razon_social: ko.observable(""),
        reposiciones: ko.observableArray([]),
        total_repo: ko.observable(""),
        buscarBeneficiario: function(data,event)
        {
            if(event.keyCode == 13 )
            {
                console.log('presionando enter')
                let params =  {
                    params: {
                        ci: viewModel.ci(),
                        nombres: viewModel.nombres(),
                        razon_social: viewModel.razon_social()
                    }
                }
                console.log(params)
                axios.get('/repositions', params)
                .then(function (response) {
                    // handle success
                    console.log(response.data.repositions)
                    viewModel.reposiciones(response.data.repositions)

                    var total = 0;
                    viewModel.reposiciones().forEach(item => {
                        total += parseFloat(item.total_ganado)
                    });

                    viewModel.total_repo(total)
                    console.log(viewModel.total_repo())
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
        },
        clickBuscarBeneficiario()
        {

                console.log('usando buscador generico')
                let params =  {
                    params: {
                        ci: viewModel.ci(),
                        nombres: viewModel.nombres(),
                        razon_social: viewModel.razon_social()
                    }
                }
                console.log(params)
                axios.get('/repositions', params)
                .then(function (response) {
                    // handle success
                    console.log(response.data.repositions)
                    viewModel.reposiciones(response.data.repositions)

                    var total = 0;
                    viewModel.reposiciones().forEach(item => {
                        total += parseFloat(item.total_ganado)
                    });

                    viewModel.total_repo(total)
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
