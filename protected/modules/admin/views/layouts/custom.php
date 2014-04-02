<?php $this->beginContent('//../modules/admin/views/layouts/main'); ?>
<div class="row-fluid">
	<div class="span12" id="main-content">
		<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
		    'links'=>$this->breadcrumbs,
		    'homeUrl'=> '/admin'
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbNav', array(
		    'type' => TbHtml::NAV_TYPE_PILLS,
		    'items' => $this->menu,
		)); ?>
	    <?php echo $content; ?>
	</div>
</div>
<?php $this->endContent(); ?>