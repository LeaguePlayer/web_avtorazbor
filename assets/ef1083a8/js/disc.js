
var changeView=function(){

}

$(function(){
	
	function showLoader(){
			
		var $_curHeight=$('.auto').height();
			$('.auto').height($_curHeight);

			$('.auto').empty();

			$('.loader').css('display','block');

		return false;
	}

	function hideLoader()
	{
		$('.loader').css('display','none');
	}

	changeView=function(){

		showLoader();

		setTimeout(function(){

			// var params=methods['disc'].apply(this,[]);
			ViewItems($('.auto'),methods['disc'].apply(this,[]),'/detail/disc',onViewChangedCallBack);
			return false;
			
		},1000);
	}
	
	var onViewChangedCallBack=function(){

		hideLoader();
		// $('searchResult').val($('form').serialize());
		var $_count=$('.summary span').text();
			$('.pag li:first a').text('Все('+$_count+')');

		// $('.items li a').on('click',function(){
		// 	// var $_url=$('#criteria-form').serialize(),
		// 	// 	$_href=$(this).attr('href');
		// 	// 	$(this).attr('href',$_href+'?search='+$_url);
		// })
	};

	$('#sort li a,#display li a').on('click',function(){

		$(this).closest('ul').find('.active').removeClass('active');
		$(this).closest('li').addClass('active');
		changeView();
		return false;
	});

	$('#min,#max,#minCost,#maxCost').on('change keyup',function(){
		changeView();
		return false;
	});

	$('#slider .calculate').slider({
		range:true,
		step:1,
		min:14,
		max:30,
		values:[parseInt($('#min').val(),10),parseInt($('#max').val(),10)],
		slide:function(event, ui){

			$_max=$('#max');
			$_min=$('#min');

			$_min.text(ui.values[0]).val(ui.values[0]);
			$_max.text(ui.values[1]).val(ui.values[1]);

			setTimeout(function(){
				changeView();
			},500);

		}
	});

	$('#slider-2 .calculate').slider({
		range:true,
		step:50,
		min:100,
		max:50000,
		values:[100,50000],
		slide:function(event, ui){

			$_max=$('#maxCost');
			$_min=$('#minCost');

			$_min.text(ui.values[0]).val(ui.values[0]);
			$_max.text(ui.values[1]).val(ui.values[1]);

			setTimeout(function(){
				changeView();
			},1000);
		}
	});
})