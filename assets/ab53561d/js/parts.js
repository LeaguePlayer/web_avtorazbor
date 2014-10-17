$(function(){
	$('#Parts_category_id').on('change',function(){
		$.ajax({
			dataType:'html',
			url:'/admin/parts/getCategoryAttrs',
			data:{id:$(this).val(),model_id:$('.catgory-attrs').data('articul')},
			success:function(data){

				if (data)
					$('.catgory-attrs').empty().html(data)
				else 
					alert(data);
			},
			error:function(data){
				alert('Ошибка сервера! Повторите попытку позднее');
			}	
		})
	})
})