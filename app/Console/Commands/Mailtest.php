<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Confirmation;
use App\Models\User;
use Util;
class Mailtest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpd:Mailtest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tes de envio de correo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $user = User::find(1);
        $this->info("enviando correo de prueba");
        Util::SendMailWelcome('ltorrezs2008@gmail.com');
        // $mail = new PHPMailer(true);
        // try {
        //     $mail->SMTPDebug = 0;  // Sacar esta línea para no mostrar salida debug
        //     $mail->isSMTP();
        //     $mail->Host = 'mail.planificacion.gob.bo';  // Host de conexión SMTP
        //     $mail->SMTPAuth = true;    
        //     $mail->Username = 'planificacion\registro.pge';                 // Usuario SMTP
        //     $mail->Password = 'Pl%4n21***';                           // Password SMTP
        //     $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
        //     $mail->Port = 587;
        //     $mail->SMTPOptions = array(
        //     'ssl' => array(
        //         'verify_peer' => false,
        //         'verify_peer_name' => false,
        //         'allow_self_signed' => true
        //     )
        //     );
        //     // Puerto SMTP

        //     #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
        //     #$mail->SMTPSecure = false;             // Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
        //     #$mail->SMTPAutoTLS = false;            // Descomentar si se requiere desactivar completamente TLS (sin cifrado)
        
        //     $mail->setFrom('registro.pge@planificacion.gob.bo');        // Mail del remitente
        //     $mail->addAddress('ltorrezs2008@gmail.com');     // Mail del destinatario
        
        //     $mail->isHTML(true);
        //     $mail->Subject = 'Contacto desde formulario';  // Asunto del mensaje
        //     $mail->Body    = 'Este es el contenido del mensaje <b>en negrita!</b>';    // Contenido del mensaje (acepta HTML)
        //     $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)
        
        //     $mail->send();
        //     echo 'El mensaje ha sido enviado';

        // } catch (Exception $e) {
        //     echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
        // }

        $this->info("Correo Enviado Exitosamente");
        
    }
}
