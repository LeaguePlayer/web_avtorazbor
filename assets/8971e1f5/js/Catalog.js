var changeView=function(){

}

$(function(){

	var showLoader=function (){
		
	var $_curHeight=$('.auto').height();

		$('.auto').empty();

		$('.loader').css('display','block');
	return false;
}

	changeView=function(){

		showLoader();

		setTimeout(function(){
			var params=methods['parts'].apply(this,[]);
			$form=$('#parts-form').serialize();
			ViewItems($('.auto'),$form,'/catalog',onViewChangedCallBack);
		},1000)
	}

	var onViewChangedCallBack=function(){

		hideLoader();
		// $('searchResult').val($('form').serialize());
		var $_count=$('.summary span').text();
			$('.pag li:first a').text('Все('+($_count ? $_count : 0)+')');

		$('.items li a').on('click',function(){
			var $_url=$('#criteria-form').serialize(),
				$_href=$(this).attr('href');
				$(this).attr('href',$_href+'?'+$_url);
		})
		//slideToMenu();
	}

	//slideToMenu();

	$('.select').selectmenu({
		change:function(){

			changeView();

			var params={
					value:$(this).val(),
					model:$(this).data('model'),
					nested:$(this).data('nested'),
				},

			$_this=$(this);

			var index=$_this.closest('dd').index()+1,
				ddCount=$_this.closest('dl').find('dd').length-4;
				$_this.closest('dl').children('dd').slice(index,ddCount).find('select').val(null).selectmenu('refresh').parent().slideUp(200);

			if ($(this).val())
				$_this.closest('dd').next().slideDown(200);
			
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
		$('#Search_scenario').val(type=="1" ? 'light' : 'weight');
		console.log($('#Search_scenario').val());
		if (type!='1')
		{
			$('#Search_bascet,#Search_transmission').closest('dd').slideUp(200);
			$('#Search_bascet,#Search_transmission').children('option:selected').removeAttr('selected');
			$('#Search_bascet,#Search_transmission').selectmenu('refresh');
			
		} else {
			$('#Search_bascet,#Search_transmission').closest('dd').slideDown(200);
		}
	});
	
	$('.own-price').on('click',function(){
		$('#car_id').val($('.articul span').text());
		console.log(123)
	})

	$('.own-price').fancybox({	
		fitToView	: true,
		autoSize	: true,
	});

	// $('#sort li a,#display li a,#car_type li a').click(function(){

	// 	$(this).closest('ul').find('.active').removeClass('active');
	// 	$(this).parent().addClass('active');

	// 	changeView();
	// 	return false;

	// });

	$('#car_type li a').click(function(){
		
		if($(this).attr('href')=="#")
		{
			$(this).closest('ul').find('.active').removeClass('active');
			$(this).parent().addClass('active');
			changeView();
			return false;
		}

	})

	$('#sort li a').click(function(){

		$(this).closest('ul').find('.active').removeClass('active');
		$(this).parent().addClass('active');
		$('#Search_sort').val($(this).parent().data('sort'));

		changeView();
		return false;
	});

	$('#display li a').click(function(){
		
		$(this).closest('ul').find('.active').removeClass('active');
		$(this).parent().addClass('active');
		$('#Search_display').val($(this).text());

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
