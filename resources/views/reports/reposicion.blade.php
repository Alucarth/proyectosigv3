@extends('reports.template')
@section('content')
<table class="w-100 ">
    <tr>
        <th class="w-15 text-left no-padding no-margins align-middle" >
            <img src="{{ public_path('img/logo.png') }}" style=" width: 120px;">
        </th>
        <th class="w-50 align-center text-center">
            <span class="font-semibold uppercase leading-tight " >
                {{ $institution ?? '' }} <br>
                {{-- {{ $direction ?? '  DE BENEFICIOS ECONÓMICOS' }} <br>
                {{ $unit ?? 'UNIDAD DE OTORGACIÓN DE FONDO DE RETIRO POLICIAL, CUOTA MORTUORIA Y AUXILIO MORTUORIO' }} --}}
            </span>
        </th>
        <th class="w-20 no-padding  align-center">

            <img src="{{ public_path('img/logoempleo.png') }}" style=" width: 120px;">
        </th>
    </tr>
    {{-- <tr class="no-border"><td colspan="3" class="no-border" style="border-bottom: 1px solid #22292f;"></td></tr> --}}
    <tr>
        <td colspan="3" class="font-bold text-center text-md uppercase">
            {{ $title }}
            @if (isset($subtitle))
            <br><span class="font-medium">{{ $subtitle ?? '' }}</span>
            @endif
        </td>
    </tr>
    {{-- <tr><td colspan="3"></td></tr>
    <tr><td colspan="3"></td></tr> --}}
 

</table>

<br>
<table class="table-info align-top no-padding no-margins border w-40">
    <tr>
        <td class="text-center bg-grey-darker text-xs text-white w-50 ">Nombre de la empresa:</td>
        <td class="text-xs uppercase">  {{$petition->institution->razon_social}}</td>
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">NIT de la empresa:</td>
        <td class="text-xs uppercase"> {{$petition->institution->nit}} </td>
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Periodo de Reposicion:</td>
        <td class="text-xs uppercase">  </td>
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Beneficiario SIGEP:</td>
        <td class="text-xs uppercase">  </td>
    </tr>

</table>

<br>
<table class="table-info w-100">
    <thead class="bg-grey-darker">
        <tr class="font-medium text-white text-sm">
            <td class="px-15 py text-center text-xxs ">
                Nro.
            </td>
            <td class="px-15 py text-center  text-xxs">
                Nombre del Benefeciario
            </td>
            <td class="px-15 py text-center text-xxs">
                CI del Beneficiario
            </td>
            <td class="px-15 py text-center text-xxs">
                Fecha inicio de contrato
            </td>
            <td class="px-15 py text-center text-xxs">
                Dias Cotizados
            </td>
            <td class="px-15 py text-center text-xxs">
                Salario Basico
            </td>
            <td class="px-15 py text-center text-xxs">
                Descuentos
            </td>
            <td class="px-15 py text-center text-xxs">
                Bonificaciones
            </td>
            <td class="px-15 py text-center text-xxs">
                Salario Asignado
            </td>
            </td>
            <td class="px-15 py text-center text-xxs">
                Paquete
            </td>
            </td>
            <td class="px-15 py text-center text-xxs">
                Total Ganado (Bs)
            </td>
            <td class="px-15 py text-center text-xxs">
                30% al salario basico (Bs)
            </td>
            <td class="px-15 py text-center text-xxs">
                16.71% del salario basico (Bs)
            </td>
            <td class="px-15 py text-center text-xxs">
                Monto del incentivo a transferir (Bs)
            </td>
        </tr>
    </thead>
    <tbody>

        @foreach ($forms as $index => $form)
            <tr class="text-sm">
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $index+=1 }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $form->contract->person->nombres }} {{ $form->contract->person->paterno }} {{ $form->contract->person->materno }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $form->contract->person->ci  }} {{ $form->contract->person->expedido }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{  Carbon\Carbon::parse($form->contract->fecha_inicio, 'UTC')->format('d-m-Y') }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $form->dias }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $form->salario }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $form->descuentos }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $form->bonificaciones }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">  </td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $form->contract->package->porcentaje }}%  {{ $form->contract->package->nombre }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ round(($form->salario / 30) * $form->dias, 2) - $form->descuentos + $form->bonificaciones }} Bs</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3"> 
                    @if ($form->salario > 4000)
                        {{ round((4000 / 30) * $form->dias, 2) }} Bs
                    @else
                        {{ round(($form->salario / 30) * $form->dias, 2) }} Bs
                    @endif
                </td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3"> 
                    @if ($form->salario > 4000)
                        {{ round((4000 / 16.71) * $form->dias, 2) }} Bs
                    @else
                        {{ round(($form->salario / 16.71) * $form->dias, 2) }} Bs
                    @endif
                </td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">  
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
<br>
<br>
<br>
<br>
<table>
    <tr>
        <td class="text-right text-xxs">Elaborado por</td>
        <td class="text-left text-xxs">  .......................................</td>
        <td class="text-right text-xxs">Aprobado por</td>
        <td class="text-left text-xxs">  .......................................</td>
    </tr>

</table>



@endsection