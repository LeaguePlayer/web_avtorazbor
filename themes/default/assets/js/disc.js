
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
			ViewItems($('.auto'),$('#parts-form').serialize(),'/detail/disc',onViewChangedCallBack);
			return false;
			
		},1000);
	}

	var onViewChangedCallBack=function(){

		hideLoader();
		var $_count=$('.summary span').text();
			$('.pag li:first a').text('Все('+$_count+')');
		slideToMenu();
	};

	$('#sort li a').on('click',function(){

		$(this).closest('ul').find('.active').removeClass('active');
		$(this).closest('li').addClass('active');

		$('#SearchFormOnMain_sort').val($(this).closest('li').data('sort'));

		changeView();
		return false;
	});

	$('#display li a').on('click',function(){

		$(this).closest('ul').find('.active').removeClass('active');
		$(this).closest('li').addClass('active');

		$('#SearchFormOnMain_display').val(parseInt($(this).text()));

		changeView();
		return false;
	});

	$('.formCost input').on('change',function(){
		changeView();
		return false;
	});

	$('#slider .calculate').slider({
		range:true,
		step:1,
		min:14,
		max:25,
		values:[parseInt($('#SearchFormOnMain_diametr_st').val(),10),parseInt($('#SearchFormOnMain_diametr_end').val(),10)],
		slide:function(event, ui){

			$_max=$('#SearchFormOnMain_diametr_end');
			$_min=$('#SearchFormOnMain_diametr_st');

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

			$_max=$('#SearchFormOnMain_price_end');
			$_min=$('#SearchFormOnMain_price_st');

			$_min.text(ui.values[0]).val(ui.values[0]);
			$_max.text(ui.values[1]).val(ui.values[1]);

			setTimeout(function(){
				changeView();
			},1000);
		}
	});
})