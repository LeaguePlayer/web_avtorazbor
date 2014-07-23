
function NestedChanged(conteiner)
{

	conteiner.on('change click',function( e ){

		ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog');	

		

	    return false;
	});

}


$(function(){

	$('.nested').on('change',function(){
		
		var nested=$('#'+$(this).data('nested'));
			nested.empty();
		$_this=$(this);

		var params={
				model:$_this.data('nested'),
				condition:'id_'+$_this.attr('id')+'=:id',
				value:$_this.val()
			};

		var htmlData = getNestedList(params,nested,NestedChanged);
				
	});


	$('#car_type li a').click(function(){
		$_this=$(this);
		type=$(this).data('type');

		if (type!='1')
		{

			$('#bascet,#transmission').closest('dd').css('display','none');
			$('#bascet-label,#transmission-label').css('display','none');
			$('#bascet,#transmission').children().eq(0).attr('selected','selected');
			$('#bascet,#transmission').trigger('refresh');

		} else {

			$('#bascet,#transmission').closest('dd').css('display','block');
			$('#bascet-label,#transmission-label').css('display','block');

		}

	})

	$('#sort li a,#display li a').click(function(){
		$(this).closest('ul').find('.active').removeClass('active');
		$(this).parent().addClass('active');

		return false;
	});

	$('.filter select, #minForce,#maxForce,#sort li a,#display li a, .pagination a,#car_type li a').on('change click',function( e ){

		ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog');	
		return false;
	})

	if ($('.calculate .line').length>0)
	{
		var value1=$('#minCost'),
			value2=$('#maxCost');
		$('.calculate .line,.line-2').slider({
			range:true,
			step:10,
			values:[0,80],
			slide:function(event, ui){

				$_max=$($(this).data('max'));
				$_min=$($(this).data('min'));

				$_min.text(ui.values[0]*1000).val(ui.values[0]*1000);
				$_max.text(ui.values[1]*1000).val(ui.values[1]*1000);

				setTimeout(function(){
					ViewItems($('.auto'),methods['catalog'].apply(this,[]),'/catalog');								
				},500);
				

			}
		});
	}
});
