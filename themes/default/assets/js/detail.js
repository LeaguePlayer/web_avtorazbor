$(document).ready(function(){

	$('select').selectmenu({
		change:function(){

			var params={
					value:$(this).val(),
					model:$(this).attr('id'),
					nested:$(this).data('nested')
				},

			$_this=$(this);

			var parent=$_this.closest('dd'),
				index=parent.index(),
				elems=$_this.closest('dl').find('dd');

			// var index=$_this.closest('dd').index()+1,
			// 	ddCount=$_this.closest('dl').find('dd').length-2;
			// 	$_this.closest('dl').children('dd').slice(index,ddCount).find('select').val(null).selectmenu('refresh').parent().show(200);
			if ($(this).val())
				$_this.closest('dd').next().slideDown(200);
			$.ajax({
				url:'/ajaxRequests/getNestedList',
				data:params,
				success:function(data){
					$(params.nested).empty();
					$(params.nested).html(data);
					$(params.nested).selectmenu('refresh');
				}
			});
		}
	})

	$('.line').slider({
		range:true,
		step:1,
		min:14,
		max:25,
		values:[14,25],
		slide:function(event, ui){

			$_max=$($(this).data('max'));
			$_min=$($(this).data('min'));

			$_min.text(ui.values[0]).val(ui.values[0]);
			$_max.text(ui.values[1]).val(ui.values[1]);

		}
	});

	$('.partsTabs li a').click(function(){

		var index=$(this).parent().index();
		switch(true){

			case index<2:{

				var $_parent=$(this).closest('.partsTabs'),
					tab = $(this);

				$(this).closest('ul').find('.active').removeClass('active');
				$(this).parent().addClass('active');

				$('.tab-active').removeClass('tab-active');

				$('#light').addClass('tab-active');

				$('#car_type').val(index+1);

			}break;

			case index==2:{
				$('.partsTabs .active').removeClass('active');

				$(this).parent().addClass('active');

				var context=$(this).closest('.partsTabs').parent();

				$('.tab-active',context).removeClass('tab-active');

				var tabId=$(this).attr('href');
					$(tabId).addClass("tab-active");

			}break;

			case index==3:{
				$.fancybox.open($('#book'),
					{
						fitToView	: false,
						wrapCSS		: "questionForm",
						height		: 700,
						width		: 590,
						autoSize	: false,
						closeClick	: false,
						openEffect	: 'none',
						closeEffect	: 'none'
					});
			}break;
		}
		return false;
	});

})