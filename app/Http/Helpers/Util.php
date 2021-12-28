<?php

// namespace App\Helpers;

use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Util
{
    public static $PIE = 1;
    public static $MILIMETRO = 2;
    public static $CENTIMETRO = 3;
    public static $METRO = 4;

    public static function calculateYear($birthday)
    {
        $age = strtotime($birthday);

        if($age === false){
            return false;
        }

        list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age));

        $now = strtotime("now");

        list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now));

        $age = $y2 - $y1;

        if((int)($m2.$d2) < (int)($m1.$d1))
            $age -= 1;
        return $age;
    }

    public static function SendMailWelcome($usermail)
    {

        try {

            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;  // Sacar esta línea para no mostrar salida debug
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST', 'mail.planificacion.gob.bo');  // Host de conexión SMTP
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME','planificacion\registro.pge');                 // Usuario SMTP
            $mail->Password = env('MAIL_PASSWORD','Pl%4n21***');                           // Password SMTP
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');                            // Activar seguridad TLS
            $mail->Port = env('MAIL_PORT', 587);
            $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
            );
            // Puerto SMTP

            #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
            #$mail->SMTPSecure = false;             // Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
            #$mail->SMTPAutoTLS = false;            // Descomentar si se requiere desactivar completamente TLS (sin cifrado)

            $mail->setFrom('registro.pge@planificacion.gob.bo');        // Mail del remitente
            $mail->addAddress($usermail);     // Mail del destinatario

            $mail->isHTML(true);
            $mail->Subject = 'Registro Plan Nacional de Empleo';  // Asunto del mensaje
            $mail->Body    = '<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width,initial-scale=1">
              <meta name="x-apple-disable-message-reformatting">
              <title></title>

              <style>
                table,
                td,
                div,
                h1,
                p {
                  font-family: Arial, sans-serif;
                }
              </style>
            </head>

            <body style="margin:0;padding:0;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                <tr>
                  <td align="left" style="padding:0;">
                    <table role="presentation" style="width:602px;border-collapse:collapse;border:0px solid #cccccc;border-spacing:0;text-align:left;">
                      <tr>
                        <td style="padding:15px 30px 20px 30px;">
                          <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                            <tr>
                              <td style="padding:0 0 36px 0;color:#153643;">
                                <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Bienvenido(a),</h1>
                                <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Gracias por mostrar interés en registrarte en la base de datos para futuras oportunidades laborales del Plan Nacional de Empleo.

                                  Para continuar con tu registro, debe completar su informacion iniciando sesion en el portal web: </p>
                                <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><a href="https://sig.plandeempleo.bo/" style="color:#ee4c50;text-decoration:underline;">Iniciar sesión</a></p>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:5px">
                          <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                            <tr>
                              <td style="padding:0;width:100%;" align="left">
                                <a href="https://plandeempleo.bo/" style="color:#ffffff;text-decoration:underline;"><img src="https://plandeempleo.bo/wp-content/uploads/2021/11/logo_corto-300x174.png" alt="" width="100" style="height:auto;display:block" /></a>
                                <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#000000;">
                                  &reg; Ministerio de Planificacion del Desarrollo 2021<br />

                                </p>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </body>
            </html>';    // Contenido del mensaje (acepta HTML)
            $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)

            $mail->send();


        } catch (Exception $e) {
            //echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
        }
    }


    public static function removeSpaces($text)
    {
        $re = '/\s+/';
        $subst = ' ';
        $result = preg_replace($re, $subst, $text);
        return $result ? trim($result) : null;
    }
    public static function formatMoney($value, $prefix = false)
    {
        if ($value) {
            $value = number_format($value, 2, '.', ',');
            if ($prefix) {
                return 'Bs' . $value;
            }
            return $value;
        }
        return 0;
    }
    public static function parseMoney($value)
    {
        $value = str_replace("Bs", "", $value);
        $value = str_replace(",", "", $value);
        return floatval(self::removeSpaces($value));
    }
    public static function parseBarDate($value)
    {
        if (!$value) {
            return null;
        }
        if (self::verifyBarDate($value)) {
            return Carbon::createFromFormat('d/m/Y', $value)->toDateString();
        } elseif (self::verifyDashDate($value)) {
            return $value;
        }
        return 'invalid date';
    }
    public static function verifyBarDate($value)
    {
        $re = $re = '/^\d{1,2}\/\d{1,2}\/\d{4}$/m';
        preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0);
        return (sizeOf($matches) > 0);
    }
    public static function verifyDashDate($value)
    {
        $re = $re = '/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/m';
        preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0);
        return (sizeOf($matches) > 0);
    }

    public static function parseNumber($input)
    {
        $val = str_replace(',', '', $input);
        return $val;
        // $next_val = str_replace('.', '', $input);
    }
    public static function twoDecimals($value)
    {
        $val = number_format((float)$value, 2);
        return $val;
    }
    public static function fiveDecimals($value)
    {
        $val = number_format((float)$value, 5);
        return $val;
    }

    public static function zeroDecimals($value)
    {
        $val = number_format((float)$value);
        return $val;
        $decimal = explode(".",$numero); //dividendo la parte entera de la fraccionaria

        $numf = self::milmillon($decimal[0]);

        if(sizeof($decimal)>1)
        {
            return $numf." ".$decimal[1]."/100 ".$currency;
        }
        return $numf." ".$currency;
    }

    public static function milmillon($nummierod){
        if ($nummierod >= 1000000000 && $nummierod <2000000000){
            $num_letrammd = "MIL ".(self::cienmillon($nummierod%1000000000));
        }
        if ($nummierod >= 2000000000 && $nummierod <10000000000){
            $num_letrammd = self::unidad(Floor($nummierod/1000000000))." MIL ".(self::cienmillon($nummierod%1000000000));
        }
        if ($nummierod < 1000000000)
            $num_letrammd = self::cienmillon($nummierod);

        return $num_letrammd;
    }

    public static function cienmillon($numcmeros){
        if ($numcmeros == 100000000)
            $num_letracms = "CIEN MILLONES";
        if ($numcmeros >= 100000000 && $numcmeros <1000000000){
            $num_letracms = self::centena(Floor($numcmeros/1000000))." MILLONES ".(self::millon($numcmeros%1000000));
        }
        if ($numcmeros < 100000000)
            $num_letracms = self::decmillon($numcmeros);
        return $num_letracms;
    }

    public static function decmillon($numerodm){
        if ($numerodm == 10000000)
            $num_letradmm = "DIEZ MILLONES";
        if ($numerodm > 10000000 && $numerodm <20000000){
            $num_letradmm = self::decena(Floor($numerodm/1000000))."MILLONES ".(self::cienmiles($numerodm%1000000));
        }
        if ($numerodm >= 20000000 && $numerodm <100000000){
            $num_letradmm = self::decena(Floor($numerodm/1000000))." MILLONES ".(self::millon($numerodm%1000000));
        }
        if ($numerodm < 10000000)
            $num_letradmm = self::millon($numerodm);

        return $num_letradmm;
    }

    public static function millon($nummiero){
        if ($nummiero >= 1000000 && $nummiero <2000000){
            $num_letramm = "UN MILLON ".(self::cienmiles($nummiero%1000000));
        }
        if ($nummiero >= 2000000 && $nummiero <10000000){
            $num_letramm = self::unidad(Floor($nummiero/1000000))." MILLONES ".(self::cienmiles($nummiero%1000000));
        }
        if ($nummiero < 1000000)
            $num_letramm = self::cienmiles($nummiero);

        return $num_letramm;
    }

    public static function cienmiles($numcmero){
        if ($numcmero == 100000)
            $num_letracm = "CIEN MIL";
        if ($numcmero >= 100000 && $numcmero <1000000){
            $num_letracm = self::centena(Floor($numcmero/1000))." MIL ".(self::centena($numcmero%1000));
        }
        if ($numcmero < 100000)
            $num_letracm = self::decmiles($numcmero);
        return $num_letracm;
    }


    public static function decmiles($numdmero){
        if ($numdmero == 10000)
            $numde = "DIEZ MIL";
        if ($numdmero > 10000 && $numdmero <20000){
            $numde = self::decena(Floor($numdmero/1000))."MIL ".(self::centena($numdmero%1000));
        }
        if ($numdmero >= 20000 && $numdmero <100000){
            $numde = self::decena(Floor($numdmero/1000))." MIL ".(self::miles($numdmero%1000));
        }
        if ($numdmero < 10000)
            $numde = self::miles($numdmero);

        return $numde;
    }

    public static function miles($nummero){
        $numm="";
        if ($nummero >= 1000 && $nummero < 2000){
            $numm = "MIL ".(self::centena($nummero%1000));
        }
        if ($nummero >= 2000 && $nummero <10000){
            $numm = self::unidad(Floor($nummero/1000))." MIL ".(self::centena($nummero%1000));
        }
        if ($nummero < 1000)
            $numm = self::centena($nummero);

        return $numm;
    }

    public static function centena($numc){
        $numce="";
        if ($numc >= 100)
        {
            if ($numc >= 900 && $numc <= 999)
            {
                $numce = "NOVECIENTOS ";
                if ($numc > 900)
                    $numce = $numce.(self::decena($numc - 900));
            }
            else if ($numc >= 800 && $numc <= 899)
            {
                $numce = "OCHOCIENTOS ";
                if ($numc > 800)
                    $numce = $numce.(self::decena($numc - 800));
            }
            else if ($numc >= 700 && $numc <= 799)
            {
                $numce = "SETECIENTOS ";
                if ($numc > 700)
                    $numce = $numce.(self::decena($numc - 700));
            }
            else if ($numc >= 600 && $numc <= 699)
            {
                $numce = "SEISCIENTOS ";
                if ($numc > 600)
                    $numce = $numce.(self::decena($numc - 600));
            }
            else if ($numc >= 500 && $numc <= 599)
            {
                $numce = "QUINIENTOS ";
                if ($numc > 500)
                    $numce = $numce.(self::decena($numc - 500));
            }
            else if ($numc >= 400 && $numc <= 499)
            {
                $numce = "CUATROCIENTOS ";
                if ($numc > 400)
                    $numce = $numce.(self::decena($numc - 400));
            }
            else if ($numc >= 300 && $numc <= 399)
            {
                $numce = "TRESCIENTOS ";
                if ($numc > 300)
                    $numce = $numce.(self::decena($numc - 300));
            }
            else if ($numc >= 200 && $numc <= 299)
            {
                $numce = "DOSCIENTOS ";
                if ($numc > 200)
                    $numce = $numce.(self::decena($numc - 200));
            }
            else if ($numc >= 100 && $numc <= 199)
            {
                if ($numc == 100)
                    $numce = "CIEN ";
                else
                    $numce = "CIENTO ".(self::decena($numc - 100));
            }
        }
        else
            $numce = self::decena($numc);

        return $numce;
    }

    public static function decena($numdero){
        $numd="";
        if ($numdero >= 90 && $numdero <= 99)
        {
            $numd = "NOVENTA ";
            if ($numdero > 90)
                $numd = $numd."Y ".(self::unidad($numdero - 90));
        }
        else if ($numdero >= 80 && $numdero <= 89)
        {
            $numd = "OCHENTA ";
            if ($numdero > 80)
                $numd = $numd."Y ".(self::unidad($numdero - 80));
        }
        else if ($numdero >= 70 && $numdero <= 79)
        {
            $numd = "SETENTA ";
            if ($numdero > 70)
                $numd = $numd."Y ".(self::unidad($numdero - 70));
        }
        else if ($numdero >= 60 && $numdero <= 69)
        {
            $numd = "SESENTA ";
            if ($numdero > 60)
                $numd = $numd."Y ".(self::unidad($numdero - 60));
        }
        else if ($numdero >= 50 && $numdero <= 59)
        {
            $numd = "CINCUENTA ";
            if ($numdero > 50)
                $numd = $numd."Y ".(self::unidad($numdero - 50));
        }
        else if ($numdero >= 40 && $numdero <= 49)
        {
            $numd = "CUARENTA ";
            if ($numdero > 40)
                $numd = $numd."Y ".(self::unidad($numdero - 40));
        }
        else if ($numdero >= 30 && $numdero <= 39)
        {
            $numd = "TREINTA ";
            if ($numdero > 30)
                $numd = $numd."Y ".(self::unidad($numdero - 30));
        }
        else if ($numdero >= 20 && $numdero <= 29)
        {
            if ($numdero == 20)
                $numd = "VEINTE ";
            else
                $numd = "VEINTI".(self::unidad($numdero - 20));
        }
        else if ($numdero >= 10 && $numdero <= 19)
        {
            switch ($numdero){
            case 10:
            {
                $numd = "DIEZ ";
                break;
            }
            case 11:
            {
                $numd = "ONCE ";
                break;
            }
            case 12:
            {
                $numd = "DOCE ";
                break;
            }
            case 13:
            {
                $numd = "TRECE ";
                break;
            }
            case 14:
            {
                $numd = "CATORCE ";
                break;
            }
            case 15:
            {
                $numd = "QUINCE ";
                break;
            }
            case 16:
            {
                $numd = "DIECISEIS ";
                break;
            }
            case 17:
            {
                $numd = "DIECISIETE ";
                break;
            }
            case 18:
            {
                $numd = "DIECIOCHO ";
                break;
            }
            case 19:
            {
                $numd = "DIECINUEVE ";
                break;
            }
            }
        }
        else
            $numd = self::unidad($numdero);
    return $numd;
    }

    public static function unidad($numuero){
        $numu = "";
        switch ($numuero)
        {
            case 9:
            {
                $numu = "NUEVE";
                break;
            }
            case 8:
            {
                $numu = "OCHO";
                break;
            }
            case 7:
            {
                $numu = "SIETE";
                break;
            }
            case 6:
            {
                $numu = "SEIS";
                break;
            }
            case 5:
            {
                $numu = "CINCO";
                break;
            }
            case 4:
            {
                $numu = "CUATRO";
                break;
            }
            case 3:
            {
                $numu = "TRES";
                break;
            }
            case 2:
            {
                $numu = "DOS";
                break;
            }
            case 1:
            {
                $numu = "UN";
                break;
            }
            case 0:
            {
                $numu = "";
                break;
            }
        }
        return $numu;
    }

    //api Consultas NIT
    public static function apiGetNit($nit) {
        if(trim($nit)!=""){
            try{
                $response = Http::get('http://pbdw.impuestos.gob.bo:8080/gob.sin.padron.servicio.web/consulta/verificarContribuyente', [
                    'nit' => $nit
                ])->throw(function ($response, $e) {
                    return false;
                })->json();
                if($response["ok"]==true AND $response["estado"]=="ACTIVO"){
                    return true;
                }
            }catch (\Exception $e) {
                return false;
            }
        }
        return false;
    }
    public static function apiGetNitRazonSocial($nit) {
        if(trim($nit)!=""){
            try{
                $response = Http::get('http://pbdw.impuestos.gob.bo:8080/gob.sin.padron.servicio.web/consulta/verificarContribuyente', [
                    'nit' => $nit
                ])->throw(function ($response, $e) {
                    return false;
                })->json();
                return $response["razonSocial"];
            }catch (\Exception $e) {
                return false;
            }
        }
        return false;
    }
}
