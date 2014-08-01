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

var changeView=function(){

}
var hide=function(select)
{
	select.parent().prev().hide();
	select.parent().hide();
}

var show=function(select){

	select.parent().prev().show();
	select.parent().show();

}

$(document).ready(function(){

	
	// hide($('select'))
	// show($('select:first'));

	changeView=function(){

		setTimeout(function(){
			var params=methods['parts'].apply(this,[]);
			ViewItems($('.auto'),params,'/detail/ajaxUpdate');	
		},500)
	}

	$('.imgFancy').fancybox();

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

	$('select').on('change',function(){

		$_current=$(this);
		$('select').removeAttr('selected');

		changeView.apply(this,[]);
	});

	$('.nested').on('change',function(){
		
		$(nested).selectbox('refresh');
		setNestedSelect.apply(this,[changeView]);

	});

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
			},1000);

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