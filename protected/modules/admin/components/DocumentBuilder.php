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

		Yii::import('application.extensions.PhpWord.*');
		require_once Yii::getPathOfAlias('application.extensions.PhpWord').'/Autoloader.php';
		PhpOffice\PhpWord\Autoloader::register();

		if (self::$_instance_phpword === null) {
            self::$_instance_phpword = new \PhpOffice\PhpWord\PhpWord();
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

		$date_now = new DateTime('now', 'Asia/Yekaterinburg');

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
			$document->saveAs($tmpName);

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

	/**
	 * Документ договор купли-продажи на основании договора комиссии (БУ авто)
	 */
	public static function documentKupliProdBUWithDocKomissii($usedCar, $update_doc_id=null){
		$PHPWord = self::createInstancePHPWord();
		$template = Templates::findTemplateByName('dogovor_kupli-prodaji_ts_k_dogovoru_komissii');

		$tplFile = $template->getTemplatePathToFile();
		$document = $PHPWord->loadTemplate($tplFile);

		//Достаем номер договора комиссии
		$numDoc = $usedCar->document->id;
		// print_r($numDoc); die();
		$document->setValue('dog_komissii_num', $numDoc);
		
		//Дата договора
		$docDate = new DateTime($usedCar->document->create_time);

		$document->setValue('dog_komissii_day', $docDate->format('d'));
		$document->setValue('dog_komissii_month', self::getRussianMonth($docDate->format('n')));
		$document->setValue('dog_komissii_year', $docDate->format('y'));

		//Достаем владельца авто
		$owner =  $usedCar->owner;
		$document->setValue('owner_fio', $owner->fio);

		//-----------buyer info
		$document->setValue('buyer_fio', $usedCar->buyer->fio);

		//num pass
		$passport = explode(' ', $usedCar->buyer->passport_num);
		$document->setValue('buyer_pass_seria', implode(' ', str_split($passport[0], 2)));
		$document->setValue('buyer_pass_num', $passport[1]);

		//birthday
		$date = new DateTime($usedCar->buyer->dt_birthday);
		$document->setValue('buyer_birthday', $date->format('d.m.Y'));

		//date of issue
		$date = new DateTime($usedCar->buyer->dt_of_issue);
		$document->setValue('buyer_dt_of_issue', $date->format('d.m.Y'));

		$document->setValue('buyer_issued_by', $usedCar->buyer->issued_by);
		$document->setValue('buyer_address', $usedCar->buyer->address);

		//-----------rotate fio
		$fio_str = "";
		$fio_arr = explode(' ', $usedCar->buyer->fio);

		if(!empty($fio_arr)){
			$fio_str = $fio_arr[0]; //Ф
			isset($fio_arr[2]) ? $fio_str = mb_substr($fio_arr[2], 0, 1, 'UTF-8').'.'.$fio_str : ''; //О
			isset($fio_arr[1]) ? $fio_str = mb_substr($fio_arr[1], 0, 1, 'UTF-8').'.'.$fio_str : ''; //И
		}
		$document->setValue('fio_str', $fio_str);
		//-----------rotate fio
		//-----------buyer info

		//-----------car info
		$document->setValue('vin', $usedCar->vin);
		$document->setValue('marka_model', $usedCar->name);
		$document->setValue('year', $usedCar->year);
		$document->setValue('model_num_engine', $usedCar->dop->model_num_engine);
		$document->setValue('chassis_num', $usedCar->dop->chassis_num);
		$document->setValue('carcass_num', $usedCar->dop->carcass_num);
		$document->setValue('color', $usedCar->dop->color);
		$document->setValue('type_ts', $usedCar->dop->type_ts);

		$passport_ts = explode(' ', $usedCar->dop->passport_ts);

		$document->setValue('passport_ts_s', $passport_ts[0]); //серия
		$document->setValue('passport_ts_n', $passport_ts[1]); //номер

		$date = new DateTime($usedCar->dop->dt_of_issue);

		$n_month = $date->format('n');
		$document->setValue('dt_of_issue_d', $date->format('d'));
		$document->setValue('dt_of_issue_m', self::getRussianMonth($n_month));
		$document->setValue('dt_of_issue_y', $date->format('y'));

		$document->setValue('car_issue', $usedCar->dop->issued_by);
		$document->setValue('car_issue_date', $date->format('d.m.Y'));
		//-----------car info

		$date_now = new DateTime('now', new DateTimeZone('Asia/Yekaterinburg'));

		$n_month = $date_now->format('n');

		$document->setValue('date_d', $date_now->format('d'));
		$document->setValue('date_m', self::getRussianMonth($n_month));
		$document->setValue('date_y', $date_now->format('y'));

		//-----------sum
		$document->setValue('sum', number_format($usedCar->dop->price_sell, 0, '', ' '));
		$document->setValue('sum_str', SiteHelper::num2str($usedCar->dop->price_sell));
		//-----------sum

		//create or update Document
		$arDocument = $update_doc_id ? Documents::model()->findByPk($update_doc_id) : new Documents;

		if($arDocument){
			
			if($arDocument->isNewRecord) $arDocument->save(false);

			$docsPath = Yii::getPathOfAlias('application.docs');
			$fileName = "{$template->uniqid}_{$arDocument->id}.docx";
			$tmpName = $docsPath.DIRECTORY_SEPARATOR.$fileName;

			//set document number
			$document->setValue('dog_num', $arDocument->id);
			$document->saveAs($tmpName);

			// SiteHelper::downloadFile($tmpName);

			//set attributes
			$arDocument->type = Documents::DOC_KUPLI_I_PROD_BU_WITH_KOMISSII;
			$arDocument->name = $arDocument->getType().' №'.$arDocument->id.' от '.$date_now->format('d.m.Y').' '.$usedCar->owner->fio.' '.$usedCar->name;
			$arDocument->file = $fileName;
			$arDocument->used_car_id = $usedCar->id;
			$arDocument->template_id = $template->id;
			$arDocument->sum = $usedCar->dop->price_sell;

			$arDocument->save(false);
		}
	}

	/**
	 * Документ договор купли-продажи без договора комиссии (БУ авто)
	 */
	public static function documentKupliProdBUNotDocKomissii($usedCar, $update_doc_id=null){
		$PHPWord = self::createInstancePHPWord();
		$template = Templates::findTemplateByName('dogovor_kupli-prodaji_ts_bez_dogovora_komissii');

		$tplFile = $template->getTemplatePathToFile();
		$document = $PHPWord->loadTemplate($tplFile);
		
		//Достаем владельца авто
		$owner =  $usedCar->owner;

		//-----------owner info
		$document->setValue('owner_fio', $owner->fio);

		//num pass
		$passport = explode(' ', $owner->passport_num);
		$document->setValue('owner_pass_seria', implode(' ', str_split($passport[0], 2)));
		$document->setValue('owner_pass_num', $passport[1]);

		//birthday
		$date = new DateTime($owner->dt_birthday);
		$document->setValue('owner_birthday', $date->format('d.m.Y'));

		//date of issue
		$date = new DateTime($owner->dt_of_issue);
		$document->setValue('owner_dt_of_issue', $date->format('d.m.Y'));

		$document->setValue('owner_issued_by', $owner->issued_by);
		$document->setValue('owner_address', $owner->address);

		//-----------rotate fio
		$fio_str = "";
		$fio_arr = explode(' ', $owner->fio);

		if(!empty($fio_arr)){
			$fio_str = $fio_arr[0]; //Ф
			isset($fio_arr[2]) ? $fio_str = mb_substr($fio_arr[2], 0, 1, 'UTF-8').'.'.$fio_str : ''; //О
			isset($fio_arr[1]) ? $fio_str = mb_substr($fio_arr[1], 0, 1, 'UTF-8').'.'.$fio_str : ''; //И
		}
		$document->setValue('owner_fio_str', $fio_str);
		//-----------rotate fio

		//-----------owner info


		//-----------buyer info
		$document->setValue('buyer_fio', $usedCar->buyer->fio);

		//num pass
		$passport = explode(' ', $usedCar->buyer->passport_num);
		$document->setValue('buyer_pass_seria', implode(' ', str_split($passport[0], 2)));
		$document->setValue('buyer_pass_num', $passport[1]);

		//birthday
		$date = new DateTime($usedCar->buyer->dt_birthday);
		$document->setValue('buyer_birthday', $date->format('d.m.Y'));

		//date of issue
		$date = new DateTime($usedCar->buyer->dt_of_issue);
		$document->setValue('buyer_dt_of_issue', $date->format('d.m.Y'));

		$document->setValue('buyer_issued_by', $usedCar->buyer->issued_by);
		$document->setValue('buyer_address', $usedCar->buyer->address);

		//-----------rotate fio
		$fio_str = "";
		$fio_arr = explode(' ', $usedCar->buyer->fio);

		if(!empty($fio_arr)){
			$fio_str = $fio_arr[0]; //Ф
			isset($fio_arr[2]) ? $fio_str = mb_substr($fio_arr[2], 0, 1, 'UTF-8').'.'.$fio_str : ''; //О
			isset($fio_arr[1]) ? $fio_str = mb_substr($fio_arr[1], 0, 1, 'UTF-8').'.'.$fio_str : ''; //И
		}
		$document->setValue('buyer_fio_str', $fio_str);
		//-----------rotate fio
		//-----------buyer info

		//-----------car info
		$document->setValue('vin', $usedCar->vin);
		$document->setValue('marka_model', $usedCar->name);
		$document->setValue('year', $usedCar->year);
		$document->setValue('model_num_engine', $usedCar->dop->model_num_engine);
		$document->setValue('chassis_num', $usedCar->dop->chassis_num);
		$document->setValue('carcass_num', $usedCar->dop->carcass_num);
		$document->setValue('color', $usedCar->dop->color);
		$document->setValue('type_ts', $usedCar->dop->type_ts);

		$passport_ts = explode(' ', $usedCar->dop->passport_ts);

		$document->setValue('passport_ts_s', $passport_ts[0]); //серия
		$document->setValue('passport_ts_n', $passport_ts[1]); //номер

		$date = new DateTime($usedCar->dop->dt_of_issue);

		$n_month = $date->format('n');
		$document->setValue('dt_of_issue_d', $date->format('d'));
		$document->setValue('dt_of_issue_m', self::getRussianMonth($n_month));
		$document->setValue('dt_of_issue_y', $date->format('y'));

		$document->setValue('car_issue', $usedCar->dop->issued_by);
		$document->setValue('car_issue_date', $date->format('d.m.Y'));
		//-----------car info

		$date_now = new DateTime('now', new DateTimeZone('Asia/Yekaterinburg'));

		$n_month = $date_now->format('n');

		$document->setValue('date_d', $date_now->format('d'));
		$document->setValue('date_m', self::getRussianMonth($n_month));
		$document->setValue('date_y', $date_now->format('y'));

		//-----------sum
		$document->setValue('sum', number_format($usedCar->dop->price_sell, 0, '', ' '));
		$document->setValue('sum_str', SiteHelper::num2str($usedCar->dop->price_sell));
		//-----------sum

		//create or update Document
		$arDocument = $update_doc_id ? Documents::model()->findByPk($update_doc_id) : new Documents;

		if($arDocument){
			
			if($arDocument->isNewRecord) $arDocument->save(false);

			$docsPath = Yii::getPathOfAlias('application.docs');
			$fileName = "{$template->uniqid}_{$arDocument->id}.docx";
			$tmpName = $docsPath.DIRECTORY_SEPARATOR.$fileName;

			//set document number
			$document->setValue('dog_num', $arDocument->id);
			$document->saveAs($tmpName);

			// SiteHelper::downloadFile($tmpName);

			//set attributes
			$arDocument->type = Documents::DOC_KUPLI_I_PROD_BU_NO_KOMISSII;
			$arDocument->name = $arDocument->getType().' №'.$arDocument->id.' от '.$date_now->format('d.m.Y').' '.$usedCar->owner->fio.' '.$usedCar->name;
			$arDocument->file = $fileName;
			$arDocument->used_car_id = $usedCar->id;
			$arDocument->template_id = $template->id;
			$arDocument->sum = $usedCar->dop->price_sell;

			$arDocument->save(false);
		}
	}

	/**
	 * Формируем товарный чек (физическое лицо)
	 */
	public static function tovarniyCheck($request, $update_doc_id = false){

		$PHPWord = self::createInstancePHPWord();

		$template = Templates::findTemplateByName('tovarnyiy_chek');

		$tplFile = $template->getTemplatePathToFile();
		$document = $PHPWord->loadTemplate($tplFile);

		$date = new DateTime();
		$document->setValue('date', $date->format('d.m.Y'));

		$sum = 0;

		if($request->parts){
			$document->cloneRow('index', count($request->parts));
			
			//set row
			foreach ($request->parts as $i => $part) {
				$index = $i + 1;
				$sum += $part->price_sell;
				$document->setValue('index#'.$index, $index);
				$document->setValue('name#'.$index, $part->name);
				$document->setValue('id#'.$index, $part->id);
				$document->setValue('count#'.$index, 1);
				$document->setValue('price#'.$index, $part->price_sell);
				$document->setValue('part_sum#'.$index, $part->price_sell);
			}

			$document->setValue('sum', $sum);
			$document->setValue('sum_str', SiteHelper::num2str($sum));
		}

		//create or update Document
		$arDocument = $update_doc_id ? Documents::model()->findByPk($update_doc_id) : new Documents;

		if($arDocument){
			
			if($arDocument->isNewRecord) $arDocument->save(false);

			$docsPath = Yii::getPathOfAlias('application.docs');
			$fileName = "{$template->uniqid}_{$request->id}.docx";
			$tmpName = $docsPath.DIRECTORY_SEPARATOR.$fileName;

			$document->setValue('num', $arDocument->id);
			$document->setValue('user', Yii::app()->user->first_name);
			$document->saveAs($tmpName);
			//set attributes
			$arDocument->type = Documents::DOC_TOVARNIY_CHECK;
			$arDocument->name = $arDocument->getType().' №'.$arDocument->id.' от '.$date->format('d.m.Y');
			$arDocument->file = $fileName;
			$arDocument->request_id = $request->id;
			$arDocument->template_id = $template->id;
			$arDocument->sum = $sum;

			$arDocument->save(false);
		}
	}

	/**
	 * Формируем счет (юридическое лицо)
	 */
	public static function schetOplata($request, $update_doc_id = false){

		$PHPWord = self::createInstancePHPWord();

		$template = Templates::findTemplateByName('schet_na_oplatu');

		$tplFile = $template->getTemplatePathToFile();
		$document = $PHPWord->loadTemplate($tplFile);

		$date = new DateTime();
		$document->setValue('date', $date->format('d.m.Y'));

		$sum = 0;

		if($request->parts){
			$document->cloneRow('index', count($request->parts));
			
			//set row
			foreach ($request->parts as $i => $part) {
				$index = $i + 1;
				$sum += $part->price_sell;
				$document->setValue('index#'.$index, $index);
				$document->setValue('name#'.$index, $part->name);
				$document->setValue('price#'.$index, number_format($part->price_sell, 2, ',', ' '));
			}
		}

		$document->setValue('sum', number_format($sum, 2, ',', ' '));
		$document->setValue('count', count($request->parts));
		$document->setValue('sum_str', SiteHelper::num2str($sum));

		//get client info
		if($request->client){
			$info = $request->client->info;
			$client = array();

			$client[] = $info->name_company;
			$client[] = 'ИНН '.$info->inn;
			$client[] = 'КПП '.$info->kpp;
			$client[] = $info->ur_address;

			$document->setValue('client', implode(', ', $client));
		}

		//create or update Document
		$arDocument = $update_doc_id ? Documents::model()->findByPk($update_doc_id) : new Documents;

		if($arDocument){
			
			if($arDocument->isNewRecord) $arDocument->save(false);

			$docsPath = Yii::getPathOfAlias('application.docs');
			$fileName = "{$template->uniqid}_{$request->id}.docx";
			$tmpName = $docsPath.DIRECTORY_SEPARATOR.$fileName;

			/*SiteHelper::downloadFile($tmpName);
			die($tmpName);*/

			$document->setValue('num', $arDocument->id);
			$document->saveAs($tmpName);
			//set attributes
			$arDocument->type = Documents::DOC_SCHET_OPLATI;
			$arDocument->name = $arDocument->getType().' №'.$arDocument->id.' от '.$date->format('d.m.Y');
			$arDocument->file = $fileName;
			$arDocument->request_id = $request->id;
			$arDocument->template_id = $template->id;
			$arDocument->sum = $sum;

			$arDocument->save(false);
		}
	}

	public static function getRussianMonth($n){
		$months = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 	4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');

		return $months[$n];
	}
}