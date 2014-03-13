<?php
class SwiftmailerComponent extends CApplicationComponent
{
	public function sendEmail($from, $to, $subject, $body, $attachments = array(), $host='smtp.gmail.com', $port = 465){
		
		$path = Yii::getPathOfAlias('ext.swiftmailer.lib');

		spl_autoload_unregister(array('YiiBase','autoload'));
		Yii::import('ext.swiftmailer.lib.swift_required', true);
		// require_once($path.DIRECTORY_SEPARATOR.'swift_required.php');
		spl_autoload_register(array('YiiBase','autoload'));

		$message = Swift_Message::newInstance()
			->setSubject($subject)
			->setFrom($from)
			->setTo($to)
			->setBody($body, 'text/html');

		if(!empty($attachments)){
			foreach ($attachments as $file) {
				$message->attach(Swift_Attachment::fromPath($file));
			}
		}

		$transport = Swift_SmtpTransport::newInstance($host, $port, 'ssl')
			->setUsername('vitgvr@gmail.com')
			->setPassword('VetalGal89');

		$mailer = Swift_Mailer::newInstance($transport);
    	$result = $mailer->send($message);

		return $result;
	}
}