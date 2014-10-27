<?php

class SearchController extends Controller
{
    
    public function actionGetParts()
    {
        $str=$_POST['str'];
        $type=$_POST['type'];
        $dataProvider=Search::searchByStr($str,'Parts');
        $dataProvider->criteria->addCondition("car_type=$type");
        $dataProvider->criteria->join=Parts::join();
        $this->renderPartial('carusel',array('dataProvider'=>$dataProvider,'str'=>$str,'model'=>'Parts'));
        die();
    }

    public function actionGetCars()
    {
        $str=$_POST['str'];
        $type=$_POST['type'];
        $dataProvider=Search::searchByStr($str,'UsedCars');
        $dataProvider->criteria->addCondition("car_type=$type");
        $dataProvider->criteria->join=UsedCars::join();
        $this->renderPartial('carusel',array('dataProvider'=>$dataProvider,'str'=>$str,'model'=>'UsedCars'));
        die();
    }

    public function actionFind($str,$table)
    {
        $dataProvider=Search::searchByStr($str,$table);
        $this->render('find',array('dataProvider'=>$dataProvider,'str'=>$str,'model'=>$table));
    }
    public function actionAutoComplete($term,$table)
    {
        $retVal = array();
 
        if (strlen($term) >= 2) {
            $model = $table::model();
         
            $criteria = new CDbCriteria();
            $criteria->compare('name', $term, true);
            $criteria->limit = 10;
            $criteria->order="id desc";

            foreach($model->findAll($criteria) as $item) {
              $retVal[] = array(
                'label' => $item->some_field,
                'value' => $item->some_field,
                'id' => $item->id,
                'other_field' => $item->other_field,
                'another_field' => $item->another_field,
             );
           }
         }
         
         echo CJSON::encode($retVal);
         Yii::app()->end();
    }
}
?>