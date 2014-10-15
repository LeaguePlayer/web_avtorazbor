$(function(){
	$('.tabs ul li a').click(function(){
		var tabId=$(this).attr('href');
		if (tabId.indexOf("#")>-1)
		{
			if (!$(this).hasClass('modal'))
			{
				var context=$(this).closest('.tabs').parent();
				$('.tab-active',context).addClass('hide').removeClass('tab-active');
				$(tabId).addClass("tab-active").removeClass('hide');
				$('li.active:first',context).removeClass('active');
				$(this).parent().addClass('active');
				return false;
			} else {
				var href=$(this).attr('href');
				$.fancybox.open(href,{});
			}
			return false;
		}
	})

	$('.auth,.modal').fancybox({
		fitToView	: true,
		padding		: 0,
		autoSize	: true,
	});

    //*дочерние эллементы
    $('.service li:nth-child(even)').addClass('old');

    $('.items li:nth-child(even)').addClass('old');
	//*стилизуем чекбокс

	$('.int').toggle(function(){
		$(this).find('.niceCheck').css('background-position','-10px 0');
	},function(){
		$(this).find('.niceCheck').css('background-position','0 0');
	});

	$('.fotorama').fotorama({
	  width: '100%',
	  maxwidth: '100%',
	  nav: 'dots',
	  arrows: false
	});

	var dropped=true;

	$(".dropDown").click(function(){
		var dopMenu=$('.dopMenu');
		if (dropped)
		{
			$(dopMenu).slideDown(200);
		}
		else {
			$(dopMenu).slideUp(200);	
		}
		dropped=!dropped;
	})

	var searchDropped=true;
	$('#searchBtn').click(function(){

		if (searchDropped)
		{
			$('.search .searchBy').slideDown(100)
		} else {
			$('.search .searchBy').slideUp(100)
		}
		searchDropped=!searchDropped;
		return false;
	})

	$('.search .searchBy li').click(function(){

		$('.search .searchType').slideDown(100)
		searchDropped=!searchDropped;
		$('label[for=searchBtn]').text($(this).text());
		$('.search .searchBy').slideUp(100);
	})

	$('.dopMenu ul li a').click(function(){
		$('div[class^=phone]').each(function(){
			$(this).removeClass('active');
		})
		var itemClass=$(this).attr('href');
		$(itemClass).addClass('active');
		$(".dopMenu").slideUp(200);
		dropped=!dropped;
		return false; 
	})

	$('.jobs a').click(function(){
		$('.jobs ul li.active').removeClass('active');
		$(this).closest('li').addClass('active');
		return false;
	})

	$(".niceCheck").each(
	/* при загрузке страницы нужно проверить какое значение имеет чекбокс и в соответствии с ним выставить вид */
	function() {
	     
	     changeCheckStart($(this));
	     
	});

	function changeCheck(el)
	/* 
		функция смены вида и значения чекбокса
		el - span контейнер дял обычного чекбокса
		input - чекбокс
	*/
	{
	     var el = el,
	          input = el.find("input").eq(0);
	   	 if(!input.is(":checked")) {
			el.css("background-position","-16px 0");	
			input.attr("checked", true)
		} else {
			el.css("background-position","0 0");	
			input.attr("checked", false)
		}
	     return true;
	}

	function changeCheckStart(el)
	/* 
		если установлен атрибут checked, меняем вид чекбокса
	*/
	{
	var el = el,
			input = el.find("input").eq(0);
	      if(input.attr("checked")) {
			el.css("background-position","-16px 0");	
			}
	     return true;
	}


})
