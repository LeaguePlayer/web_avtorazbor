var changeView=function(){

}

$(function(){

	var showLoader=function (){
		
	var $_curHeight=$('.auto').height();
		$('.auto').height($_curHeight);

		$('.auto').empty();

		$('.loader').css('display','block');
		
	return false;
}

	changeView=function(){

		showLoader();
		
		setTimeout(function(){
			ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog',onViewChangedCallBack);	
		},1000)
	} 

	var onViewChangedCallBack=function(){

		hideLoader();
		// $('searchResult').val($('form').serialize());
		var $_count=$('.summary span').text();
			$('.pag li:first a').text('Все('+$_count+')');

		$('.items li a').on('click',function(){
			var $_url=$('#criteria-form').serialize(),
				$_href=$(this).attr('href');
				$(this).attr('href',$_href+'?'+$_url);
		})
		slideToMenu();
	}

	slideToMenu();

	$('select').selectmenu({
		change:function(){

			changeView();

			var params={
					value:$(this).val(),
					model:$(this).attr('id'),
					nested:$(this).data('nested')
				},

			$_this=$(this);

			$.ajax({
				url:'/ajaxRequests/getNestedList',
				data:params,

				success:function(data){	
					$(params.nested).empty();
					$(params.nested).html(data);
					$(params.nested).selectmenu('refresh');
				}
			});
		}
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

		changeView();
		return false;

	});

	$('.filter select, #minForce,#maxForce,#minCost,#maxCost, .pagination a').on('change keyup',function( e ){
		changeView();
		return false;
	})

	$('#car_type li a').click(function(){
		
		if($(this).attr('href')=="#")
		{
			changeView();
			return false;
		}

	})

	$('.imgFancy').fancybox();
	
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

			changeView();
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

			changeView();
		}
	});
});
