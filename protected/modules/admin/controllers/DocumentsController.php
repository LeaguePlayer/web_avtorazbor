<?php

class DocumentsController extends AdminController
{
	public function actionDoc(){
		
		spl_autoload_unregister(array('YiiBase','autoload'));

		Yii::import('application.extensions.PHPWord.*');
		require_once Yii::getPathOfAlias('application.extensions.PHPWord').'/PHPWord.php';

		$PHPWord = new PHPWord();
		
		spl_autoload_register(array('YiiBase','autoload'));

		// Every element you want to append to the word document is placed in a section. So you need a section:
		$section = $PHPWord->createSection();

		// After creating a section, you can append elements:
		$section->addText('Hello world!');

		// You can directly style your text by giving the addText function an array:
		$section->addText('Hello world! I am formatted.', array('name'=>'Tahoma', 'size'=>16, 'bold'=>true));

		// If you often need the same style again you can create a user defined style to the word document
		// and give the addText function the name of the style:
		$PHPWord->addFontStyle('myOwnStyle', array('name'=>'Verdana', 'size'=>14, 'color'=>'1B2232'));
		$section->addText('Hello world! I am formatted by a user defined style', 'myOwnStyle');

		// You can also putthe appended element to local object an call functions like this:
		// $myTextElement = $section->addText('Hello World!');
		// // $myTextElement->setBold();
		// // $myTextElement->setName('Verdana');
		// $myTextElement->setSize(22);

		// At least write the document to webspace:
		$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
		$objWriter->save($this->createDocsDir().DIRECTORY_SEPARATOR.'helloWorld.docx');
	}

	private function createDocsDir(){
		$docsPath = Yii::getPathOfAlias('webroot.media.docs');
		
		if(!is_dir($docsPath)) mkdir($docsPath);

		return $docsPath;
	}
}
