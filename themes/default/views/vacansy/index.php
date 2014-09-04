<?php
/* @var $this VacansyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vacansies',
);

$this->menu=array(
	array('label'=>'Create Vacansy', 'url'=>array('create')),
	array('label'=>'Manage Vacansy', 'url'=>array('admin')),
);
?>
<div class="page">

	<div class="wr">
		<h1>Вакансии</h1>
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			'itemsCssClass'=>'vacansy',
			'itemsTagName'=>'ul',
			'template'=>'{items}'
		)); ?>
	</div>
</div>



