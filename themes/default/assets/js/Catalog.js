
var changeView=function(){
	ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog');	
}

$(function(){


	changeView=function(){

		ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog');	

	} 

	$('.nested').on('change',function(){

		var nested=$(this).data('nested');

		if ($('onption:selected',this).index()==0)
		{
			$('onption:selected').removeAttr('selected');
			$(this).selectbox('refresh');
			return false;
		}

		setNestedSelect.apply(this,[changeView]);

	});
	
	$('select').on('change',function(){

		ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog');	
		console.log($('#carBrands').val())
		console.log(methods['catalog'].apply(this,[]))
	})

	$('#car_type li a').click(function(){
		$_this=$(this);
		type=$(this).data('type');

		if (type!='1')
		{
			$('#bascet,#transmission').closest('dd').css('display','none');
			$('#bascet-label,#transmission-label').css('display','none');
			$('#bascet,#transmission').children().eq(0).removeAttr('selected');
			$('#bascet,#transmission').trigger('refresh');
		} else {

			$('#bascet,#transmission').closest('dd').css('display','block');
			$('#bascet-label,#transmission-label').css('display','block');
		}

	});

	$('.own-price').fancybox({
		fitToView	: false,
		wrapCSS		: "questionForm",
		height		: 450,
		width		: 590,
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});

	$('#sort li a,#display li a,#car_type li a').click(function(){

		$(this).closest('ul').find('.active').removeClass('active');
		$(this).parent().addClass('active');

		ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog');
		return false;

	});

	$('.filter select, #minForce,#maxForce,#minCost,#maxCost, .pagination a, #car_type li a').on('change click keyup',function( e ){

		ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog');
		
		return false;
	})

	
	$('.calculate .line').slider({
		range:true,
		step:1000,
		min:1000,
		max:3000000,
		values:[0,3000000],
		slide:function(event, ui){

			$_max=$($(this).data('max'));
			$_min=$($(this).data('min'));

			$_min.text(ui.values[0]).val(ui.values[0]);
			$_max.text(ui.values[1]).val(ui.values[1]);

			setTimeout(function(){
				ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog');
			},500);
		}
	});

	$('.line-2').slider({
		range:true,
		step:1,
		values:[0,1000],
		min:0,
		max:1000,
		slide:function(event, ui){

			$_max=$($(this).data('max'));
			$_min=$($(this).data('min'));

			$_min.text(ui.values[0]).val(ui.values[0]);
			$_max.text(ui.values[1]).val(ui.values[1]);

			setTimeout(function(){
				ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog');
			},500);
		}
	});
});
