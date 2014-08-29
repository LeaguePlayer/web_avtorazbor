$(function(){

	$('.i-close').click(function(){

		var articul=parseInt($(this).closest('tr').find('.articul').text(),10),
			$this=$(this);
		$.ajax({
			url:'/cart/removePosition',
			data:{articul:articul,position:$(this).closest('tr').index()},
			dataType:'json',
			success:function(data){
				if (data.success)
				{
					$('.bascet dd').empty().append(data.html);

					if (!$this.closest('tbody').children('tr').length>0)
					{
						$('.tabs li:last').animate({width:0,padding:0},500,function(){
							$(this).slideUp(300).delay(300).empty();
							$('.bascet').empty().append('Карзина пуста!');
						});	
						$('table').slideUp(400).delay(400).empty();
					} else {
						$this.closest('tr').slideUp(400).delay(400).empty();
					}
					return false;
				}
				alert(data.error);
			}
		});
	});
	
	$('.tabs-type li:last a').click(function(){

		$('.reqvizit')
			.removeClass('hide')
			.css('display','none')
			.slideDown(400);
		$('#client-type').val('1');

		$('.tabs-type li .active').removeClass('active');
		$(this).addClass('active');
		return false;
	});

	$('.tabs-type li:first a').click(function(){

		$('.reqvizit')
			.slideUp(400)
			.delay(400)
			//.addClass('hide');
		$('#client-type').val('2');

		$('.tabs-type li .active').removeClass('active');
		$(this).addClass('active');

		return false;
	})

	if ($('#accordion').length>0)
		$('#accordion').accordion().accordion('refresh');

	$('select').selectmenu();

})