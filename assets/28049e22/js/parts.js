$(document).ready(function(){
	var dd=$('.request_form dd select').parent();
	var lastIndex=dd.eq(-1).index();
	$('.pag li:first a').click(function(){
		return false;
	})

	$('select').selectmenu({
		change:function(){

			changeView();
			var $_this=$(this),
				params={
					value:$(this).attr('id')!='Categories' ? $(this).val() : {model:$('#carModels').val(),category:$(this).val()},
					model:$(this).data('model'),
					nested:$(this).data('nested'),
					searchingIn:"Parts",
				},
				parent=$_this.closest('dd'),
				index=parent.index()+1,
 				elems=dd.slice(index,lastIndex);

			if (elems.length)
			{
				$_this.selectmenu('close')
				$(params.nested).find('option:not(:first)').remove();
				elems.slideUp(200);
				elems.find('select option:not(:first)').remove();
				elems.find('select').selectmenu('refresh');
				dd.eq(-1).slideUp(200);
			}

			if ($(this).val())
		 	{
				$.ajax({
					url:'/ajaxRequests/getNestedList',
					data:params,
					success:function(data){
						parent.next().slideDown(200);

						$(params.nested).empty();
						$(params.nested).html(data);
						$(params.nested).selectmenu('refresh');
					}
				});	
			}
		}
	})
	
	$('body').on('click','.pagination a',function(){

		var height=$('.auto').height();
		$(document).scrollTo($('.menu').offset().top,800);

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

	$('#car_type li a').click(function(){
		
		// if($(this).attr('href').indexOf("#")>-1)
		// {
		// 	$(this).closest('ul').find('.active').removeClass('active');
		// 	$(this).parent().addClass('active');
		// 	$('#Search_type').val($(this).data('scenario'));
		// 	changeView();
		// 	return false;
		// }

	})
	$('#minCost, #maxCost').bind('change click keyup',function(){
		changeView();
	});

	$('.imgFancy').fancybox();

	$('.line').slider({
		range:true,
		step:1,
		min:14,
		max:25,
		values:[14,30],
		slide:function(event, ui){

			$_max=$($(this).data('max'));
			$_min=$($(this).data('min'));

			$_min.text(ui.values[0]).val(ui.values[0]);
			$_max.text(ui.values[1]).val(ui.values[1]);

		}
	});

	$('.partPrice').slider({
		range:true,
		step:50,
		min:100,
		max:10000,
		values:[10,10000],
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
	
	

	changeView=function(){

		showLoader();

		setTimeout(function(){
			var $form=$('#parts-form').serialize();
			ViewItems($('.auto'),$form,'/detail/ajaxUpdate',onViewChangedCallBack);
		},1000)
	}

	var onViewChangedCallBack=function(){

		hideLoader();
		// $('searchResult').val($('form').serialize());
		var $_count=$('.summary span').text();

			$('.pag li:first a').text('Все('+($_count ? $_count : 0)+')');
	}
})