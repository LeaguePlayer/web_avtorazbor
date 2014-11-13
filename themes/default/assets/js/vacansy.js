$(function(){
	$('.vacansy .item a').on('click',function(){
		$('.vacansy .active').removeClass('active');
		$(this).closest('.item').addClass('active');
	})

})