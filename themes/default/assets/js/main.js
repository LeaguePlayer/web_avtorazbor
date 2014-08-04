$(document).ready(function(){
	//*подключаем фотораму
	
	//*стилизуем select
	
	//*слайдер
	$('div#items').owlCarousel({
	  items:7,
      margin: 0,
      loop: true,
	});
	
	var autoCarusel=$('div#items-auto').data('owlCarousel');
	$('.cat-auto .prev').on("click",function(){
		autoCarusel.prev();
		return false;
	})

	$('.cat-auto .next').on("click",function(){
		autoCarusel.next();
		return false;
	})


	$('.news-items .items').owlCarousel({
	  items: 4,
      loop: true,
	});

	$('select').selectmenu({
		change:function(){
			alert(1)
		}
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


	//*всплывающее окно Задать вопрос
	

    

if ($('a.modal').length>0)	
	{
		$('a.modal').fancybox({
			fitToView	: false,
			width		: 615,
			height		: 630,
			wrapCSS		: "questionForm",
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});
	}
	

	var fancy=$('.fancy');
		if (fancy.length>0)
			fancy.fancybox();
	
});




