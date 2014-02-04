
	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'price_sell',array('class'=>'span8','maxlength'=>6)); ?>

	<?php echo $form->textFieldControlGroup($model,'price_buy',array('class'=>'span8','maxlength'=>6)); ?>

	<?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	
	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('category_id')?></label>
		<div class="controls">
			<?php $this->widget('ext.select2.ESelect2', array(
				'model'=>$model,
				'attribute'=>'category_id',
				'data'=>CHtml::listData(Categories::all(), 'id', 'name'),
				'options'=>array(
					'containerCssClass' => 'span8 no-float',
					// 'placeholder'=>'Категория',
				)
			)); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('car_model_id')?></label>
		<div class="controls">
			<?php $this->widget('ext.select2.ESelect2', array(
				'model'=>$model,
				'attribute'=>'car_model_id',
				'data'=>CHtml::listData(CarModels::brandModelsList(), 'id', 'name'),
				'options'=>array(
					'containerCssClass' => 'span8 no-float',
				)
			)); ?>
		</div>
	</div>

	<?php echo $form->dropDownListControlGroup($model,'location_id', Chtml::listData(Locations::all(), 'id', 'name'),array('class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'client_id',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Parts::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	
	<?php if($model->potantialAnalogs()):?>
	<fieldset>
		<legend>Аналоги</legend>
		<div class="control-group">
			<div class="controls">
				<div class="deleted"></div>
				<?php
				$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
					'asDropDownList' => true,
					'name' => 'Analogs',
					'data'=> CHtml::listData($model->potantialAnalogs(), 'id', 'name'),
					'values' => $model->analogsById($model->id),
					'pluginOptions' => array(
						'width' => '40%',
					),
					'htmlOptions' => array(
						'multiple' => 'multiple',
					)
				));

				$cs = Yii::app()->getClientScript();

				if($model->isNewRecord)
					$cs->registerScript('select2-callbacks','
						jQuery("#Analogs").on("removed", function(e){
							var $deleted = jQuery(".deleted");

							$deleted.append("<input class=\'a-"+e.val+"\' type=\'hidden\' name=\'Analogs_delete[]\' value=\'"+e.val+"\' >");
						});

						jQuery("#Analogs").on("selected", function(e){
							jQuery(".a-" + e.val).remove();
						});
					',CClientScript::POS_READY);
				else
					$cs->registerScript('select2-callbacks','
						jQuery("#Analogs").on("removed", function(e){
							jQuery.ajax({
								url: "/admin/parts/deleteAnalog",
								type: "POST",
								data: {id: e.val, part: '.$model->id.'},
								success: function(){
									jQuery.fn.yiiGridView.update("analogs-grid");
								}
							});
						});

						jQuery("#Analogs").on("selected", function(e){
							jQuery.ajax({
								url: "/admin/parts/addAnalog",
								type: "POST",
								data: {Analog: e.val, Part: '.$model->id.'},
								success: function(){
									jQuery.fn.yiiGridView.update("analogs-grid");
								}
							});
						});
					',CClientScript::POS_READY);
				?>
			</div>
		</div>
		<?php !$model->isNewRecord ? $this->renderPartial('_analogs', array('model' => $model, 'analogs' => $analogs)) : ''; ?>
	</fieldset>
	<?php endif; ?>

	<fieldset>
		<legend>Б/У автомобиль</legend>
		<div class="control-group">
			<div class="controls">
				<?php 
				// $val = isset($_POST['UsedCar']) && !empty($_POST['UsedCar']) ? $_POST['UsedCar'] : 0;
				
				$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
					'asDropDownList' => true,
					'name' => 'UsedCar',
					'data'=> CHtml::listData(UsedCars::allCars(), 'id', 'name'),
					'values' => array($model->usedCar ? $model->usedCar[0]->id : 0),
					'pluginOptions' => array(
						'containerCssClass' => 'span8 no-float',
					)
				));
				?>
			</div>
		</div>
	</fieldset>