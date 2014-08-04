
var changeView=function (){

}

$(function(){


	changeView=function(){
		ViewItems($('.auto'),methods['disc'].apply(this,[]),'/detail/disc');
		return false;
	}

	$('#sort li a,#display li a').on('click',function(){

		$(this).closest('ul').find('.active').removeClass('active');
		$(this).closest('li').addClass('active');

		changeView();
		return false;
	})

	$('#min,#max,#minCost,#maxCost').on('change keyup',function(){
		changeView();
		return false;
	})




	$('#slider .calculate').slider({
		range:true,
		step:1,
		min:14,
		max:30,
		values:[14,30],
		slide:function(event, ui){

			$_max=$('#max');
			$_min=$('#min');

			$_min.text(ui.values[0]).val(ui.values[0]);
			$_max.text(ui.values[1]).val(ui.values[1]);

			setTimeout(function(){
				changeView();
			},1000);

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