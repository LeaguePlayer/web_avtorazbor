$(function(){

	var owl=$('.items-news .items').owlCarousel({
		  nav:true,
		  items:5,
		  navText:[],
	      margin: 0,
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

	// owl=$('#tabs-5 .items-news .items').data('owlCarousel');

	// $('#tabs-5 .next').click(function(){	
	// 	owl.next();
	// 	return false;
	// })

	// $('#tabs-5 .prev').click(function(){	
	// 	owl.prev();
	// 	return false;
	// })

	$('#tabs-6').addClass('hide').removeClass('tab-active');
})