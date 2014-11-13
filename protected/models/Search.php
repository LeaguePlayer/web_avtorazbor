<?
	class Search extends CFormModel{

		public $brand;
		public $bascet;
		public $transmission;
		public $price_st=50;
		public $price_end=3000000;
		public $state;
		public $mileage_st;
		public $mileage_end;
		public $car_model_id;
		public $category_id;
		public $year_st;
		public $year_end;
		public $scenario='light';
		public $diametr_st=14;
		public $diametr_end=25;
		public $criteria;
		public $parent;
		public $force_st=0;
		public $force_end=1000;
		public $type=1;
		public $id_country;
		public $sort;
		public $display=20;

		public function rules() {
			return array(
				array('bascet, brand, id_country, display, scenario, sort, type, transmission, car_model_id, price_st, price_end, state, mileage_st, mileage_end, year_st, year_end, category_id, diametr_st, diametr_end, parent', 'required'),

				array('bascet, scenario, car_model_id, brand, transmission, price_st, price_end, state, mileage_st, mileage_end, year_st, year_end, forse_st, forse_end, type', 'getLightCars', 'on'=>'light'),

				array('id_country, scenario, car_model_id, brand, price_st, price_end, state, mileage_st, mileage_end, year_st, year_end, forse_st, forse_end, type', 'getWeightCars', 'on'=>'weight'),

				array('bascet, scenario, car_model_id, brand, category_id, price_st, price_end, type', 'getParts', 'on'=>'parts'),

				array('diametr_st,diametr_end,price_st,price_end', 'getDiscs', 'on'=>'disc'),

				array('bascet, brand, scenario, transmission, price_st, price_end, state, mileage_st, mileage_end, year_st, year_end', 'safe', 'on'=>'search'),
			);
		}

		public function beforeValidate()
		{
			$this->setScenario($this->scenario);
			
			$url='';
			if ($this->id_country || $this->brand)
			{
				foreach ($this->attributes as $key => $value) {
					if ($value)
						$url.='Search['.$key.']='.$value.'&';
				}
				Yii::app()->session->add('backToResult',substr($url, 0,-1));
			} else {
				Yii::app()->session->remove('backToResult');
			}

			if (!$this->type)	
				$this->type=1;
			
			
			return parent::beforeValidate();
		}
		
		public function afterValidate()
		{
			parent::afterValidate();
			if (empty($this->criteria->condition))//если не выбран ни 1 криерий тогда пишем дефолт
			{
				$this->criteria=new CDbCriteria;
			}

			if ($this->scenario=="parts" || $this->scenario=="disc")
				$this->criteria->addCondition('`t`.status=7 or `t`.status=1');//>6 - для машин =1 - для запчастей
			else 
				$this->criteria->addCondition('`t`.status=2');//>6 - для машин =1 - для запчастей

			$this->criteria->distinct='`t`.id';
			$this->criteria->order= $this->scenario=='parts' && !$this->sort ? 'create_time' : $this->sort ;

			return true;
		}

		public static function checkWerbInCome($str,$query)
		{
			$werbs=explode(' ',strtolower($str));
			
			foreach ($werbs as $key => $data) {
				if (strpos($query,$data)===false)
					return false;
			}
			return true;
		}



		public static function searchByStr($str,$table)
		{

			$result=Yii::app()->db->createCommand()
				->select('id, name, MATCH (name) AGAINST (:str IN BOOLEAN MODE) as REL')
				->from("tbl_$table")
				->where('MATCH (name) AGAINST (:str IN BOOLEAN MODE) > 0',array(':str'=>$str))
				->order('rel desc')
				->queryAll();
			$criteria=new CDbCriteria;
			$iDs=array();

			foreach ($result as $key => $data) {
					$iDs[]=$data['id'];
			}
			if ($result)
				$criteria->addInCondition('t.id',$iDs);
			else 
				$criteria->addCondition('t.id=-1');

			return new CActiveDataProvider($table,
				array(
					'criteria'=>$criteria,
					'pagination'=>array('pageSize'=>10)
				)
			);
		}

		public function getCriteria($properies)
		{
			$criteria=new CDbCriteria;

			foreach ($properies as $key => $value) {
				if (!empty($this->$value))
				{
					$criteria->addCondition($value.'='.$this->$value);
				}
			}
			$priceColumn=$this->type==2 ? 'price_sell' : 'price';
			if ($this->price_st)
				$criteria->addCondition("`t`.$priceColumn>=$this->price_st");
			if ($this->price_end)
				$criteria->addCondition("`t`.$priceColumn<=$this->price_end");
			return $criteria;
		}

		public function getLightCars()
		{
			$properties=array('id_country', 'bascet', 'brand','car_model_id', 'transmission', 'state');
			$criteria=$this->getCriteria($properties);

			if ($this->year_st)
			{
				$criteria->addCondition('t.year>='.$this->year_st);
			}

			if ($this->year_end)
			{
				$criteria->addCondition('t.year<='.$this->year_end);
			}

			if ($this->mileage_st)
			{
				$criteria->addCondition('mileage>='.$this->mileage_st);
			}

			if ($this->mileage_end)
			{
				$criteria->addCondition('mileage<='.$this->mileage_end);
			}
			$criteria->addCondition('car_type=1');
			$criteria->join=UsedCars::join();
			$this->criteria = $criteria;

		}

		public function getWeightCars()
		{
			$properties=array('id_country', 'brand', 'car_model_id', 'state');
			$criteria=$this->getCriteria($properties);
			if ($this->year_st)
			{
				$criteria->addCondition('t.year>='.$this->year_st);
			}

			if ($this->year_end)
			{
				$criteria->addCondition('t.year<='.$this->year_end);
			}

			if ($this->mileage_st)
			{
				$criteria->addCondition('mileage>='.$this->mileage_st);
			}

			if ($this->mileage_end)
			{
				$criteria->addCondition('mileage<='.$this->mileage_end);
			}

			$criteria->addCondition('car_type=2');
			$criteria->join=UsedCars::join();
			$this->criteria = $criteria;
			
		}

		public function getParts()
		{
			$this->criteria=new CDbCriteria;
			$this->criteria->addCondition('car_type='.$this->type);
			$this->criteria->join=Parts::join();
			$properties=array('id_country','brand','car_model_id');

			foreach ($properties as $key => $value) {
				
				if (!empty($this->$value))
				{
					$column=$value;
				}
			}

			if ($column){//если не выбран не 1 из критериев фильтра
				$this->criteria->order=$this->sort;
				$category=$this->category_id ? $this->category_id : ($this->parent  ? $this->parent : 0);
				$params=$category ? array('model_id'=>$this->$column,'cat_id'=>$category) : $this->$column;
				$column=$category ? 'model_cat' : $column;
				$criteria=Parts::model()->search_parts($column,$params);
			}
			$criteria=$this->criteria;

			if ($this->price_st)
			{
				$criteria->addCondition('price_sell>=:price_st');
				$criteria->params[':price_st']=$this->price_st;
			}
			if ($this->price_end)
			{
				$criteria->addCondition('price_sell<=:price_end');
				$criteria->params[':price_end']=$this->price_end;
			}
			if ($this->car_model_id)
			{	
				$select="`t`.id,`t`.name,`t`.alias, `t`.price_sell,`t`.price_buy,`t`.comment,`t`.category_id,`t`.car_model_id,`t`.location_id,`t`.supplier_id,`t`.create_time,`t`.update_time,`t`.status";

				$select.=',`t`.car_model_id!='.$this->car_model_id.' as analog';
				$criteria->select=$select;
				if (!empty($this->category_id))
					$criteria->addCondition('category_id='.$this->category_id);
				if (!empty($this->parent))
					$criteria->addCondition('parent='.$this->parent);
			}
			//var_dump($criteria->condition);die();
			$this->criteria=$criteria;
		}

		public function getDiscs()
		{
			$this->criteria=Parts::model()->Disc($this->diametr_st,$this->diametr_end,$this->category_id);
			$this->criteria->addCondition('price_sell>='.$this->price_st.' and price_sell<='.$this->price_end);
			//var_dump($this->criteria->condition);die();
			return true;
		}

		public function attributeLabels()
		{
			return array(
				'cuntry'=>'Страна',
				'brand'=>'Марка авто',
				'model'=>'Модель',
				'category_id'=>'Раздел',
				'parent'=>'Подраздел',
				'price'=>'Цена (руб.)'
			);
		}
		
		public function verifyOldPassword($attribute, $params)
		{
			if (Clients::model()->findByPk(Yii::app()->user->id)->password != Yii::app()->getModule('user')->encrypting($this->$attribute))
			{
			 	$this->addError($attribute, "Old Password is incorrect.");
				Yii::app()->user->setFlash('error', "Не верный старый пароль!");
			}
		}
	}
?>