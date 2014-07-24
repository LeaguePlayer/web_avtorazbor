function ShowNextSelect()
{
	$('select').on('change',function(){

		var $_parent=$(this).closest('.item');

		if ($_parent.index()==0)
		{
			var items=$_parent.parent().find('.item');
				items.addClass('hide');

			$_parent.removeClass('hide');

			for(var i = 1; i<items.length;i++)
			{
				$('select option:first',items.eq(i)).attr('selected','selected');
				$('select',items.eq(i)).trigger('refresh');
			}
		}

		if (('option:first:selected',$_parent).length>0)
			$_parent.next().removeClass('hide');
		else {
			$_parent.next().addClass('hide');
		}
	})
}

$(document).ready(function(){

	$('.gallery').fancybox();

	if ($('#scrollbar').length>0)
		$('#scrollbar').tinyscrollbar();

	$('#part_list ul li a').on('click',function(){

		return ViewItems($('.part'),{id:$(this).data('id')},'/ajaxRequests/getDetail');

	})

	$('.partsTabs li a').click(function(){

		$_parent=$(this).parent();
		
		$('.partsTabs .active').removeClass('active');
		$(this).parent().addClass('active');

		$('#car_type').val()

		return false;
	})

	$('#sendCriteria').on('click',function(){
		if (!$('#carBrands').val())
			return false;
	})

	ShowNextSelect();

})