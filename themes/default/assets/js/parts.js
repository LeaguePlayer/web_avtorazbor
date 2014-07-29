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
		{
			$_parent.next().removeClass('hide');
		}
		else {
			$_parent.next().addClass('hide');
		}

	});
}

function convertObjToStr(){

}

var changeView=function(){

}

$(document).ready(function(){


	var linkHref=[];

	changeView=function(){

		var params=methods['parts'].apply(this,[]);
		var url=$.param(params);

		ViewItems($('.auto'),params,'/detail/ajaxUpdate');	

		// $('#part_list a').each(function(){
		// 	var href=$(this).attr('href'),
		// 		index=$(this).index();

		// 	if (linkHref[index]==undefined)
		// 		linkHref.push(href);

		// 	$(this).attr('href',linkHref[index]+"?"+url);
		// })
	}


	$('#part_list a ').click(function(){

		var href=$(this).attr('href');
		var params=methods['parts'].apply(this,[]);

		$(this).attr('href',href+'&'+params);
		return false;
	})

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


	$('.nested').on('change',function(){

		setNestedSelect.apply(this,[changeView]);

	});

	

	$('select').on('change',function(){
		changeView();
	})

	$('.partPrice').slider({
		range:true,
		step:50,
		min:100,
		max:500000,
		values:[100,500000],
		slide:function(event, ui){

			$_max=$($(this).data('max'));
			$_min=$($(this).data('min'));

			$_min.text(ui.values[0]).val(ui.values[0]);
			$_max.text(ui.values[1]).val(ui.values[1]);

			setTimeout(function(){
				changeView();
			},500);

		}
	});

	if ($('#scrollbar').length>0)
		$('#scrollbar').tinyscrollbar();

	$('#sort li a, #display li a, #car_type li a').click(function(){

		$(this).closest('ul').find('.active').removeClass('active');
		$(this).parent().addClass('active');

		changeView();

		return false;

	});

	$('#minCost, #maxCost').bind('change click keyup',function(){
		changeView();
	});


	$('.partsTabs li a').click(function(){

		var index=$(this).parent().index();
		switch(true){

			case index<2:{

				var $_parent=$(this).closest('.partsTabs'),
					tab = $(this);

				$(this).closest('ul').find('.active').removeClass('active');
				$(this).parent().addClass('active');

				$('.tab-active').removeClass('tab-active');

				$('#light').addClass('tab-active');

				$('#car_type').val(index+1);

			}break;

			case index==2:{
				$('.partsTabs .active').removeClass('active');

				$(this).parent().addClass('active');

				var context=$(this).closest('.partsTabs').parent();

				$('.tab-active',context).removeClass('tab-active');

				var tabId=$(this).attr('href');
					$(tabId).addClass("tab-active");

			}break;

			case index==3:{
				$.fancybox.open($('#book'),
					{
						fitToView	: false,
						wrapCSS		: "questionForm",
						height		: 700,
						width		: 590,
						autoSize	: false,
						closeClick	: false,
						openEffect	: 'none',
						closeEffect	: 'none'
					});
			}break;
		}
		return false;

	});

	$('.own-price').fancybox({
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