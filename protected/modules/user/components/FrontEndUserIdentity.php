<?
class FrontEndUserIdentity extends CUserIdentity
{
    private $_id;
    public function authenticate()
    {
        
        $attr=strpos($this->username,'@') ? 'email' : 'username';
        $record=User::model()->findByAttributes(array($attr=>$this->username));
        if($record->attributes===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(CPasswordHelper::verifyPassword(Yii::app()->getModule('user')->encrypting($this->password),$record->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->id;
            $this->setState('id', $record->id);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
}
?>