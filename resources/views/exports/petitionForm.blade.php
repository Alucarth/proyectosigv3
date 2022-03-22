<h3>ANEXO 2: CUADRO DETALLE DE SOLICITUD DE REPOSICIÓN POR SALARIOS</h3>

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
            <th class="whitespace-nowrap uppercase">30% Al Salario basico</th>
            <th class="whitespace-nowrap uppercase">16.71% del salario basico</th>            
            <th class="whitespace-nowrap uppercase">Monto del incentivo a transferir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($forms as $form)
            <tr>
                <td class="border-b dark:border-dark-5 text-center">{{ $form->id }}</td>
                <td class="border-b dark:border-dark-5 text-center uppercase">
                    {{ $form->contract->person->nombres }} {{ $form->contract->person->paterno }}
                    {{ $form->contract->person->materno }}</td>
                <td class="border-b dark:border-dark-5 text-center">{{ $form->contract->person->ci }}
                    {{ $form->contract->person->expedido }}</td>
                <td class="border-b dark:border-dark-5 text-center">
                    {{ \Carbon\Carbon::parse($form->contract->fecha_inicio)->format('d-m-Y') }}</td>
                <td class="border-b dark:border-dark-5 text-center">{{ $form->dias }}</td>
                <td class="border-b dark:border-dark-5 text-center">
                    {{ $form->contract->vacancy->salario }}</td>
                <td class="border-b dark:border-dark-5 text-center">{{ $form->descuentos }}</td>
                <td class="border-b dark:border-dark-5 text-center">{{ $form->bonificaciones }}</td>
                <td class="border-b dark:border-dark-5 text-center">
                    {{ $form->contract->package->porcentaje }} %
                    <br>
                    {{ $form->contract->package->nombre }}
                </td>
                <td class="border-b dark:border-dark-5 text-center">
                    {{ round(($form->contract->vacancy->salario / 30) * $form->dias, 2) - $form->descuentos + $form->bonificaciones }}
                    Bs
                </td>
                <td class="border-b dark:border-dark-5 text-center">
                    @if ($form->contract->vacancy->salario > 4000)
                        {{ round((4000 / 30) * $form->dias, 2) }} Bs
                    @else
                        {{ round(($form->contract->vacancy->salario / 30) * $form->dias, 2) }} Bs
                    @endif
                </td>

                <td class="border-b dark:border-dark-5 text-center">
                    @if ($form->contract->vacancy->salario > 4000)
                        {{ round((4000 / 30) * $form->dias, 2) }} Bs
                    @else
                        {{ round(($form->contract->vacancy->salario / 30) * $form->dias, 2) }} Bs
                    @endif
                </td>

                <td class="border-b dark:border-dark-5 text-center">
                    @if ($form->contract->vacancy->salario > 4000)
                        {{ round((4000 / 16.71) * $form->dias, 2) }} Bs
                    @else
                        {{ round(($form->contract->vacancy->salario / 16.71) * $form->dias, 2) }} Bs
                    @endif
                </td>
                <td class="border-b dark:border-dark-5 text-center">
                    @if ($form->contract->vacancy->salario > 4000)
                        {{ round((4000 / 30) * $form->dias * ($form->contract->package->porcentaje / 100), 2) }}
                        Bs
                    @else
                        {{ round(($form->contract->vacancy->salario / 30) * $form->dias * ($form->contract->package->porcentaje / 100), 2) }}
                        Bs
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
