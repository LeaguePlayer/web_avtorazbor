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
				'parts' => array( 'parts', 'carBrands', 'carModels', 'categories'),
				'documents' => array('documents', 'templates'),
				'requests' => array('requests', 'clients', 'employees'),
				'settings' => array('settings', 'download'),
				'manage' =>array('page','news','bookPart','questions','ownprice','vacansy'),
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
			
			$module = $this->getModule()->name;

			$menuItems = array(
                array('label'=>'Кабинет заявок', 'url'=>'/admin/requests'),
				array('label'=>'Каталог автозапчасти с разбора', 'url'=>'/admin/parts'),
				array('label'=>'Продажа авто под ремонт', 'url'=>'/admin/usedCars'),
				array('label'=>'Документы', 'url'=>'/admin/documents'),
				array('label'=>'Пользователи', 'url'=>'/user/admin'),
				array('label'=>'Настройки', 'url'=>'/admin/settings'),
				array('label'=>'Управление сайтов','url'=>'/admin/page',
					
				)
			);

			$subItems = array(
				'parts' => array(
					array('label'=>'Запчасти', 'url'=>'/admin/parts'),
					array('label'=>'Аналоги', 'url'=>'/admin/analogs'),
					array('label'=>'Бренды', 'url'=>'/admin/carBrands'),
					array('label'=>'Страны', 'url'=>'/admin/country'),
					array('label'=>'Модели', 'url'=>'/admin/carModels'),
					array('label'=>'Категории запчастей', 'url'=>'/admin/categories'),
					array('label'=>'Утилизированные запчасти', 'url'=>'/admin/parts/utilizationList'),
					array('label'=>'Склады', 'url'=>'/admin/locations'),
					array('label'=>'Поставщики', 'url'=>'/admin/suppliers'),
				),
				'documents' => array(
					array('label'=>'Все документы', 'url'=>'/admin/documents'),
					array('label'=>'Шаблоны', 'url'=>'/admin/templates')
				),
				'requests' => array(
					array('label'=>'Журнал заказов', 'url'=>'/admin/requests'),
					array('label'=>'Клиенты', 'url'=>'/admin/clients'),
					array('label'=>'Сотрудники', 'url'=>'/admin/employees'),
				),
				'settings' => array(
					array('label'=>'Все настройки', 'url'=>'/admin/settings'),
					//array('label'=>'Скачать приложение', 'url'=>'/admin/settings/downloadApp'),
					array('label'=>'Скачать старое приложение', 'url'=>'/admin/settings/downloadOldApp'),
					array('label'=>'Скачать новое приложение', 'url'=>'/admin/settings/downloadNewApp'),
				),
				'manage'=>array(
					array('label'=>'Вакансии', 'url'=>'/admin/vacansy/list'),
					array('label'=>'Страницы', 'url'=>'/admin/page/list'),
					array('label'=>'Новости', 'url'=>'/admin/news/list'),					
					array('label'=>'Заказ деталей', 'url'=>'/admin/bookPart/list'),
					array('label'=>'Вопросы', 'url'=>'/admin/questions/list'),
					array('label'=>'Предложения', 'url'=>'/admin/ownprice/list'),
					array('label'=>'Диагностика', 'url'=>'/admin/diagnostic/list'),
					array('label'=>'Услуги эвакуатора', 'url'=>'/admin/evackuator/list'),
				),
				
					
			);


			$userModuleItems = array(
				array('label'=>'Права доступа', 'url'=>'/auth/assignment')
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
					'items'=>($module != 'user' && $module != 'auth') ? $subItems[$root] : $userModuleItems,
				),
			),
			'htmlOptions' => array(
				'class' => 'sub-main-menu'
			)
		)); ?>
		<div class="container-fluid">
			<?php echo $content; ?>
		</div>
	</body>
</html>
