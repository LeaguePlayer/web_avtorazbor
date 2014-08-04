<ul>
<?
	if (!empty($category))
	{
		foreach ($category->attrs as $key => $value) {
		?>
			<li>
				<label><?=$value->attr?></label>
				<input type="text" class="span8" length="100" name="attr[<?=$value->id?>][value]" value="<?=$value->getValue($model_id)?>">
			</li>
		<?
		}
	}
?>
</ul>