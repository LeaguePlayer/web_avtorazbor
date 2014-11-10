<?
	class NoticeBehavior extends CActiveRecordBehavior 
	{

		public $type='NoticeAdmin';
		public $viewAction='view';
		public $noticeMap=array(
			'NoticeAdmin'=>array(
				'settingName'=>'admin_mail',
					'fields'=>array(
					'id'=>false,
					'status'=>false,
	            	'sort'=>false,
	            	//'create_time',
	            	'update_time'=>false,
				),

			)
		); //admin_notice - уникальное имя настройки из таблицы Settings

		public function AfterSave($event){
			parent::afterSave($event);
			$this->sand();
		}

		public function sand(){
			
			$model=$this->owner;
			$subject='Новая заявка из раздела '.$model->translition();
			$attributesLabels=$model->attributeLabels();

			foreach ($model->attributes as $field => $value) {
				if ($this->noticeMap[$this->type]['fields'][$field]===null)
				{
					$message.=$attributesLabels[$field].': '.$value.'<br>';
				}
			}

			$modelName=get_class($model);
			$message.='<a href="/admin/'.$modelName.'/'.$this->viewAction.'/id/'.$model->id.'">Перейти к просмотру</a>';
			$to=Settings::getValue($this->noticeMap[$this->type]['settingName']);
			$from="Заявка с сайта «".Yii::app()->name."»";
			SiteHelper::sendMail($subject,$message,$to,'');
		}
	}
?>