<!DOCTYPE html>
<html>

<head>
    <title>MPD</title>
    {{-- <link href="{{ asset('/css/pdfhtml.css') }}" rel="stylesheet"> --}}

</head>

<body>
    <div id="header">
        <table>
            <tr>
                <td style="width: 25%;"><img src="img/chacana.png" width="100" /></td>
                <td style="width: 50%;">
                    <p style="text-align: center; font-size: 12pt; font-weight: bold;">Estado Plurinacional de
                        Bolivia<br />Ministerio de Planificaci&oacute;n del Desarrollo</p>
                </td>
                <td style="width: 25%;text-align:right"><img src="img/logoempleo.png" width="200" /></td>
            </tr>
        </table>
    </div>
    <div id="footer">
        www.planificacion.gob.bo<br />
        Av. Mariscal Santa Cruz Esq. Calle Oruro Edif. #1092, Ex Edificio Comibol, Tel&eacute;fono Fax: (591-2) 2189000
    </div>
    <div>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: center; font-size: 12pt; font-weight: bold;">{{ $title }}</td>
            </tr>
            <tr>
                <td style="text-align: right; font-size: 8pt; font-weight: bold;">Fecha:
                    {{ Carbon\Carbon::parse($date)->format('d/m/Y') }}</td>
            </tr>
        </table>
    </div>


    <div>
        <table class="table-info w-100" style="width: 100%;"   >
            <thead class="bg-grey-darker">
                <tr style="background:#E5E7E6;  ">
                    <td class="pa fzt tb" style="text-align: center ; font-weight: bold;" colspan="2">DATOS
                        DE LA EMPRESA</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;"> RAZON SOCIAL</td>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;"> NIT</td>

                </tr>
                <tr>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                        {{ $institution->razon_social }}</td>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                        {{ $institution->nit }}</td>
                </tr>
                <tr>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;"> GRAN ACTIVIDAD
                    </td>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;"> ACTIVIDAD PRINCIPAL</td>


                </tr>
                <tr>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                        {{ $institution->rubro }}</td>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                        {{ $institution->actividad }}</td>

                </tr>
            </tbody>
        </table>
        <br>
        <table style="width: 100%;"   >
            <tr style="background:#E5E7E6;  ">
                <td class="pa fzt tb" style="text-align: center; font-weight: bold;" colspan="2">
                    REPRESENTATE LEGAL</td>
            </tr>
            <tr>
                <td class="tablePaddin fzh" style="text-align: left;font:bold;" colspan="2"> NOMBRE REPRESENTANTE
                </td>

            </tr>
            <tr>
                <td class="tablePaddin fzd" style="text-align: center; border-bottom: 2px solid #E5E7E6;" colspan="2">
                    {{ $institution->nombre }} {{ $institution->paterno }} {{ $institution->materno }}</td>
            </tr>
            <tr>
                <td class="tablePaddin fzh" style="text-align: left;font:bold;"> TELEFONO/CELULAR
                </td>
                <td class="tablePaddin fzh" style="text-align: left;font:bold;"> CORREO</td>


            </tr>
            <tr>
                <td class="tablePaddin fzd"
                    style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                    {{ $institution->telefono }}</td>
                <td class="tablePaddin fzd"
                    style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                    {{ $institution->email }}</td>

            </tr>

        </table>

        <br>
        <table class="tb" style="width: 100%;">
            <tr style="background:#E5E7E6;  ">
                <td class="pa fzt" style="text-align: center;font-weight: bold;" colspan="5">
                    CASA MATRIZ/SUCURSALES</td>
            </tr>
            <tr>
                <td class="pa fzh tb" style="width: 4%; text-align: center;font:bold;"> N°</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> TIPO</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> DEPARTAMENTO</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> DIRECCIÓN</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> TELEFONO/CELULAR</td>
            </tr>
            @foreach ($branchs as $data)
                <tr>
                    <td class="pa fzd tb" style="text-align: center;"> {{ $loop->iteration }}</td>
                    <td class="pa fzd tb" style="text-align: center;">{{ $data->tipo }}</td>
                    <td class="pa fzd tb" style="text-align: center;">{{ $data->department->nombre  }}</td>
                    <td class="pa fzd tb" style="text-align: left;">{{ $data->direccion }}</td>
                    <td class="pa fzd tb" style="text-align: center;">{{ $data->telefono }}</td>
                </tr>
            @endforeach
        </table>
        <br>
        <table class="tb" style="width: 100%;" >

            <tr style="background:#E5E7E6;  ">
                <td class="pa fzt tb" style="text-align: center;font-weight: bold;" colspan="4">
                    REGISTRO DE CONTACTOS</td>
            </tr>
            <tr>
                <td class="pa fzh tb" style="width: 4%;text-align: center;font:bold;"> N°</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> NOMBRE COMPLETO</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> TELEFONO/CELULAR</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> CORREO</td>
            </tr>
            @foreach ($cordinators as $data)
                <tr>
                    <td class="pa fzd tb" style="text-align: center;"> {{ $loop->iteration }}</td>
                    <td class="pa fzd tb" style="text-align: left;">{{ $data->nombres  }} {{ $data->paterno  }} {{ $data->naterno  }}</td>
                    <td class="pa fzd tb" style="text-align: center;">{{ $data->telefono}}</td>
                    <td class="pa fzd tb" style="text-align: center;">{{ $data->email }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <br>
</body>

</html>
