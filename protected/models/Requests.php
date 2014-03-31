<?php

/**
* This is the model class for table "{{Requests}}".
*
* The followings are the available columns in table '{{Requests}}':
    * @property integer $id
    * @property integer $client_id
    * @property integer $check_user_id
    * @property integer $from
    * @property integer $status
    * @property string $create_time
    * @property string $update_time
*/
class Requests extends EActiveRecord
{
    const FROM_SITE = 0;
    const FROM_ADMIN = 1;

    // Статусы в базе данных
    const STATUS_PUBLISH = 1;
    const STATUS_CANCELED = 2;
    const STATUS_PARTS_RESERVED = 3;
    const STATUS_WAIT_BUY = 4;
    const STATUS_BROKEN = 5;
    const STATUS_SUCCESS = 6;
    const STATUS_DEFAULT = self::STATUS_PUBLISH;

    private static $_fromList = array(
        self::FROM_SITE => 'Интернет',
        self::FROM_ADMIN => 'Система'
    );

    public $removeOnDelete = true;

    private $oldAttributes = array();

    public function init(){

        $this->oldAttributes = $this->attributes;

        parent::init();
    }

    public static function getStatusAliases($status = -1)
    {
        $aliases = array(
            self::STATUS_PUBLISH => 'Формирование',
            self::STATUS_CANCELED => 'Отменена',
            self::STATUS_PARTS_RESERVED => 'Стоит на резерве',
            self::STATUS_WAIT_BUY => 'Ожидает оплаты',
            self::STATUS_BROKEN => 'Расформирована',
            self::STATUS_SUCCESS => 'Оплачено',
            // self::STATUS_REMOVED => 'Удален',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }

    public function tableName()
    {
        return '{{Requests}}';
    }


    public function rules()
    {
        return array(
            array('client_id, date_life', 'required'),
            array('client_id, check_user_id, from, status, user_id', 'numerical', 'integerOnly'=>true),
            array('create_time, update_time, date_life', 'safe'),
            // The following rule is used by search().
            array('id, client_id, check_user_id, from, status, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'client' => array(self::BELONGS_TO, 'Clients', 'client_id'),
            'employee' => array(self::BELONGS_TO, 'Employees', 'check_user_id'),
            'parts' => array(self::MANY_MANY, 'Parts', '{{PartsInRequest}}(request_id, part_id)'),
            'parts_in_util' => array(self::MANY_MANY, 'Parts', '{{CheckUtilization}}(req_id, part_id)'),
            'logs' => array(self::HAS_MANY, 'RequestLogs', 'request_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'Номер заявки',
            'client_id' => 'Клиент',
            'check_user_id' => 'Кто проверил наличие',
            'from' => 'Источник',
            'status' => 'Состояние',
            'user_id' => 'Пользователь',
            'date_life' => 'Дата, когда заявка будет расформирована',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        	'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
			),
        ));
    }
    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
        $criteria->compare('client_id',$this->client_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('check_user_id',$this->check_user_id);
		$criteria->compare('from',$this->from);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

        $criteria->order = 'create_time DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition()
    {
        return 'Заявки';
    }

    public function getFrom(){
        return self::$_fromList[$this->from];
    }

    public static function getValueFrom($val){
        if(isset(self::$_fromList[$val])) return self::$_fromList[$val];

        return self::$_fromList[1];
    }

    public function getFromListItem($i){
        
        switch ($i) {
            case self::FROM_SITE:
                return self::$_fromList[self::FROM_SITE];
            case self::FROM_ADMIN:
                return self::$_fromList[self::FROM_ADMIN];
            default:
                return self::$_fromList[self::FROM_SITE];
        }
    }

    public static function getFromList(){
        return self::$_fromList;
    }

    public function afterSave(){

        if($this->status == Requests::STATUS_BROKEN || $this->status == Requests::STATUS_CANCELED || $this->status == Requests::STATUS_PUBLISH){
            foreach ($this->parts as $part) {
                $part->status = Parts::STATUS_PUBLISH;
                $part->update(array('status'));
            }

            //delete task from cron
            $this->deleteTaskFromCron();
        }

        //оплачено
        if($this->status == Requests::STATUS_SUCCESS){
            foreach ($this->parts as $part) {
                $part->status = Parts::STATUS_SUCCESS;
                $part->update(array('status'));
            }

            //delete task from cron
            $this->deleteTaskFromCron();
        }

        parent::afterSave();
    }

    public function beforeSave(){

        //log attributes
        $this->compareNewAndOldAttributes();

        return parent::beforeSave();
    }

    public function afterDelete(){

        foreach ($this->parts as $part) {
            if($part->status == Parts::STATUS_RESERVED){
                $part->status = Parts::STATUS_PUBLISH;
                $part->update(array('status'));
            }
        }

        $dbCommand = Yii::app()->db->createCommand();

        $dbCommand->delete('{{PartsInRequest}}', 'request_id=:r_id', array(':r_id' => $this->id));
        $dbCommand->delete('{{CheckUtilization}}', 'req_id=:r_id', array(':r_id' => $this->id));
        $dbCommand->delete('{{RequestLogs}}', 'request_id=:r_id', array(':r_id' => $this->id));

        //delete task from cron
        $this->deleteTaskFromCron();

        parent::afterDelete();
    }

    public function cancel(){ //set status STATUS_CANCELED
        $this->status = Requests::STATUS_CANCELED;
        $this->update(array('status'));
    }

    public function publish(){ //set status STATUS_PUBLISH
        $this->status = Requests::STATUS_PUBLISH;
        $this->update(array('status'));
    }

    public function deleteTaskFromCron(){
        $cron = new Crontab('cron_requests'); // my_crontab file will store all added jobs

        $jobs_obj = $cron->getJobs(); // previous jobs saved in my_crontab

        foreach($jobs_obj as $k => $job){
            //print_r($job);
            $command = $job->getCommand();
            $find = '--id='.$this->id;

            if($find == substr($command, -1 * strlen($find)))
                $cron->deleteJob($k);
        }

        $cron->saveCronFile(); // save to my_crontab cronfile
        $cron->saveToCrontab(); // adds all my_crontab jobs to system (replacing previous my_crontab jobs)
    }

    public function beforeValidate(){
        
        if($this->date_life){
            $date = \DateTime::createFromFormat('d.m.Y H:i', $this->date_life);
            $this->date_life = $date->format('Y-m-d H:i:s');
        }

        return parent::beforeValidate();
    }

    public function afterFind(){
        parent::afterFind();

        //save old attributes
        $this->oldAttributes = $this->attributes;

        if($this->date_life){
            $date = \DateTime::createFromFormat('Y-m-d H:i:s', $this->date_life);
            $this->date_life = $date->format('d.m.Y H:i');
        }
    }

    /**
     * Magic function )) Hell Yeah!!!
     * Я переписывал ее несколько раз, так что тебе не советую ее вобще трогать, работает и работает :)
     */
    public function compareNewAndOldAttributes($exclude = array('create_time', 'update_time', 'user_id')){
        $result = array();
        $msg = array();

        $requestLog = new RequestLogs;
        $requestLog->user_id = Yii::app()->user->id;
        $requestLog->request_id = $this->id;

        foreach ($this->attributes as $attrName => $attrValue) {
            echo $attrName.' - '.$attrValue.'<br>';

            if(!in_array($attrName, $exclude) && !$this->oldAttributes[$attrName] && $attrValue){ //new Instance Request

                switch ($attrName) {
                    case 'from':
                        $msg[] = 'Установлено свойство ('.$this->getAttributeLabel($attrName).') в <strong>'.$this->getFrom().'</strong>';
                        break;
                    case 'status':
                        $msg[] = 'Установлено свойство ('.$this->getAttributeLabel($attrName).') в <strong>'.self::getStatusAliases($attrValue).'</strong>';
                        break;
                     case 'date_life':
                        $date = new DateTime($attrValue);
                        $msg[] = 'Установлено свойство ('.$this->getAttributeLabel($attrName).') в <strong>'.$date->format('d.m.Y H:i').'</strong>';
                        break;
                    case 'client_id':
                        //$client = Clients::model()->findByPk($attrValue);
                        $name = $this->client->type == Clients::CLIENT_UR ? $this->client->info->name_company : $this->client->fio;
                        $msg[] = 'Установлено свойство ('.$this->getAttributeLabel($attrName).') в <strong>'.$name.'</strong>';
                        break;
                    case 'check_user_id':
                        //$client = Clients::model()->findByPk($attrValue);
                        $name = $this->employee->fio;
                        $msg[] = 'Установлено свойство ('.$this->getAttributeLabel($attrName).') в <strong>'.$name.'</strong>';
                        break;
                }
            }elseif(!in_array($attrName, $exclude) && $this->oldAttributes[$attrName] && $attrValue){ //change request

                $oldVal = $this->oldAttributes[$attrName];
                
                if($attrValue != $this->oldAttributes[$attrName]){
                    switch ($attrName) {
                        case 'from':
                            $msg[] = 'Значение свойства ('.$this->getAttributeLabel($attrName).') изменено с <strong>'.self::getValueFrom($oldVal).'</strong> на <strong>'.$this->getFrom().'</strong>';
                            break;
                        case 'status':
                            $msg[] = 'Значение свойства ('.$this->getAttributeLabel($attrName).') изменено с <strong>'.self::getStatusAliases($oldVal).'</strong> на <strong>'.self::getStatusAliases($attrValue).'</strong>';
                            break;
                        case 'date_life':
                            $newDate = new DateTime($attrValue);
                            $oldDate = new DateTime($attrValue);

                            $msg[] = 'Значение свойства ('.$this->getAttributeLabel($attrName).') изменено с <strong>'.$oldDate->format('d.m.Y H:i').'</strong> на <strong>'.$newDate->format('d.m.Y H:i').'</strong>';
                            break;
                        case 'client_id':
                            $oldClient = Clients::model()->findByPk($this->oldAttributes[$attrName]);

                            $oldName = $oldClient->type == Clients::CLIENT_UR ? $oldClient->info->name_company : $oldClient->fio;
                            $newName = $this->client->type == Clients::CLIENT_UR ? $this->client->info->name_company : $this->client->fio;

                            $msg[] = 'Значение свойства ('.$this->getAttributeLabel($attrName).') изменено с <strong>'.$oldName.'</strong> на <strong>'.$newName.'</strong>';
                            break;
                        case 'check_user_id':
                            $oldEmployee = Employees::model()->findByPk($this->oldAttributes[$attrName]);

                            $newName = $this->employee->fio;
                            $oldName = $oldEmployee->fio;

                            $msg[] = 'Значение свойства ('.$this->getAttributeLabel($attrName).') изменено с <strong>'.$oldName.'</strong> на <strong>'.$newName.'</strong>';
                            break;
                    }  
                }
            }
        }

        $requestLog->message = implode("<br>\n", $msg);
        $requestLog->save();
    }
}
