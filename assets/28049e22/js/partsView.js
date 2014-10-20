$(function(){

	$('#scrollbar').tinyscrollbar();

	$('.imgFancy').fancybox();
	
	$('.own-price').fancybox({
		fitToView	: true,
		autoSize	: true,
	});

	$('.stay').click(function(){
		$.fancybox.close();
	})

	$('.inCart').on('click',function(){

		var path=$('.imgFancy img').attr('src');
		$.ajax({
			url:'/detail/addToCart',
			data:{id:parseInt($('.articl:first').text(),10)},
			dataType:'JSON',
			success:function(data){
				
				var html='<ul><li><a href="/cart">'+data['count']+' товар</a></li><li>На сумму: <strong>'+data['summ']+' руб.</strong></li></ul>';

	        	$('.bascet dd').empty().append(html);

	        	$('#alert .part').empty().append('<img src="'+path+'" alt="">'+$('.desc-view').eq(0).html());
			},
			error:function(data){
				console.log(data)
			}
		})

		if ($(this).data('price')!='' && $(this).data('price')!=undefined)
		{
			var itemsCount=parseInt($(this).data('count'),10)+1,
				itemsCost=parseInt($(this).data('cost'),10)+parseInt($(this).data('price'),10);
				console.log(itemsCost);
			$('.totalPrice').text('В корзине '+itemsCount+' на сумму '+itemsCost+" руб.");
		}
			

		$.fancybox.open({
	        href : '#alert',
	        fitToView: true,
	        autoSize:true,

	    })
		return false;
	})

})