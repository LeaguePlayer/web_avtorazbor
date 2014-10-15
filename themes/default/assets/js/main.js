$(document).ready(function(){

	$('.searchform .tabs ul li a').click(function(){

		var tabId=$(this).attr('href');
		if (!$(this).hasClass('modal'))
		{
			var context=$(this).closest('.tabs').parent();
				$('.tab-active',context).addClass('hide').removeClass('tab-active');
				$(tabId).addClass("tab-active").removeClass('hide');
				$('li.active:first',context).removeClass('active');
				$(this).parent().addClass('active');
				$('.readmore a').text("Все "+$(this).text().toLowerCase());

			var href=$(this).data('url');
			$('.readmore a').attr('href',href);

			changeView($('form',tabId));
			return false;
		} else
			return false;

	})

	$('.s-big').on('keypress','input[type=text]',function(e){

		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
        {
            return false;
        }
        else 
			changeView($(this).closest('form'));
	})

	$('.select').each(function(){

		$(this).selectmenu({
			change:function(){
				onSelectChanged.apply(this,[]);
			}
		})
	});

	
	// Табы ============================= Конец =================
	
	var owl=$('.items-auto .items').owlCarousel({
	  nav:true,
	  items:7,
	  navText:[],
      margin: 0,
      loop: true,
	}).data('owlCarousel');

	$('.items-news .items').each(function(){
		var owl=$(this).owlCarousel({
				  nav:true,
				  items:4,
				  navText:[],
			      margin: 0,
			      mouseDrag:false,
			      touchDrag:false,
			      loop: true,
				}).data('owlCarousel');
		var navs=$(this).closest('div [id^=tabs]').find('.next,.prev');

		navs.eq(0).click(function(){
			owl.next();
			return false;
		})
		navs.eq(1).click(function(){
			owl.prev();
			return false;
		})
	})

	$('#tabs-6').addClass('hide').removeClass('tab-active');

	$('.cat-auto .prev').click(function(){
			owl.prev();
		return false;
	})

	$('.cat-auto .next').click(function(){
		owl.next();
		return false;		
	})

	var changeView=function(form){

		showLoader();
		$('.items-auto .items').empty();
		$('.loader').show();

		setTimeout(function(){
			$.ajax({
				url:'/site/index',
				data:form.serialize(),
				success:function(data){
					
					if (data.indexOf('empty')<=0 && $('img',data).length>7)
					{
						var owl=$('.items-auto')
							.empty()
							.append(data)
							.find('.items')
							.owlCarousel({
								nav:true,
								items:7,
								navText:[],
							    margin: 0,
							    loop: true,
							    transitionStyle:'fade',
							}).data('owlCarousel');

						$('.cat-auto .prev').click(function(){
							owl.prev();
						})

						$('.cat-auto .next').click(function(){
							owl.next();
						})		
					} else {
						$('.items-auto')
							.empty()
							.append(data).find('.prev,.next').hide();
					}
				}
			}).done(function(){
				var total=parseInt($('.total').eq(0).text(),10);
				$('.loader').hide();
				$('.num',form).text(total+" авто");	
				// hideLoader();
			})
		},1000)
		
	}

	var onSelectChanged=function ()
	{
		var $nested=$(this).data('nested');
			if ($nested)
			{
				changeNested.apply(this,[]);
			}
				
			var $_form=$(this).closest('form');
				changeView($_form);
	}

	var changeNested=function(){

		var params={
				value:$(this).val(),
				model:$(this).data('model'),
				nested:$(this).data('nested')
			},

			$_this=$(this);

		if ($(this).val())
			$_this.closest('dd').next().slideDown(200);
		
		$.ajax({
			url:'/ajaxRequests/getNestedList',
			data:params,

			success:function(data){

				$(params.nested).empty();
				$(params.nested).html(data);
				$(params.nested).selectmenu('refresh');
				onSelectChanged.apply($(params.nested),[]);
			}
		});
	}
});