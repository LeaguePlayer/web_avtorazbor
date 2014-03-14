<?php

class ExcelComponent extends CApplicationComponent{

	private $_alphabet;

	public function init(){

		parent::init();
		$this->_alphabet = range('A', 'Z');
	}

	/**
	 * Export model data to excel file
	 */
	public function exportModel($model, $filter = array(), $eval_attrs=array(), $return = false){

		$phpExcelPath = Yii::getPathOfAlias('ext.phpExcel.Classes');

		spl_autoload_unregister(array('YiiBase','autoload'));
		require_once $phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php';
		spl_autoload_register(array('YiiBase','autoload'));

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$criteria = new CDbCriteria;

		$criteria->order = 'id';

		$instance = new $model;
		$data = $model::model()->findAll($criteria);
		$attributes = $instance->attributeNames();

		$activeSheet = $objPHPExcel->setActiveSheetIndex(0);

		foreach ($attributes as $key => $name) {
			$activeSheet->setCellValue($this->_alphabet[$key].'1', $instance->getAttributeLabel($name));
		}

		$startRow = 2;

		foreach ($data as $item) {
			foreach ($attributes as $key => $attr) {
				if(isset($eval_attrs[$attr])){
					// $val = '';
					$eval_attrs[$attr] = str_replace('data', 'item', $eval_attrs[$attr]);
					$eval_attrs[$attr] = str_replace('$', "\$", $eval_attrs[$attr]);

					eval("\$val = ".$eval_attrs[$attr].';');
					$activeSheet->setCellValue($this->_alphabet[$key].$startRow, str_replace('&nbsp;', ' ', $val));
					continue;
				}
				$activeSheet->setCellValue($this->_alphabet[$key].$startRow, $item->$attr);
			}
			$startRow++;
		}
		
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Запчасти');

		if(!$return){
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$model.'.xlsx"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
		}else{
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

			$file = Templates::getDocsPath().DIRECTORY_SEPARATOR.$model.'.xlsx';
			$objWriter->save($file);

			return $file;
		}
	}

}