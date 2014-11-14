<?
	class NoticeBehavior extends CActiveRecordBehavior 
	{

		public $type='NoticeAdmin';
		public $viewAction='view';
		public $contentField="content";
		public $noticeMap=array(
			'NoticeAdmin'=>array(
				'settingName'=>'admin_mail',
				),
		); //admin_notice - уникальное имя настройки из таблицы Settings

		public function sand(){

			$modelName=strtolower(get_class($this->owner));
			$template=EmailTemplates::model()->findByAttributes(array('model_name'=>$modelName));
			$field=$this->contentField;
			$message=$template->$field;
			$to=Settings::getValue($this->noticeMap[$this->type]['settingName']);
			$from="Заявка с сайта «".Yii::app()->name."»";

			foreach ($this->owner->attributeLabels() as $key => $label) {
				$message=str_replace("{{$key}}", $this->owner->$key, $message);
			}
			SiteHelper::sendMail($template->subject,$message,$to,$from);
		}

		public function AfterSave($event){
			parent::afterSave($event);
			$this->sand();
		}
	}
?>