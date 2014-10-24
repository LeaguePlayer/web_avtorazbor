$(document).ready(function(){
	
	var lastIndex=$('.request_form dd:last').index();
	var dd=$('.request_form dd');

	$('select').selectmenu({
		change:function(){

			var params={
					value:$(this).attr('id')!='Categories' ? $(this).val() : $('#carModels').val(),
					model:$(this).attr('id'),
					nested:$(this).data('nested'),
					searchingIn:"Parts"
				},
			$_this=$(this);

			var parent=$_this.closest('dd'),
				index=parent.index()+1,
 				elems=dd.slice(index,lastIndex);

			if (elems.length)
			{
				$_this.selectmenu('close')
				$(params.nested).find('option:not(:first)').remove();
				elems.slideUp(200).find('select').selectmenu('refresh');
				dd.eq(-1).slideUp(200); 	
			};

			if ($(this).val())
		 	{
				$.ajax({
					url:'/ajaxRequests/getNestedList',
					data:params,
					success:function(data){
						parent.next().slideDown(200);
						$(params.nested).empty();
						$(params.nested).html(data);
						$(params.nested).selectmenu('refresh');
					}
				});	
			};
		}
	})

	$('.line').slider({
		range:true,
		step:1,
		min:14,
		max:25,
		values:[14,25],
		slide:function(event, ui){

			$_max=$('#maxSize');
			$_min=$('#minSize');

			$_min.text(ui.values[0]).val(ui.values[0]);
			$_max.text(ui.values[1]).val(ui.values[1]);
		}
	});


	$('.partsTabs li a').click(function(){

			var index=$(this).parent().index();

			if (index==$('li:last',$(this).closest('ul')).index())
			{
				$.fancybox.open($('#book'),
					{
						fitToView	: true,
						autoSize	: true,
					});
				return false;
			}

			$('.partsTabs .active').removeClass('active');

			$(this).parent().addClass('active');

			var context=$(this).closest('.partsTabs').parent();

			$('.tab-active',context).removeClass('tab-active');
			
			var tabId=$(this).attr('href');
				$(tabId).addClass("tab-active");
			var id=$('.tab-active').attr('id');
			$('Search_scenario').val(id);
			$('Search_type').val(index!=1 ? 1 : 2);
			return false;
		});

})