@extends('layout.main')

@section('subhead')
    <title>Importacion de Reposiciones</title>
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
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">

                                </h2>
                            </div>

                            <div>
                                {{-- Success is as dangerous as failure. --}}
                                {{-- panel lista --}}
                                  <div class="intro-y box col-span-12 lg:col-span-6">
                                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                        <h2 class="font-medium text-base mr-auto">
                                            <span style="font-size: 2em; color: #C5CAE9;">
                                                <i class="fas fa-clipboard-list"></i>
                                            </span>
                                            Importar Reposiciones
                                            <br>
                                            <br>

                                            <div class="form-group">
                                                <label for="exampleInputName">Archivo </label>
                                                <input type="file" class="form-control" id="excelFile" >

                                            </div>
                                        </h2>
                                            <button type="button" class="btn btn-outline-success btn-sm" data-bind="click: loadExcel()"  > <i class="fas fa-file-excel w-4 h-4 mr-2"></i> Analizar Excel </button>


                                        <button type="button" class="btn btn-success btn-sm"> <i class="fas fa-save w-4 h-4 mr-2"></i> Registrar Reposiciones  </button>

                                    </div>
                                    <div class="p-5">
                                        <div class="overflow-x-auto">
                                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                            <table class="table">
                                                <thead>
                                                    <tr class="bg-gray-700 dark:bg-dark-1 text-white text-xs ">
                                                        <th class="whitespace-nowrap uppercase">#</th>
                                                        <th class="whitespace-nowrap uppercase">Empresa</th>
                                                        <th class="whitespace-nowrap uppercase">NIT</th>
                                                        <th class="whitespace-nowrap uppercase">PERIODO</th>
                                                        <th class="whitespace-nowrap uppercase">CONTRATO</th>
                                                        <th  class="whitespace-nowrap uppercase">CUENTA </th>
                                                        <th  class="whitespace-nowrap uppercase">BENEFICIARIO </th>
                                                        <th  class="whitespace-nowrap uppercase">CI </th>
                                                        <th  class="whitespace-nowrap uppercase">FECHA INICIO </th>
                                                        <th  class="whitespace-nowrap uppercase">FECHA FIN </th>
                                                        <th  class="whitespace-nowrap uppercase">MONTO TOTAL </th>
                                                        <th  class="whitespace-nowrap uppercase">SALARIO BASICO DEL MES  </th>
                                                        <th  class="whitespace-nowrap uppercase">PAQUETE  </th>
                                                        <th  class="whitespace-nowrap uppercase">NRO PAGO  </th>
                                                        <th  class="whitespace-nowrap uppercase">FECHA INICIO CALCULO </th>
                                                        <th  class="whitespace-nowrap uppercase">FECHA FIN CALCULO </th>
                                                        <th  class="whitespace-nowrap uppercase">DIAS COTIZADOS</th>
                                                        <th  class="whitespace-nowrap uppercase">SALARIO BASICO MES</th>
                                                        <th  class="whitespace-nowrap uppercase">DESCUENTOS/BONOS </th>
                                                        <th  class="whitespace-nowrap uppercase">LIQUIDO PAGABLE </th>
                                                        <th  class="whitespace-nowrap uppercase">30% S.B. </th>
                                                        <th  class="whitespace-nowrap uppercase">16% S.B. </th>
                                                        <th  class="whitespace-nowrap uppercase">TIPO </th>
                                                        <th  class="whitespace-nowrap uppercase">OBSERVACION</th>
                                                        <th  class="whitespace-nowrap uppercase">MONTO INCENTIVO </th>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>
                                            </table>

                                        </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- final panel --}}

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
     console.log("Cargando modulo de posiciones")
    var viewModel = {
        ci: ko.observable(""),
        nombres: ko.observable(""),
        loadExcel()
        {
            var formData = new FormData();
            var excelFile = document.querySelector('#excelFile')
            formData.append('fileExcel',excelFile.files[0])
            console.log(formData)
            axios.post('load_excel',formData,{
                headers: {
                    'Content-type': 'multipart/form-data'
                }
            }).then(response => (
                console.log(response.data)
            ))

        }


    }
    ko.applyBindings(viewModel);

</script>
@endsection
