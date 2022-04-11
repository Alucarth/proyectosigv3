<div>
    @if ($ventana == 1)
        <div class="box py-8 px-6">
            <h1 class="text-xl text-gray-900">Lista de Inserciones   </h1>
            <br>
            <a href="{{url('importar-reposiciones')}}" class="btn btn-outline-success btn-sm" > Importar Reposiciones </a>
           
            <div class="overflow-x-auto mt-6">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Unidad Economica o Empresa</th>
                            <th class="whitespace-nowrap">Solicitud</th>
                            <th class="whitespace-nowrap">Fecha</th>
                            <th class="whitespace-nowrap">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petitions as $petition)
                            <tr>
                                <td class="border-b dark:border-dark-5">{{ $petition->id }}</td>
                                <td class="border-b dark:border-dark-5 text-gray-700 uppercase">
                                    {{ $petition->institution->nombre_comercial }}
                                    <br>
                                    <span class="text-gray-600">
                                        {{ $petition->institution->razon_social }}
                                    </span>
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    {{ $petition->titulo }}
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    {{ \Carbon\Carbon::parse($petition->updated_at)->format('d-m-Y') }}
                                </td>
                                <td class="border-b dark:border-dark-5">
                                    <div class="mt-2">
                                        <div class="form-check">
                                            <input wire:model='petition_id' class="form-check-switch" type="checkbox"
                                                value="{{ $petition->id }}">
                                            <label class="form-check-label">
                                                Verificar
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if ($ventana == 2)
        <div class="box py-8 px-6 mt-4">
            <div class="overflow-x-auto pt-4">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="whitespace-nowrap uppercase">#</th>
                            <th class="whitespace-nowrap uppercase">Nombre del Beneficiario</th>
                            <th class="whitespace-nowrap uppercase">Ci del Beneficiario</th>
                            <th class="whitespace-nowrap uppercase">Fecha inicio de contrato</th>
                            <th class="whitespace-nowrap uppercase">dias</th>
                            <th class="whitespace-nowrap uppercase">Salario</th>
                            <th class="whitespace-nowrap uppercase">Descuentos</th>
                            <th class="whitespace-nowrap uppercase">Bonificaciones</th>
                            <th class="whitespace-nowrap uppercase">paquete</th>
                            <th class="whitespace-nowrap uppercase">total Ganado</th>
                            <th class="whitespace-nowrap uppercase">total Convenio</th>
                            <th class="whitespace-nowrap uppercase">Reposición</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petition->forms as $form)
                            <tr>
                                <td class="border-b dark:border-dark-5 text-center">{{ $form->id }}</td>
                                <td class="border-b dark:border-dark-5 text-center uppercase">
                                    {{ $form->contract->person->nombres }} {{ $form->contract->person->paterno }}
                                    {{ $form->contract->person->materno }}</td>
                                <td class="border-b dark:border-dark-5 text-center">{{ $form->contract->person->ci }}
                                    {{ $form->contract->person->expedido }}</td>
                                <td class="border-b dark:border-dark-5 text-center">
                                    {{  \Carbon\Carbon::parse($form->contract->fecha_inicio)->format('d-m-Y') }}</td>
                                <td class="border-b dark:border-dark-5 text-center">{{ $form->dias }}</td>
                                <td class="border-b dark:border-dark-5 text-center">
                                    {{ $form->salario }}</td>
                                <td class="border-b dark:border-dark-5 text-center">{{ $form->descuentos }}</td>
                                <td class="border-b dark:border-dark-5 text-center">{{ $form->bonificaciones }}</td>
                                <td class="border-b dark:border-dark-5 text-center">
                                    {{ $form->contract->package->porcentaje }} %
                                    <br>
                                    {{ $form->contract->package->nombre }}
                                </td>
                                <td class="border-b dark:border-dark-5 text-center">
                                    {{ round(($form->salario / 30) * $form->dias, 2) - $form->descuentos + $form->bonificaciones }}
                                    Bs
                                </td>
                                <td class="border-b dark:border-dark-5 text-center">
                                    @if ($form->salario > 4000)
                                        {{ round((4000 / 30) * $form->dias, 2) }} Bs
                                    @else
                                        {{ round(($form->salario / 30) * $form->dias, 2) }} Bs
                                    @endif
                                </td>
                                <td class="border-b dark:border-dark-5 text-center">
                                    @if ($form->salario > 4000)
                                        {{ round((4000 / 30) * $form->dias * ($form->contract->package->porcentaje / 100), 2) }}
                                        Bs
                                    @else
                                        {{ round(($form->salario / 30) * $form->dias * ($form->contract->package->porcentaje / 100), 2) }}
                                        Bs
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <h3 class="text-2xl font-medium leading-none mt-3 uppercase"> Total reposición: {{ $suma }}
                <span class="capitalize">Bs</span>
            </h3>
        </div>
    @endif
</div>
