$(function(){

	$('#scrollbar').tinyscrollbar();

	$('.imgFancy').fancybox();
	
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

	$('.inCart').on('click',function(){

		$.ajax({
			url:'/detail/addToCart',
			data:{id:parseInt($('.articl').text(),10)},
			dataType:'json',
			success:function(data){
				alert(data);
				$('.bascet li:first a').text(data.count+" товар");
				$('.bascet li:last strong').text(data.summ);
			}
		});
		return false;
	})

})