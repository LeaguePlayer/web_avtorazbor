$(function(){

	$('#scrollbar').tinyscrollbar();

	$('.imgFancy').fancybox();
	
	$('.own-price').fancybox({
		fitToView	: true,
		autoSize	: true,
	});

	$('.inCart').on('click',function(){

		$.ajax({
			url:'/detail/addToCart',
			data:{id:parseInt($('.articl').text(),10)},
			dataType:'JSON',
			success:function(data){
				console.log(data)
				 var html='<ul><li><a href="/cart">'+data['count']+' товар</a></li><li>На сумму: <strong>'+data['summ']+' руб.</strong></li></ul>';
	        	$('.bascet dd').empty().append(html);

			}
		});
		return false;
	})

})