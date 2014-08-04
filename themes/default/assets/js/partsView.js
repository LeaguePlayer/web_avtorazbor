$(function(){

	$('#scrollbar').tinyscrollbar();
	$('.imgFancy').fancybox();
	

	$('.inCart').click(function(){

		$.ajax({
			url:'/detail/addToCart',
			data:{id:$('.desc li').eq(2).text()}
			success:function(data){
				$('.cart li').eq(0).text(data.items)
				$('.cart li').eq(1).text(data.summ)
			}
		})

		return false;
	})

})