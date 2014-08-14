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
					$this.closest('tr').slideUp(400).delay(400).empty();
					return false;
				}
				alert(data.error);
			}
		});
	});

	if ($('#accordion').length>0)
		$('#accordion').accordion().accordion('refresh');

})