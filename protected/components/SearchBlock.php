<?php

Yii::import('zii.widgets.CPortlet');

class SearchBlock extends CPortlet
{
public $title='Поиск';

protected function renderContent()
  {
echo CHtml::beginForm(array('search/find'), 'get', array('style'=> 'inline')) .
      CHtml::textField('str', '', array('placeholder'=> 'search...','style'=>'width:140px;')) .
      CHtml::hiddenField('table', 'Parts', array('placeholder'=> 'search...','style'=>'width:140px;')) .
      CHtml::submitButton('Go!',array('style'=>'width:30px;')) .
      CHtml::endForm('');
  }
}
?>