$(function(){

	$('#scrollbar').tinyscrollbar();
	$('.imgFancy').fancybox();
	

	$('.inCart').click(function(){

		$.ajax({
			url:'/detail/addToCart',
			data:{
				id:$('.desc li').eq(2).text()
			},
			success:function(data){
				$('.cart li').eq(0).text(data.items)
				$('.cart li').eq(1).text(data.summ)
			}
		});
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

})