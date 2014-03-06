<?php

class DocumentsController extends AdminController
{
	public function actionDoc(){
		
		$PHPWord = $this->createInstance();
		// Every element you want to append to the word document is placed in a section. So you need a section:
		$tplFile = Templates::getTemplateFile('dogovor_komissii');
		$document = $PHPWord->loadTemplate($tplFile);

		$date = new DateTime();

		$months = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 	4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');

		$n_month = $date->format('n');

		$document->setValue('doc_num', 123);
		$document->setValue('date_d', $date->format('d'));
		$document->setValue('date_m', $months[$n_month]);
		$document->setValue('date_y', $date->format('y'));


		$createDate = date('d.m.Y');
		$tmpPath = Yii::getPathOfAlias('webroot.media.docs');
		$fileName = "{$createDate}.docx";
		$time = time();
		$tmpName = $tmpPath.$fileName.'-'.$time;
		$document->save($tmpName);

		// Download the file:
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$fileName);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($tmpName));
		ob_clean();
		flush();
		$status = readfile($tmpName);
		unlink($tmpName);

	}

	/**
	 * Договор комиссии
	 */
	public function documentKomissii($model){

	}

	private function createInstance(){
		spl_autoload_unregister(array('YiiBase','autoload'));

		Yii::import('application.extensions.PHPWord.*');
		require_once Yii::getPathOfAlias('application.extensions.PHPWord').'/PHPWord.php';

		$object = new PHPWord();
		
		spl_autoload_register(array('YiiBase','autoload'));

		return $object;
	}

	private function createDocsDir(){
		$docsPath = Yii::getPathOfAlias('webroot.media.docs');
		
		if(!is_dir($docsPath)) mkdir($docsPath);

		return $docsPath;
	}
}
