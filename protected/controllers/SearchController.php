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

    public function actionFind($str,$table,$type=null)
    {
        $dataProvider=Search::searchByStr($str,$table);
        $this->render('find',array('dataProvider'=>$dataProvider,'str'=>$str,'model'=>$table));
    }

    public function actionAutoComplite($query,$table,$type)
    {
        $retVal = array();
        if (strlen($query) >= 2) {
            $model = $table::model();
         
            $criteria = new CDbCriteria();
            $criteria->select="t.name";
            $criteria->distinct=true;
            $criteria->join=$table::join();
            $criteria->compare('t.name', $query, true);
            $criteria->addCondition("car_type=$type");
            $criteria->limit = 10;
            $criteria->order="t.id desc";
            foreach($model->findAll($criteria) as $item) {
              $retVal[] = array(
                'value' => $item->name,
             );
           }
         }
         
         echo CJSON::encode(array('suggestions'=>$retVal));
         Yii::app()->end();
    }
}
?>