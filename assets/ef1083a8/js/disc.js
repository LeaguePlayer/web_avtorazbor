$(function(){

	$('#slider .calculate').slider({
		range:true,
		step:1,
		min:14,
		max:30,
		values:[14,30],
		slide:function(event, ui){

			$_max=$('#maxSize');
			$_min=$('#minSize');

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
				
			},1000);
		}
	});
})