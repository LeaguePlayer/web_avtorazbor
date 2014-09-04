$(function(){

	$('#scrollbar').tinyscrollbar();

	$('.imgFancy').fancybox();
	
	$('.own-price').fancybox({
		fitToView	: true,
		autoSize	: true,
	});

	$('.inCart').on('click',function(){
		var path=$('.imgFancy img').attr('src');

		$.ajax({
			url:'/detail/addToCart',
			data:{id:parseInt($('.articl').text(),10)},
			dataType:'JSON',
			success:function(data){
				 var html='<ul><li><a href="/cart">'+data['count']+' товар</a></li><li>На сумму: <strong>'+data['summ']+' руб.</strong></li></ul>';
	        	$('.bascet dd').empty().append(html);
	        	$('#alert .part').empty().append('<img src="/media/MediumPart.png" alt="">'+$('.desc-view').eq(0).html());
	        	$.fancybox.open({
			        href : '#alert',
			        fitToView: true,
			        autoSize:true,
			    })
			}
		});
		return false;
	})

})