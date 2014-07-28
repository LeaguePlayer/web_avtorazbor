
function DisplayBascet(){
	$.ajax({
		dataType:'json',
		type:'get',
		url:'/admin/usedCars/ajaxDisplayBascet',
		data:{id:$('#UsedCars_car_model_id').val()},
		success:function(data){

			if (data.success)
				$("#bascet").closest(".control-group").show();
			else
			{ 
				$("#bascet").closest(".control-group").hide();
				$("#bascet option:selected").removeAttr("selected");
			}

		}
	});
}

$(function(){

	DisplayBascet();

	$('#UsedCars_car_model_id').on('change',function(){
		DisplayBascet();
	})

    $('#bascet').closest('.control-group').css('display','none');

    if ($('#type').val()==1)
    {
        $('#bascet').closest('.control-group').css('display','block');
    }
    
    $('#type').on('change',function(){

        $('#bascet').closest('.control-group').css('display',($(this).val()==1 ? 'block' : 'none'));

    });

})