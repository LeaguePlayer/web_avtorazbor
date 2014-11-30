<?
	class NoticeBehavior extends CActiveRecordBehavior 
	{

		public $type='NoticeAdmin';
		public $viewAction='view';
		public $contentField="content";
		public $url="";
		public $noticeMap=array(
			'NoticeAdmin'=>array(
				'settingName'=>'admin_mail',
				),
		); //admin_notice - уникальное имя настройки из таблицы Settings

		public function sand(){

			$modelName=strtolower(get_class($this->owner));
			$template=EmailTemplates::model()->findByAttributes(array('model_name'=>$modelName));
			$sender=Settings::getValue('sender');
			$field=$this->contentField;
			$message=$template->$field;
			$to=Settings::getValue($this->noticeMap[$this->type]['settingName']);

			foreach ($this->owner->attributeLabels() as $key => $label) {
				$message=str_replace("{{$key}}", $this->owner->$key, $message);
			}

			$this->url=$this->url ? $this->url : 
				Yii::app()->controller->createAbsoluteUrl('/').'/admin/'.get_class($this->owner).'/view/id/'.$this->owner->id;
			$message.="<a href=\"".$this->url."\">Прейти к просмотру</a>";
			SiteHelper::sendMail($template->subject,$message,$to,$sender);
		}

		public function AfterSave($event){
			parent::afterSave($event);
			$this->sand();
		}
	}
?>