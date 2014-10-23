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
        $this->render('find',array('dataProvider'=>$dataProvider,'str'=>$str));
    }

}
?>