<!DOCTYPE html>
<html>

<head>
    <title>Hi</title>
    <style type="text/css">
        @page {
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            margin-top: 3cm;
            margin-bottom: 2cm;
            font-family: Times;
        }


        #footer {
            position: fixed;
            left: 0;
            right: 0;
            font-size: 0.9em;
        }

        #header {

            position: fixed;
            top: -90px;

        }

        #footer {
            bottom: .1em;
            text-align: center;
            font-size: 0.7em;
        }

        #header table,
        #footer table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        #header td,
        #footer td {
            width: 50%;
        }

        .page-number {
            text-align: center;
        }

        .page-number:before {
            content: " Página "counter(page);
        }

        hr {
            page-break-after: always;
            border: 0;
        }

        table {
            border-collapse: collapse;
            margin-bottom: -.1em;
            border-spacing: 0;
        }

        table td{
            margin: 10px !important;
        }

        #watermark {
            position: fixed;
            top: 20%;
            opacity: .4;
            transform: rotate(-35deg);
            transform-origin: 85% 50%;
            font-size: 65pt;
        }

    </style>
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

    {{-- <p>{{ $date }}</p> --}}
    {{-- <div>
        <table style="width: 100%;">
            <tr>
                <td style="width: 100%; text-align: left; font-size: 9pt;  ">I. RESULTADOS ESPERADOS.
                    (En este ac&aacute;pite, se debe elaborar un informe detallado de actividades realizadas por el
                    servidor p&uacute;blico indicado, para el cumplimiento de los Resultados Esperados que se encuentran
                    registrados en el POAI del puesto).</td>
            </tr>
        </table>
    </div> --}}

    <div>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: center; font-size: 12pt; font-weight: bold;">{{ $title }}</td>
            </tr>
            {{-- <tr>
            <td style="text-align: right; font-size: 10pt; font-weight: bold;">Form. SAP EVD 019</td>
          </tr> --}}
            <tr>
                <td style="text-align: right; font-size: 8pt; font-weight: bold;">Fecha:
                    {{ Carbon\Carbon::parse($date)->format('d/m/Y') }}</td>
            </tr>
        </table>
    </div>


    <div>
        <table style="width: 100%;" border="0">
            <tr style="background:#8D9897; color:floralwhite;">
                <td style="text-align: left ; font-size: 12pt; font-weight: bold;" colspan="3">DATOS PERSONALES</td>
            </tr>
            <tr >
                <td style="text-align: left; font-size: 9pt; font:bold;"> NOMBRE(S)</td>
                <td style="text-align: left; font-size: 9pt;font:bold;"> APELLIDO(S)</td>
                <td style="text-align: left; font-size: 9pt;font:bold;">CEDULA DE IDENTIDAD</td>
                
            </tr>
            <tr >
                <td style="text-align: left; font-size: 11pt;border-bottom: 1px solid #dadada;"> {{ $person->nombres }}</td>
                <td style="text-align: left; font-size: 11pt;border-bottom: 1px solid #dadada;"> {{ $person->paterno }} {{ $person->materno }}</td>
                <td style="text-align: left; font-size: 11pt;border-bottom: 1px solid #dadada;">{{ $person->ci }} {{ $person->expedido }}</td>
            </tr>            
        </table>
    </div>
    <br>
{{--     
    <div>
        <table style="width: 100%;" border="1">
            <tr style="background:#8D9897; color:floralwhite;">
                <td style="text-align: left ; font-size: 12pt; font-weight: bold;" colspan="4">REPRESENTATE LEGAL</td>
            </tr>
            <tr>
                <td style="width: 25%; text-align: left; font-size: 11pt; font:bold;">NOMBRE COMPLETO</td>
                <td style="width: 75%; text-align: left; font-size: 9pt;" colspan="3"> {{ $institution->nombre }}
                    {{ $institution->paterno }} {{ $institution->materno }}</td>
            </tr>
            <tr>
                <td style="width: 25%; text-align: left; font-size: 11pt;font:bold;"> TELEFONO<br>CELULAR</td>
                <td style="width: 33%; text-align: left; font-size: 9pt;"> {{ $institution->telefono }}</td>
                <td style="width: 10%; text-align: left; font-size: 11pt;font:bold;"> CORREO</td>
                <td style="width: 32%; text-align: left; font-size: 9pt;">{{ $institution->email }}</td>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <table style="width: 100%;" border="1">
            <tr style="background:#8D9897; color:floralwhite;">
                <td style="text-align: left ; font-size: 12pt; font-weight: bold;" colspan="5">CASA MATRIZ/SUCURSALES</td>
            </tr>
            <tr style="font-size:11pt;">
                <th style="width: 5%; text-align: center;">N°</th>
                <th style="width: 15%; text-align: center;">TIPO</th>
                <th style="width: 15%; text-align: center;">DEPARTAMENTO</th>
                <th style="width: 45%; text-align: center;">DIRECCIÓN</th>
                <th style="width: 20%; text-align: center;">TELEFONO<br>CELULAR</th>
            </tr>

            @foreach ($branchs as $branch)
                <tr style="font-size:9pt;">
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td style="text-align: left;">{{ $branch->tipo }}</td>
                    <td style="text-align: left;">{{ $branch->department->nombre }}</td>
                    <td style="text-align: left;">{{ $branch->direccion }}</td>
                    <td style="text-align: left;">{{ $branch->telefono }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <br>
    <div>
        <table style="width: 100%;" border="1">
            <tr style="background:#8D9897; color:floralwhite;">
                <td style="text-align: left ; font-size: 12pt; font-weight: bold;" colspan="4">REGISTRO DE CONTACTOS</td>
            </tr>
            <tr style="font-size: 11pt; ">
                <th style="width: 5%; text-align: center;">N°</th>
                <th style="width: 45%; text-align: center;">NOMBRE COMPLETO</th>
                <th style="width: 25%; text-align: center;">TELEFONO<br>CELULAR</th>
                <th style="width: 25%; text-align: center;">CORREO</th>                
            </tr>

            @foreach ($cordinators as $cordinator)
                <tr style="style: font-size: 9pt;">
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td style="text-align: left;">{{ $cordinator->nombres  }} {{ $cordinator->paterno  }} {{ $cordinator->naterno  }}</td>
                    <td style="text-align: left;">{{ $cordinator->telefono}}</td>
                    <td style="text-align: left;">{{ $cordinator->email }}</td>                    
                </tr>
            @endforeach
        </table>
    </div> --}}

</body>

</html>
