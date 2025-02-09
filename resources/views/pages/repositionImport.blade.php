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
                                            <br>
                                            <button type="button" class="btn btn-outline-success btn-sm" data-bind="click: loadExcel()"  > <i class="fas fa-file-excel w-4 h-4 mr-2"></i> Analizar Excel </button>
                                        </h2>


                                        <div data-bind="visible: items().length > 0">
                                            <button type="button" class="btn btn-success btn-sm" data-bind="click: saveItems() "> <i class="fas fa-save w-4 h-4 mr-2"></i> Registrar Reposiciones  </button>
                                        </div>


                                    </div>
                                    <div class="p-5">
                                        <div class="overflow-x-auto">
                                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                            <table class="table">
                                                <thead>
                                                    <tr class="bg-gray-700 dark:bg-dark-1 text-white text-xs ">
                                                        <th class="whitespace-nowrap uppercase" >#</th>
                                                        <th  class="whitespace-nowrap uppercase">N° PAGO</th>
                                                        <th class="whitespace-nowrap uppercase">Empresa</th>
                                                        <th class="whitespace-nowrap uppercase">NIT</th>
                                                        <th class="whitespace-nowrap uppercase">PERIODO</th>
                                                        <th class="whitespace-nowrap uppercase">CONTRATO</th>
                                                        <th  class="whitespace-nowrap uppercase">CUENTA </th>
                                                        <th  class="whitespace-nowrap uppercase">BENEFICIARIO </th>
                                                        <th  class="whitespace-nowrap uppercase">CI </th>
                                                        <th  class="whitespace-nowrap uppercase">FECHA INICIO </th>
                                                        <th  class="whitespace-nowrap uppercase">FECHA FIN </th>
                                                        <th  class="whitespace-nowrap uppercase">MONTO</th>
                                                        <th  class="whitespace-nowrap uppercase">SALARIO BASICO DEL MES  </th>
                                                        <th  class="whitespace-nowrap uppercase">PAQUETE  </th>
                                                        <th  class="whitespace-nowrap uppercase">FECHA INICIO CALCULO </th>
                                                        <th  class="whitespace-nowrap uppercase">FECHA FIN CALCULO </th>
                                                        <th  class="whitespace-nowrap uppercase">DIAS COTIZADOS</th>
                                                        <th  class="whitespace-nowrap uppercase">SALARIO BASICO</th>
                                                        <th  class="whitespace-nowrap uppercase">DESCUENTOS/BONOS </th>
                                                        <th  class="whitespace-nowrap uppercase">LIQUIDO PAGABLE </th>
                                                        <th  class="whitespace-nowrap uppercase">30% S.B. </th>
                                                        <th  class="whitespace-nowrap uppercase">16% S.B. </th>
                                                        <th  class="whitespace-nowrap uppercase">TIPO </th>
                                                        <th  class="whitespace-nowrap uppercase">OBSERVACION</th>
                                                        <th  class="whitespace-nowrap uppercase">MONTO INCENTIVO </th>
                                                        <th></th>

                                                    </tr>
                                                </thead>
                                                <tbody data-bind="foreach: items">

                                                    <tr class="text-xs">
                                                        <td data-bind="text: indice"> </td>
                                                        <td data-bind="text: nro_pago"> </td>
                                                        <td data-bind="text: empresa"> </td>
                                                        <td data-bind="text: nit"> </td>
                                                        <td data-bind="text: periodo"> </td>
                                                        <td data-bind="text: contrato"> </td>
                                                        <td data-bind="text: cuenta"> </td>
                                                        <td data-bind="text: beneficiario"> </td>
                                                        <td data-bind="text: ci"> </td>
                                                        <td data-bind="text: fecha_inicio"> </td>
                                                        <td data-bind="text: fecha_fin"> </td>
                                                        <td data-bind="text: monto"> </td>
                                                        <td data-bind="text: salario_basico_mes"> </td>
                                                        <td data-bind="text: paquete"> </td>
                                                        <td data-bind="text: fecha_inicio_calculo"> </td>
                                                        <td data-bind="text: fecha_fin_calculo"> </td>
                                                        <td data-bind="text: dias_cotizados"> </td>
                                                        <td data-bind="text: salario_basico"> </td>
                                                        <td data-bind="text: descuento_bonificacion"> </td>
                                                        <td data-bind="text: liquido_pagable"> </td>
                                                        <td data-bind="text: primer_sb"> </td>
                                                        <td data-bind="text: segundo_sb"> </td>
                                                        <td data-bind="text: tipo_reposicion"> </td>
                                                        <td data-bind="text: observacion"> </td>
                                                        <td data-bind="text: monto_incentivo"> </td>
                                                        <td > <button type="button" class="btn btn-danger btn-sm" data-bind="click: $parent.removeItem" ><i class="fas fa-trash"></i> </button>   </td>
                                                    </tr>


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
<script defer>
     console.log("Cargando modulo de posiciones")

    var loaded = false

    var viewModel = {
        items: ko.observableArray([]),
        loadExcel()
        {
            if(loaded)
            {

                var excelFile = document.querySelector('#excelFile')
                if(excelFile.value != '' &&  excelFile.value != null)
                {
                    swal("Analizando Excel ...", {
                            button: false,
                            icon: "info"
                        });

                    var formData = new FormData();

                    formData.append('fileExcel',excelFile.files[0])
                    console.log(formData)

                    axios.post('load_excel',formData,{
                        headers: {
                            'Content-type': 'multipart/form-data'
                        }
                    }).then(response => (
                        // console.log(response.data)
                        viewModel.items(response.data.items),
                        swal.close()
                        // console.log(viewModel.items())
                    ))
                }

            }



        },
        removeItem()
        {
            if(loaded)
            {
                viewModel.items.remove(this);
            }
        },
        saveItems: function ()
        {
            if(loaded)
            {
                swal("Registrando Reposiciones ...", {
                            button: false,
                            icon: "info"
                        });
                if(viewModel.items().length > 0)
                {
                    axios.post('save_repositions',{items: JSON.stringify(viewModel.items()) }).then(response => {

                        console.log(response.data)
                        swal("Importacion Exitosa!", response.data.message, "success");
                        viewModel.items([]);

                    })
                }
            }
        }


    }
    ko.applyBindings(viewModel);

    loaded = true


</script>
@endsection
