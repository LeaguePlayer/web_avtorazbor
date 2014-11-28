<?php

class DeleteAction extends AdminAction
{
    public function run()
    {
    	$model=$this->getModel();
    	$model->delete();
        $this->redirect();
    }
}
