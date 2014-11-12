<div class="jobs">
    <?
    if ($dataProvider->totalItemCount)
    {
    ?>
    <dl>
        <dt>
            Здравствуйте! В нашей фирме появились новые вакансии:
        </dt>
        <dd>
            <?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_view',
                'itemsTagName'=>'ol',
                'itemsCssClass'=>'vacansy',
                'template'=>'{items}'
			)); ?>
        </dd>
        <dt>
                <?=Settings::getValue('vacansy_info')?>
        </dt>
    </dl>

    <input href="#vacansyCallBack" type="submit" value="Обратная связь" class="i-submit modal"> 
    <?} else {?>
        <div class="empty-vacansy">
            На данный момент все вакансии заняты!
        </div>
    <?}?>
</div>

<?
    $this->renderPartial('//forms/vacansyCallBack',array('model'=>new VacansyCallBack));
?>