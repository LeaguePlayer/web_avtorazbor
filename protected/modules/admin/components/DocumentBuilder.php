<?php

/**
 * phpWord Singleton
 */

class DocumentBuilder{

	protected static $_instance_phpword;

	private function __construct(){}
	private function __clone(){}

	public static function createInstancePHPWord(){
		spl_autoload_unregister(array('YiiBase','autoload'));

		Yii::import('application.extensions.PHPWord.*');
		require_once Yii::getPathOfAlias('application.extensions.PHPWord').'/PHPWord.php';

		if (self::$_instance_phpword === null) {
            self::$_instance_phpword = new PHPWord();
        }
		
		spl_autoload_register(array('YiiBase','autoload'));

		return self::$_instance_phpword;
	}

	/**
	 * Создаем документ комиссии
	 */
	public static function createDogovorKomissii($model, $update_doc_id=null){
		
		$PHPWord = self::createInstancePHPWord();
		$template = Templates::findTemplateByName('dogovor_komissii');

		$tplFile = $template->getTemplatePathToFile();
		$document = $PHPWord->loadTemplate($tplFile);

		$date_now = new DateTime();

		$months = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 	4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');

		$n_month = $date_now->format('n');

		$document->setValue('date_d', $date_now->format('d'));
		$document->setValue('date_m', $months[$n_month]);
		$document->setValue('date_y', $date_now->format('y'));

		//-----------owner info
		$document->setValue('owner_fio', $model->owner->fio);

		//num pass
		$passport = explode(' ', $model->owner->passport_num);
		$document->setValue('pass_seria', implode(' ', str_split($passport[0], 2)));
		$document->setValue('pass_num', $passport[1]);

		//birthday
		$date = new DateTime($model->owner->dt_birthday);
		$document->setValue('dt_birthday', $date->format('d.m.Y'));

		//date of issue
		$date = new DateTime($model->owner->dt_of_issue);
		$document->setValue('dt_of_issue', $date->format('d.m.Y'));

		$document->setValue('issued_by', $model->owner->issued_by);
		$document->setValue('address', $model->owner->address);
		//-----------owner info

		//-----------car info
		$document->setValue('vin', $model->vin);
		$document->setValue('marka_model', $model->name);
		$document->setValue('year', $model->year);
		$document->setValue('model_num_engine', $model->dop->model_num_engine);
		$document->setValue('chassis_num', $model->dop->chassis_num);
		$document->setValue('carcass_num', $model->dop->carcass_num);
		$document->setValue('color', $model->dop->color);
		$document->setValue('type_ts', $model->dop->type_ts);
		$document->setValue('passport_ts', $model->dop->passport_ts);

		$date = new DateTime($model->dop->dt_of_issue);

		$n_month = $date->format('n');
		$document->setValue('dt_of_issue_d', $date->format('d'));
		$document->setValue('dt_of_issue_m', $months[$n_month]);
		$document->setValue('dt_of_issue_y', $date->format('y'));

		$document->setValue('car_issue', $model->dop->issued_by);
		$document->setValue('car_issue_date', $date->format('d.m.Y'));
		//-----------car info

		//-----------sum
		$document->setValue('sum', number_format($model->price, 0, '', ' '));
		$document->setValue('sum_str', SiteHelper::num2str($model->price));
		//-----------sum

		//-----------rotate fio
		$fio_str = "";
		$fio_arr = explode(' ', $model->owner->fio);

		if(!empty($fio_arr)){
			$fio_str = $fio_arr[0]; //Ф
			isset($fio_arr[2]) ? $fio_str = mb_substr($fio_arr[2], 0, 1, 'UTF-8').'.'.$fio_str : ''; //О
			isset($fio_arr[1]) ? $fio_str = mb_substr($fio_arr[1], 0, 1, 'UTF-8').'.'.$fio_str : ''; //И
		}
		$document->setValue('fio_str', $fio_str);
		//-----------rotate fio

		//create or update Document
		$arDocument = $update_doc_id ? Documents::model()->findByPk($update_doc_id) : new Documents;

		if($arDocument){
			
			if($arDocument->isNewRecord) $arDocument->save(false);

			$docsPath = Yii::getPathOfAlias('application.docs');
			$fileName = "{$template->uniqid}_{$arDocument->id}.docx";
			$tmpName = $docsPath.DIRECTORY_SEPARATOR.$fileName;

			//set document number
			$document->setValue('doc_num', $arDocument->id);
			$document->save($tmpName);

			//set attributes
			$arDocument->type = Documents::DOC_KOMISSII;
			$arDocument->name = $arDocument->getType().' №'.$arDocument->id.' от '.$date_now->format('d.m.Y').' '.$model->owner->fio.' '.$model->name;
			$arDocument->file = $fileName;
			$arDocument->used_car_id = $model->id;
			$arDocument->template_id = $template->id;
			$arDocument->sum = $model->price;

			$arDocument->save(false);
		}

	}

}