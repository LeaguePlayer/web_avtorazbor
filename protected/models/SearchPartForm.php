<?
	class SearchPartForm extends CFormModel{

		public $cuntry;
		public $brand;
		public $model;
		public $price;
		public $category;
		public $parent_category;
		public $dataProvider;
		public function rules() {
			
			return array(
				array('cuntry, brand, model, price, category, parent_category', 'required'),
				array('cuntry, brand, model, price, category, parent_category', 'getDataProvider'),
			);
		}

		public function getDataProvider()
		{
			$properties=array('cuntry, brand, model, price');

			foreach ($properties as $key => $prop) {
				if ($this->$prop)
				{
					$curentProp[$prop]=$this->$prop;
					$curentProp['key']=$prop;
				}
			}

			$this->dataProvider=Parts::
		}

		public function attributeLabels()
		{
			return array(
				'cuntry'=>'Страна',
				'brand'=>'Марка авто',
				'model'=>'Модель',
				'category'=>'Раздел',
				'parent_category'=>'Подраздел',
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