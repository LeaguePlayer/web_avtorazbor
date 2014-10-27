<?php

class PageController extends AdminController
{
	public function actionSetAliases($model=null)
    {   
        foreach (array('UsedCars','Parts') as $key => $data) {
            $models=Yii::app()->db->createCommand()
                ->select('id,name')
                ->from("tbl_$data")
                ->queryAll();
            foreach ($models as $key => $value) {
                Yii::app()->db->createCommand()
                    ->update("tbl_$data",array('alias'=>SiteHelper::translit($value['name'])),"id=".$value['id']);
            }
        }
        echo "Ок да";
        
    }
}
