$(function(){



	Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) {
	    var n = this,
	        decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
	        decSeparator = decSeparator == undefined ? "." : decSeparator,
	        thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
	        sign = n < 0 ? "-" : "",
	        i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
	        j = (j = i.length) > 3 ? j % 3 : 0;
	    return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
	};

	$('#scrollbar').tinyscrollbar();
	$('.own-price').fancybox({
		fitToView	: true,
		autoSize	: true,
	});

	$('.stay').click(function(){
		$('.inCart').attr('href','/cart').text('Перейти в карзину').removeClass('inCart');
		$.fancybox.close();
	})

	$('.inCart').click(function(){

		if (!$(this).hasClass('inCart'))
			return true;
		var path=$('.imgFancy img').attr('src');
		$.ajax({
			url:'/detail/addToCart',
			data:{id:parseInt($('.articl:first').text(),10)},
			dataType:'JSON',
			success:function(data){
				
				var html='<ul><li><a href="/cart">'+data['count']+'</a></li><li>На сумму: <strong>'+data['summ']+' руб.</strong></li></ul>';

	        	$('.bascet dd').empty().append(html);

	        	$('#alert .part').empty().append('<img src="'+path+'" alt="">'+$('.desc-view').eq(0).html());
			},
			error:function(data){
				console.log(data)
			}
		})

		if ($(this).data('price')!='' && $(this).data('price')!=undefined)
		{
			var itemsCount=$(this).data('count'),
				itemsCost=parseInt($(this).data('cost'),10)+parseInt($(this).data('price'),10);
			$('.totalPrice').text('В карзине '+itemsCount+' на сумму '+parseInt(itemsCost,10).formatMoney(0,' ',' ')+" руб.");
		}
			

		$.fancybox.open({
	        href : '#alert',
	        autoSize:true,
	        fitToView:true,
	        padding:0,

	    })
		return false;
	})

})