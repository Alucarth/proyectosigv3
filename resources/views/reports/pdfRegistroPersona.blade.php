<!DOCTYPE html>
<html>

<head>
    <title>MPD</title>
    <link href="{{ asset('css/pdfhtml.css') }}" rel="stylesheet">

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
                    <td class="pa fzt tb" style="text-align: center ; font-weight: bold;" colspan="3">DATOS
                        PERSONALES</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;"> NOMBRE(S)</td>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;"> APELLIDO(S)</td>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;">CEDULA DE IDENTIDAD
                    </td>

                </tr>
                <tr>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                        {{ $person->nombres }}</td>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                        {{ $person->paterno }} {{ $person->materno }}</td>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;">{{ $person->ci }}
                        {{ $person->expedido }}</td>
                </tr>
                <tr>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;"> FECHA NACIMIENTO
                    </td>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;"> GÉNERO</td>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;">ESTADO CIVIL</td>

                </tr>
                <tr>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                        {{ Carbon\Carbon::parse($person->nacimiento)->format('d/m/Y') }}</td>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                        {{ $person->genero == 'H' ? 'MASCULINO' : 'FEMENINO' }}</td>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                        {{ $person->estado_civil }}</td>
                </tr>
                <tr>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;"> TELÉFONO/CELULAR
                    </td>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;"> ES
                        PADRE/MADRE?</td>
                    <td class="tablePaddin fzh" style="text-align: left;font:bold;"> PRESENTA ALGUNA DISCAPACIDAD?</td>
                </tr>
                <tr>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                        {{ $person->telefono }}</td>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;" >
                        {{ $person->hijos == true ? 'SI' : 'NO' }}</td>
                    <td class="tablePaddin fzd"
                        style="text-align: left;border-bottom: 2px solid #E5E7E6;" >
                        {{ $person->hijos == true ? 'SI' : 'NO' }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table style="width: 100%;"   >
            <tr style="background:#E5E7E6;  ">
                <td class="pa fzt tb" style="text-align: center; font-weight: bold;" colspan="2">
                    DATOS DE RESIDENCIA</td>
            </tr>
            <tr>
                <td class="tablePaddin fzh" style="width: 33%;text-align: left;font:bold;"> DEPARTAMENTO
                </td>
                <td class="tablePaddin fzh" style="text-align: left; font:bold;"> DIRECCIÓN</td>

            </tr>
            <tr>
                <td class="tablePaddin fzd" style="text-align: left; border-bottom: 2px solid #E5E7E6;">
                    {{ $person->department->nombre }}</td>
                <td class="tablePaddin fzd" style="text-align: left;border-bottom: 2px solid #E5E7E6;">
                    {{ $person->direccion }}</td>
            </tr>

        </table>

        <br>
        <table class="tb" style="width: 100%;">
            <tr style="background:#E5E7E6;  ">
                <td class="pa fzt tb" style="text-align: center;font-weight: bold;" colspan="2">
                    DATOS DE HIJOS DEPENDIENTES</td>
            </tr>
            <tr>
                <td class="pa fzh tb" style="width: 50%;text-align: center;font:bold;"> NOMBRE COMPLETO</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> FECHA DE NACIMIENTO</td>
            </tr>
            @foreach ($decendants as $data)
                <tr>
                    <td class="pa fzd tb" style="text-align: left;"> {{ $data->nombre }}</td>
                    <td class="pa fzd tb" style="text-align: center;">
                        {{ Carbon\Carbon::parse($data->nacimiento)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </table>
        <br>
        <table class="tb" style="width: 100%;">

            <tr style="background:#E5E7E6;  ">
                <td class="pa fzt tb" style="text-align: center;font-weight: bold;" colspan="2">
                    DIFICULTAD LABORAL</td>
            </tr>
            <tr>
                <td class="pa fzh tb" style="width: 50%;text-align: center;font:bold;"> DIFICULTAD</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> DETALLE</td>
            </tr>
            @foreach ($personProblem as $data)
                <tr>
                    <td class="pa fzd tb" style="text-align: left;"> {{ $data->problem->nombre }}</td>
                    <td class="pa fzd tb" style="text-LEFT: center;">{{ $data->detalle }}</td>
                </tr>
            @endforeach
        </table>


        <br>
        <table class="tb" style="width: 100%;">
            <tr style="background:#E5E7E6;  ">
                <td class="pa fzt tb" style="text-align: center;font-weight: bold;" colspan="2">
                    PERSONA DE CONTACTO</td>
            </tr>
            <tr>
                <td class="pa fzh tb" style="width: 50%;text-align: center;font:bold;"> NOMBRE COMPLETO</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> TELEFONO/CELULAR</td>
            </tr>
            @foreach ($contacts as $data)
                <tr>
                    <td class="pa fzd tb" style="text-align: left;"> {{ $data->nombre }} {{ $data->paterno }} {{ $data->materno }}</td>
                    <td class="pa fzd tb" style="text-align: center;">
                        {{ $data->telefono }}</td>
                </tr>
            @endforeach
        </table>

        <br>
        <table class="tb" style="width: 100%;" >
            <tr style="background:#E5E7E6;  ">
                <td class="pa fzt tb" style="text-align: center;font-weight: bold;" colspan="4">
                    FORMACIÓN PROFESIONAL</td>
            </tr>
            <tr>
                <td class="pa fzh tb" style="width: 30%;text-align: center;font:bold;"> INSTITUCIÓN EDUCATIVA</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> CARRERA</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> GRADO ACADEMICO</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> FECHA DE EGRESO</td>
            </tr>
            @foreach ($studies as $data)
                <tr>
                    <td class="pa fzd tb" style="text-align: left;"> {{ $data->institution }} </td>
                    <td class="pa fzd tb" style="text-align: left;"> {{ $data->career->nombre }}</td>
                    <td class="pa fzd tb" style="text-align: left;"> {{ $data->grado_academico }}</td>
                    <td class="pa fzd tb" style="text-align: center;"> {{ Carbon\Carbon::parse($data->egreso)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </table>
        <br>
        <table class="tb" style="width: 100%;">
            <tr style="background:#E5E7E6;  ">
                <td class="pa fzt" style="text-align: center;font-weight: bold;" colspan="4">
                    EXPERIENCIA LABORAL</td>
            </tr>
            <tr>                
                <td class="pa fzh tb" style="width: 30%;text-align: center;font:bold;"> INSTITUCIÓN</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> CARGO</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> INICIO</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> FIN</td>
            </tr>
            @foreach ($experiences as $data)
                <tr>
                    <td class="pa fzd tb" style="text-align: left;"> {{ $data->institution }} </td>
                    <td class="pa fzd tb" style="text-align: left;"> {{ $data->cargo }}</td>                    
                    <td class="pa fzd tb" style="text-align: center;"> {{ Carbon\Carbon::parse($data->fecha_inicio)->format('d/m/Y') }}</td>
                    <td class="pa fzd tb" style="text-align: center;"> {{ Carbon\Carbon::parse($data->fecha_fin)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </table>

        <br>
        <table class="tb" style="width: 100%;" >
            <tr style="background:#E5E7E6;  ">
                <td class="pa fzt tb" style="text-align: center;font-weight: bold;" colspan="3">
                    REFERENCIA LABORALL</td>
            </tr>
            <tr>                
                <td class="pa fzh tb" style="width: 30%;text-align: center;font:bold;"> INSTITUCIÓN</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> NOMBRE CONTACTO</td>
                <td class="pa fzh tb" style="text-align: center;font:bold;"> TELÉFONO/CELULAR</td>                
            </tr>
            @foreach ($contactsLaboral as $data)
                <tr>
                    <td class="pa fzd tb" style="text-align: left;"> {{ $data->institution }}</td> 
                    <td class="pa fzd tb" style="text-align: left;"> {{ $data->nombre }} {{ $data->paterno }} {{ $data->materno }} </td>
                    <td class="pa fzd tb" style="text-align: left;"> {{ $data->telefono }}</td>                                        
                </tr>
            @endforeach
        </table>

    </div>
    <br>
</body>

</html>
