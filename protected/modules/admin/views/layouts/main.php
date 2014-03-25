<!DOCTYPE html>
<html lang="en" ng-app="razborApp">
	<head>
	  <meta charset="utf-8">
	  <title><?php echo CHtml::encode(Yii::app()->name).' | Admin';?></title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
	 <style>.no-float{float: none !important;}</style>
		<?php
			$map = array(
				'parts' => array( 'parts', 'carBrands', 'carModels', 'categories', 'usedCars'),
				'documents' => array('documents', 'templates'),
				'requests' => array('requests', 'clients', 'employees')
			);

			$root = 'parts';
			$end = false;

			foreach ($map as $name => $node) {
				
				if(is_array($node) && !$end){
					foreach ($node as $n) {
						if($this->getId() == $n) {
							$root = $name;
							$end = true;
							break;
						}
					}
				}else break;
			}

			$menuItems = array(
                array('label'=>'Кабинет заявок', 'url'=>'/admin/requests'),
				array('label'=>'Авто ассортимент', 'url'=>'/admin/parts'),
				array('label'=>'Документы', 'url'=>'/admin/documents'),
				array('label'=>'Настройки', 'url'=>'/admin/settings'),
			);

			$subItems = array(
				'parts' => array(
					array('label'=>'Запчасти', 'url'=>'/admin/parts'),
					array('label'=>'Аналоги', 'url'=>'/admin/analogs'),
					array('label'=>'Бренды', 'url'=>'/admin/carBrands'),
					array('label'=>'Модели', 'url'=>'/admin/carModels'),
					array('label'=>'Категории запчастей', 'url'=>'/admin/categories'),
					array('label'=>'Б/У автомобили', 'url'=>'/admin/usedCars'),
					array('label'=>'Утилизированные запчасти', 'url'=>'#'),
				),
				'documents' => array(
					array('label'=>'Все документы', 'url'=>'/admin/documents'),
					array('label'=>'Шаблоны', 'url'=>'/admin/templates')
				),
				'requests' => array(
					array('label'=>'Заявки', 'url'=>'/admin/requests'),
					array('label'=>'Клиенты', 'url'=>'/admin/clients'),
					array('label'=>'Сотрудники', 'url'=>'/admin/employees'),
				)
			);
		?>
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
			'color'=>'inverse', // null or 'inverse'
			'brandLabel'=> '',
			'brandUrl'=>'/',
			'fluid' => true,
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
				array(
					'class'=>'bootstrap.widgets.TbNav',
					'items'=>$menuItems,
				),
				array(
					'class'=>'bootstrap.widgets.TbNav',
					'htmlOptions'=>array('class'=>'pull-right'),
					'items'=>array(
						array('label'=>'Выйти', 'url'=>'/admin/user/logout'),
					),
				),
			),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
			'brandLabel'=> '',
			'brandUrl'=>'/',
			'fluid' => true,
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
				array(
					'class'=>'bootstrap.widgets.TbNav',
					'items'=>$subItems[$root],
				),
			),
			'htmlOptions' => array(
				'class' => 'sub-main-menu'
			)
		)); ?>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span1">
				<?php $this->widget('bootstrap.widgets.TbNav', array(
					'type' => TbHtml::NAV_TYPE_TABS,
					'stacked' => true,
					'items'=> $this->menu
					)); ?>
				</div>
				<div class="span11">
					<?php echo $content;?>
				</div>
			</div>
		</div>
	</body>
</html>
