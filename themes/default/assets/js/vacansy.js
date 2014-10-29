$(function(){
	$('.vacansy .active:not(:first)').removeClass('active');
	$('.vacansy .item a').on('click',function(){
		$('.vacansy .active').removeClass('active');
		$(this).closest('.item').addClass('active');
	})

})