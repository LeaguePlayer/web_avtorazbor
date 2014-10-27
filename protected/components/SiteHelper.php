<?php

class SiteHelper {

	public static function translit($str) {
		$tr = array(
			"А" => "a", "Б" => "b", "В" => "v", "Г" => "g",

			"Д" => "d", "Е" => "e","Ё" => "yo", "ё" => "yo", "Ж" => "j",
			"З" => "z", "И" => "i",
			"Й" => "y", "К" => "k", "Л" => "l", "М" => "m", "Н" => "n",
			"О" => "o", "П" => "p", "Р" => "r", "С" => "s", "Т" => "t",
			"У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "ts", "Ч" => "ch",
			"Ш" => "sh", "Щ" => "sch", "Ъ" => "", "Ы" => "yi", "Ь" => "",
			"Э" => "e", "Ю" => "yu", "Я" => "ya", "а" => "a", "б" => "b",
			"в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
			"з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
			"м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
			"с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
			"ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
			"ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
			" " => "_", "." => "_", "/" => "-","," => "","." => "", "(" => "", ")" => "",
			"<"=>"",">"=>"","["=>"","]"=>"",
		);
		return strtr($str, $tr);
	}

	public static function pluralize($n, $arr) {

		$index = $n % 10 == 1 && $n % 100 != 11 ? 0 : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? 1 : 2);
		if ($arr) {
			return $n . ' ' . $arr[$index];
		} else {
			return $n;
		}
	}

	public static function scanNameModels($folderAlias = 'application.models', $parentClass = 'EActiveRecord') {
		$path = Yii::getPathOfAlias($folderAlias);
		$files = scandir($path);
		$ret = array();
		foreach ($files as $file) {
			if (($pos = strpos($file, '.php')) === false)
				continue;
			$modelClass = substr($file, 0, -4);
			try {
				if (get_parent_class($modelClass) === $parentClass) {
					$ret[] = $modelClass;
				}
			} catch (Exception $e) {
				continue;
			}
		}
		return $ret;
	}

	public static function genUniqueKey($length = 9, $salt = '') {
		$string = 'abcdefghijlklmnopqrstuvwxyzABCDEFGHIJLKLMNOPQRSTUVWXYZ1234567890';
		$result = '';
		$n = strlen($string);
		for ($i = 0; $i < $length; $i++) {
			$result .= $string[rand(0, $n)];
		}
		if ($length and $length > 0)
			return substr(md5($result . $salt . time()), 0, $length);
		else
			return substr(md5($result . time()), 0);
	}
	
	public static function russianMonth($monthNumber)
	{
		$n = (int) $monthNumber;
		switch ($n) {
			case 1:
				return 'января';
			case 2: 
				return 'февраля';
			case 3: 
				return 'марта';
			case 4: 
				return 'апреля';
			case 5: 
				return 'мая';
			case 6: 
				return 'июня';
			case 7: 
				return 'июля';
			case 8: 
				return 'августа';
			case 9: 
				return 'сентября';
			case 10: 
				return 'октября';
			case 11: 
				return 'ноября';
			case 12: 
				return 'декабря';
		}
	}

	public static function russianDate($datetime = null) {
        if (!$datetime || $datetime == 0)
            return '';
            
		if (is_numeric($datetime) ) {
			$timestamp = $datetime;
		} else if (is_string($datetime)) {
			$timestamp = strtotime($datetime);
        } else {
			$timestamp = time();
		}
		$date = explode(".", date("d.m.Y", $timestamp));
		$m = self::russianMonth($date[1]);
		return $date[0] . '&nbsp;' . $m . '&nbsp;' . $date[2];
	}

	public static function sendMail($subject,$message,$to='',$from='')
    {
        if($to=='') $to = Yii::app()->params['adminEmail'];
        if($from=='') $from = 'no-reply@torsim.ru';
        $headers = "MIME-Version: 1.0\r\nFrom: $from\r\nReply-To: $from\r\nContent-Type: text/html; charset=utf-8";
	    $message = wordwrap($message, 70);
	    $message = str_replace("\n.", "\n..", $message);
        return mail($to,'=?UTF-8?B?'.base64_encode($subject).'?=',$message,$headers);
    }

    public static function formatDate($date, $in, $out){
    	if(!$date) return '';
    	$d = \DateTime::createFromFormat($in, $date);
    	return $d->format($out);
    }

    public static function downloadFile($pathToFile){
		if (file_exists($pathToFile)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($pathToFile));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($pathToFile));
			if (ob_get_length()) ob_clean();
			flush();
			readfile($pathToFile);
			Yii::app()->end();
		}
    }

    /**
	 * Возвращает сумму прописью
	 * @author runcore
	 * @uses morph(...)
	 */
	public static function num2str($num) {
	    $nul='ноль';
	    $ten=array(
	        array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
	        array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
	    );
	    $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
	    $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
	    $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
	    $unit=array( // Units
	        array('копейка' ,'копейки' ,'копеек',	 1),
	        array('рубль'   ,'рубля'   ,'рублей'    ,0),
	        array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
	        array('миллион' ,'миллиона','миллионов' ,0),
	        array('миллиард','милиарда','миллиардов',0),
	    );
	    //
	    list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
	    $out = array();
	    if (intval($rub)>0) {
	        foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
	            if (!intval($v)) continue;
	            $uk = sizeof($unit)-$uk-1; // unit key
	            $gender = $unit[$uk][3];
	            list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
	            // mega-logic
	            $out[] = $hundred[$i1]; # 1xx-9xx
	            if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
	            else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
	            // units without rub & kop
	            if ($uk>1) $out[]= self::morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
	        } //foreach
	    }
	    else $out[] = $nul;
	    $out[] = self::morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
	    $out[] = $kop.' '.self::morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
	    return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));

	}

	/**
	 * Склоняем словоформу
	 * @ author runcore
	 */
	private static function morph($n, $f1, $f2, $f5) {
	    $n = abs(intval($n)) % 100;
	    if ($n>10 && $n<20) return $f5;
	    $n = $n % 10;
	    if ($n>1 && $n<5) return $f2;
	    if ($n==1) return $f1;
	    return $f5;
	}

	public static function getDDListForModel($model, $relModel, $attr, $id='id', $value='name'){

		$items = call_user_func(array($relModel, 'model'))->findAll();

		return TbHtml::activeDropDownList($model, $attr, array('' => 'Нет') + CHtml::listData($items, $id, $value));
	}

	public static function getCondition($key,$value)
	{
	
		$condition="";
		$criteria=new CDbCriteria;
		switch ($key) {

			case 'MoreEqual':
				{
					foreach ($value as $key_gr => $value_gr) {

						if (!empty($value_gr))
							$criteria->addCondition($key_gr .'>='. $value_gr);
					}
				}
				break;
			case 'LessEqual':
				{
					foreach ($value as $key_gr => $value_gr) {

						if (!empty($value_gr))
							$criteria->addCondition($key_gr .'<='. $value_gr);
					}
				}
				break;
			case 'equal':
				{
					foreach ($value as $key_gr => $value_gr) {

						if (!empty($value_gr))
							$criteria->addCondition($key_gr .'='. $value_gr);
					}
				}
				break;
		}

		return $criteria->condition;
	}

	public static function getNestedModels($params)
	{
		switch ($params['model']) {
			case 'carBrands':
				{
					return CarBrands::model()->findAll($params['column'].'=:id',array(':id'=>$params['value']));
				}
				break;
			case 'carModels':
				{
					return CarModels::model()->findAll($params['column'].'=:id',array(':id'=>$params['value']));
				}
				break;
			default:
				{
					return array();
				}
				break;
		}
	}

	public static function getHtmlOptions($modelName)
	{
		switch ($modelName) {
			case 'carBrands':
				{
					return CarBrands::getHtmlOptions();
				}
				break;
			case 'carModels':
				{
					return CarModels::getHtmlOptions();
				}
				break;
			default:
				{
					return array();
				}
				break;
		}
	}
}