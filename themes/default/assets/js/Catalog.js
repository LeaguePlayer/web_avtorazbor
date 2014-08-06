$(function(){


	changeView=function(){

		ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog');	

	} 

	$('select').selectmenu({
		change:function(){

			changeView();

			var params={
					value:$(this).val(),
					model:$(this).attr('id'),
					nested:$(this).data('nested')
				},

			$_this=$(this);

			// var index=$_this.closest('dd').index()+1,
			// 	ddCount=$_this.closest('dl').find('dd').length-2;
			// 	$_this.closest('dl').children('dd').slice(index,ddCount).find('select').val(null).selectmenu('refresh').parent().slideUp(200);

			// if ($(this).val())
			// 	$_this.closest('dd').next().slideDown(200);
			
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
	changeView();
});
