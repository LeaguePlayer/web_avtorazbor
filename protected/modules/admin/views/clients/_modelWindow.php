<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id' => 'client-modal',
    'header' => 'Modal Heading',
    'content' => $this->renderPartial('/clients/_form', array('model'=>$model, 'info' => $info, 'accounts' => $accounts), true),
    'footer' => array(
        // TbHtml::button('Save Changes', array('data-dismiss' => 'modal', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
        TbHtml::button('Close', array('data-dismiss' => 'modal')),
     ),
)); ?>