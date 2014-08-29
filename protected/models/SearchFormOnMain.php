<?
	class SearchFormOnMain extends CFormModel{

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
		public $diametr_st;
		public $criteria;
		public $parent;
		public $force_st=0;
		public $force_end=1000;
		public $type=1;
		public $id_country;
		public $sort=price_sell;
		public $display=20;
		public function rules() {
			
			return array(
				array('bascet, brand, id_country, display, scenario, sort, type, transmission, car_model_id, price_st, price_end, state, mileage_st, mileage_end, year_st, year_end, category_id, parent', 'required'),

				array('bascet, scenario, car_model_id, brand, transmission, price_st, price_end, state, mileage_st, mileage_end, year_st, year_end, forse_st, forse_end, type', 'getLightCars', 'on'=>'light'),

				array('id_country, scenario, car_model_id, brand, price_st, price_end, state, mileage_st, mileage_end, year_st, year_end, forse_st, forse_end, type', 'getWeightCars', 'on'=>'weight'),

				array('bascet, scenario, car_model_id, brand, category_id, price_st, price_end, type', 'getParts', 'on'=>'parts'),

				array('deametr', 'getDiscs', 'on'=>'disc'),

				array('bascet, brand, scenario, transmission, price_st, price_end, state, mileage_st, mileage_end, year_st, year_end', 'safe', 'on'=>'search'),
			);
		}

		public function beforeValidate()
		{

			$this->setScenario($this->scenario);
			$url='';
			foreach ($this->attributes as $key => $value) {
				if ($value)
					$url.='SearchFormOnMain['.$key.']='.$value.'&';
			}
			
			Yii::app()->session->add('backToResult',substr($url, 0,-1));

			return parent::beforeValidate();
		}
		
		public function afterValidate()
		{
			if (empty($this->criteria->condition))
			{
				$this->criteria=new CDbCriteria;
				$this->criteria->addCondition('car_type='.($this->scenario=="light" ? 1 : 2));
				$this->criteria->join=$this->type==1 ? UsedCars::join() : Parts::join();
			}
			$this->criteria->order=$this->sort.', status!=3';

			return true;
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
				$criteria->addCondition('year>='.$this->year_st);
			}

			if ($this->year_end)
			{
				$criteria->addCondition('year<='.$this->year_end);
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
				$criteria->addCondition('year>='.$this->year_st);
			}

			if ($this->year_end)
			{
				$criteria->addCondition('year<='.$this->year_end);
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
			$properties=array('id_country','brand','car_model_id');

			$type=$this->scenario=="light" ? 1 : 2;

			foreach ($properties as $key => $value) {
				
				if (!empty($this->$value))
				{
					$column=$value;
				}
			}
			if (!$column){

				$this->criteria=new CDbCriteria;

				return;
			}

			$category=$this->category_id ? $this->category_id : ($this->parent  ? $this->parent : 0);

			$params=$category ? array('model_id'=>$this->$column,'cat_id'=>$category) : $this->$column;

			$column=$category ? 'model_cat' : $column;

			$criteria=Parts::model()->search_parts($column,$params);
			$type=$this->scenario=="light" ? 1 : 2;
			$criteria->addCondition('car_type='.$type);
			$this->criteria=$criteria;
		}

		public function getDiscs()
		{
			$properties=array('price_, brand, transmission, state');
			$criteria=new CDbCriteria;
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
		
		/**
		 * Verify Old Password
		 */
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