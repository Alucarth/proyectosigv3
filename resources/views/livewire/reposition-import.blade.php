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
                    <input type="file" class="form-control" id="exampleInputName" wire:model="file_name">
                  
                </div>
                <button type="button" wire:click="cargar" class="btn btn-outline-success btn-sm"> <i class="fas fa-file-excel w-4 h-4 mr-2"></i> Analizar Excel </button>
               {{$path}}
            </h2>
            @if(sizeof($items)>0)
            <button type="button" wire:click="save" class="btn btn-success btn-sm"> <i class="fas fa-save w-4 h-4 mr-2"></i> Registrar Reposiciones  </button>
            @endif
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
                            <th  class="whitespace-nowrap uppercase">MONTO INCENTIVO </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as  $index=>$item)
                        <tr>
                            <td>
                                {{$index+1}}
                            </td>
                            <td>{{$item->empresa}}</td>
                            <td>{{$item->nit}}</td>
                            <td>{{$item->periodo}}</td>
                            <td>{{$item->contrato}}</td>
                            <td>{{$item->cuenta}}</td>
                            <td>{{$item->beneficiario}}</td>
                            <td>{{$item->ci}}</td>
                            <td>{{$item->fecha_inicio}}</td>
                            <td>{{$item->fecha_fin}}</td>
                            <td>{{$item->monto}}</td>
                            <td>{{$item->salario_basico}}</td>
                            <td>{{$item->paquete}}</td>
                            <td>{{$item->nro_pago}}</td>
                            <td>{{$item->fecha_inicio_calculo}}</td>
                            <td>{{$item->fecha_inicio_calculo}}</td>
                            <td>{{$item->dias_cotizados}}</td>
                            <td>{{$item->salario_basico_mes}}</td>
                            <td>{{$item->descuento_bonificacion}}</td>
                            <td>{{$item->liquido_pagable}}</td>
                            <td>{{$item->primer_sb}}</td>
                            <td>{{$item->segundo_sb}}</td>
                            <td>{{$item->monto_incentivo}}</td>

                        </tr>
                        @endforeach
                     
                    </tbody>
                </table>
                
            </div>
            </div>
        </div>
    </div>
    {{-- final panel --}}

</div>
