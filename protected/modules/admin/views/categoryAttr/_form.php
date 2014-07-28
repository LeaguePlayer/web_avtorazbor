
<?
	Yii::app()->clientScript->registerScript('search',
	    "
		$('.rm').on('click',function(){
			$(this).closest('tr').empty();
			return false;
		});
	"
	);
?>

<td><input type="text" name="attr[]"></td><td><a href="#" class="rm"></td>
