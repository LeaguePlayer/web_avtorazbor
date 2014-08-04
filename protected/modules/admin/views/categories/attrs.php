<ul>
<?
	if (!empty($category))
	{
		foreach ($category->attrs as $key => $value) {
		?>
			<li>
				<input type="text" name="attr[<?=$value->id?>][]" value="<?=$value->attrValue->value?>">
			</li>
		<?
		}
	}
?>
</ul>