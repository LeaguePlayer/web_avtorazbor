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
            array('client_id', 'required'),
            array('client_id, check_user_id, from, status, user_id', 'numerical', 'integerOnly'=>true),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, client_id, check_user_id, from, status, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'client' => array(self::BELONGS_TO, 'Clients', 'client_id'),
            'employee' => array(self::BELONGS_TO, 'Employees', 'check_user_id'),
            'parts' => array(self::MANY_MANY, 'Parts', '{{PartsInRequest}}(request_id, part_id)')
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

        parent::afterSave();
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
}
