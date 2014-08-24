$(document).ready(function(){
	//*подключаем фотораму
	
	//*стилизуем select
	
	//*слайдер
	$('div#items').owlCarousel({
	  items:7,
      margin: 0,
      loop: true,
	});

	$('.searchform .tabs ul li a').click(function(){

		var tabId=$(this).attr('href');
		console.log($(this).parent().index());
		if ($(this).parent().index()<3)
		{
			var context=$(this).closest('.tabs').parent();
			$('.tab-active',context).addClass('hide').removeClass('tab-active');
			$(tabId).addClass("tab-active").removeClass('hide');
			$('li.active:first',context).removeClass('active');
			$(this).parent().addClass('active');

			$('.readmore a').text("Все "+$(this).text());
			var href=$('.coll-3 a',tabId).attr('href');
			$('.readmore a').attr('href',href);

			changeView($('form',tabId));
			return false;
		} else {
			$.fancybox()
		}
		
		if ($(this).attr('href')=="#")
		 {
		 	return false;
		 }
	})

	$('.readmore a').click(function(){
		var href=$(this).attr('href');
		var form=$('.searchform .tab-active form').serialize();
		$(this).attr('href',href+"?"+form);
	})

	// $('dd .i-submit').click(function(){
	// 	var params=$(this).closest('form').serialize();
	// 	var href=$(this).attr('href')+"?"+params;
	// 		$(this).attr('href',href);
	// })

	var autoCarusel=$('div#items-auto').data('owlCarousel');
	$('.cat-auto .prev').on("click",function(){
		autoCarusel.prev();
		return false;
	})

	$('.cat-auto .next').on("click",function(){
		autoCarusel.next();
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


	$('.news-items .items').owlCarousel({
	  items: 4,
      loop: true,
	});

	$('select').each(function(){

		$(this).selectmenu({
			change:function(){
				onSelectChanged.apply(this,[]);
			}
		})
	});

	
	var carusel=$('.news-items').data('owlCarousel');

		// $(this).closest('div[id^=tabs]').find('.next').on("click",
		// 	function(){
		// 		carusel.next();
		// 	return false;
		// })

		// $(this).closest('div[id^=tabs]').find('.prev').on("click",function(){
		// 	carusel.prev();
		// 	return false;
		// })

	// Табы ============================= Конец =================
	
	var autoCarusel=$('div#car_carusel .items').owlCarousel({
	  nav:true,
	  items:7,
	  navText:[],
      margin: 0,
      loop: true,
	});

	$('div#car_carusel .items').data('owlCarousel');
	
	$('.cat-auto .prev').on("click",function(){
		autoCarusel.prev();
		return false;
	})

	$('.cat-auto .next').on("click",function(){
		autoCarusel.next();
		return false;
	})

	$('#items').owlCarousel({
	  items:4,
	  navText:[],
      margin: 0,
      loop: true,
	})



	var changeView=function(form){

		showLoader();
		$('#car_carusel.list-view').empty();
		$('.loader').show();
		setTimeout(function(){
			$.ajax({
				url:'/site/index',
				data:form.serialize(),
				success:function(data){
				var owl=$('#car_carusel')
						.empty()
						.append(data)
						.find('.items')
						.owlCarousel({
							nav:true,
							items:6,
							navText:[],
						    margin: 0,
						    loop: true,
					}).data('owlCarousel');

					$('.cat-auto .prev').click(function(){
						owl.prev();
					})

					$('.cat-auto .next').click(function(){
						owl.next();
					})
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
		// var index=$_this.closest('dd').index()+1,
		// 	ddCount=$_this.closest('dl').find('dd').length-2;
		// 	$_this.closest('dl').children('dd').slice(index,ddCount).find('select').val(null).selectmenu('refresh').parent().slideUp(200);

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