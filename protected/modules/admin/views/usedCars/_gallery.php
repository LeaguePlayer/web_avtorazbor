<div class='control-group'>
	<?php echo CHtml::activeLabelEx($model, 'gallery_id'); ?>
	<?php echo $form->hiddenField($model, 'gallery_id'); ?>
	<?php if ($model->galleryBehaviorGallery->getGallery() === null) {
		echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
	} else {
		$this->widget('appext.imagesgallery.GalleryManager', array(
			'gallery' => $model->galleryBehaviorGallery->getGallery(),
			'controllerRoute' => '/admin/gallery',
			)
		);
	} ?>
</div>