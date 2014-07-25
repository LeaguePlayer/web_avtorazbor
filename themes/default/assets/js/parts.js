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

	$('.line').slider({
		range:true,
		step:1,
		min:14,
		max:25,
		values:[14,25],
		slide:function(event, ui){

			$_max=$($(this).data('max'));
			$_min=$($(this).data('min'));

			$_min.text(ui.values[0]).val(ui.values[0]);
			$_max.text(ui.values[1]).val(ui.values[1]);
		}
	});
	if ($('#scrollbar').length>0)
		$('#scrollbar').tinyscrollbar();

	$('#part_list ul li a').on('click',function(){

		return ViewItems($('.part'),{id:$(this).data('id')},'/ajaxRequests/getDetail');
	})

	$('.partsTabs li a').click(function(){

		$_parent=$(this).parent();
		$_index=$_parent.index();

		if ($_index<2)
		{

			$('.partsTabs .active').removeClass('active');

			$('#disc').removeClass('tab-active');
			$('#light').addClass('tab-active');

			$(this).parent().addClass('active');

			$('#car_type').val($_index+1);
			return false;
		}
		
	})

	$('.partsTabs li').eq(2).find('a').click(function(){
		
		$('.partsTabs .active').removeClass('active');

		$(this).parent().addClass('active');

		var context=$(this).closest('.partsTabs').parent();

		$('.tab-active',context).removeClass('tab-active');

		var tabId=$(this).attr('href');
		$(tabId).addClass("tab-active");

		return false;
	})

	$('.partsTabs li a').fancybox({
			fitToView	: false,
			wrapCSS		: "questionForm",
			height		: 700,
			width		: 590,
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});

	$('#sendCriteria').on('click',function(){
		if (!$('#carBrands').val())
			return false;
	});

	ShowNextSelect();

})