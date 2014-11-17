$(function(){
	var owl=$('.items-news .items:last').owlCarousel({
		  nav:true,
		  items:6,
		  navText:[],
	      margin: 0,
	      mouseDrag:false,
		  touchDrag:false,
	      loop: false,
	}).data('owlCarousel');

	$('#tabs-6 .next').click(function(){	
		owl.next();
		return false;
	})

	$('#tabs-6 .prev').click(function(){	
		owl.prev();
		return false;
	})

	owl=$('.items-news .items:first').owlCarousel({
		  nav:true,
		  items:6,
		  navText:[],
	      margin: 0,
	      loop: false,
	      mouseDrag:false,
		  touchDrag:false,
	}).data('owlCarousel');


	$('#tabs-5 .next').click(function(){	
		owl.next();
		return false;
	})

	$('#tabs-5 .prev').click(function(){	
		owl.prev();
		return false;
	})

	$('#tabs-6').addClass('hide').removeClass('tab-active');
})