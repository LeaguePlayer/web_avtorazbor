<div class="jobs">
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
                телефон для связи <br><strong>8-922-136-06-11</strong> Алексей, <br><strong>8-9222-922-923</strong> Сергей
        </dt>
    </dl>
    <input type="submit" value="Обратная связь" class="i-submit"> 
</div>
