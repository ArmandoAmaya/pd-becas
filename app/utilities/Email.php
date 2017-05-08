<?php 

// ---------------------------
final class Email extends Twig_Extension{

	// ---------------------------

	/**
	 * Inicia la conexion con el servidor SMTP
	 * 
	 * @param bool $smtp - true para que tomelos datos q definimos para el servidor
	 * 
	 * @return conexión al servidor smtp
	 */

	final private static function start(bool $smtp = true) : PHPMailer {

		$mail = new PHPMailer;
		$mail->CharSet = 'UTF-8';
		$mail->Encoding = 'quoted-printable';

		if ($smtp) {
			$mail->isSMTP();                                      
			$mail->Host = PHPM_HOsST;  
			$mail->SMTPAuth = true;                               
			$mail->Username = PHPM_USEr;                
			$mail->Password = PHPM_PASS;                           
			$mail->SMTPSecure = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);                            
			$mail->Port = PHPM_PORT;            
		}else{ 
			$mail->isSendmail();
		}

		return $mail;
	}

	// ---------------------------

	/**
	 * Envia un correo electrónico con PHPMAILER
	 * 
	 * @param array $dest - Destinatarios a enviar el correo
	 * @param strin $HTML - Html con el contenido del correo
	 * @param string $titulo - Título o asunto del correo
	 * @param bool $smtp - Toma los datos locales para la conexión
	 * @param array $files - Archivos a enviar
	 * 
	 * @return true si el correo se envió correctamente
	 * 
	 */

	final public static function send(array $dest, string $CONTENT, string $titulo, bool $smtp = true, array $files = []){
		$mail = self::start($smtp);
		$mail->setFrom('dev@ocrend.com', 'Administrador');

		foreach ($dest as $email => $name) {
			$mail->setFrom($email, $name);
		}

		$mail->isHTML(true);
		$mail->Subject = $titulo;
		$mail->Body    = $CONTENT;

		if (sizeof($files)) {
			foreach ($files as $f) {
				$mail->addAttachment($f);
			}
		}

		if (!$mail->send()) {
			return $mail->ErrorInfo;
		}

		return true;
	}

	// ---------------------------

	/**
	 * Estructura HTML para enviar en el contenido del correo
	 * 
	 * @param string $contenido - Contenido del correo
	 * @param string $title - Título de la estructura HTML
	 * 
	 * @return string con el html necesesario
	 * 
	 */

	 final public static function html(string $contenido, string $title = 'Mensaje'){
        return '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <title>'.$title.'</title>
        </head>
        <body>
            '.$contenido.'
        </body>
        </html>';
    }

    // --------------------------------------------------------------
	public function getFunctions() : array {
		return array(
			new Twig_Function('start', array($this,'start')),
			new Twig_Function('send', array($this,'send')),
			new Twig_Function('html', array($this,'html'))
		);
	}

	// --------------------------------------------------------------
	public function getName() : string {
		return 'Dev_Util_Email';
	}
}
?>