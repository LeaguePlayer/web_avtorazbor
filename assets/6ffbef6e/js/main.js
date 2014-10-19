$(document).ready(function(){

	var nestedMap={
		carModels:{
			bascet:true,
			state:true,
			transmission:true
		}
	};
	var contextForm;//Форма фильтра в которой был изменен селект
	$('.searchform .tabs ul li a').click(function(){

		var tabId=$(this).attr('href');
		if (!$(this).hasClass('modal'))
		{
			var context=$(this).closest('.tabs').parent();
				$('.tab-active',context).addClass('hide').removeClass('tab-active');
				$(tabId).addClass("tab-active").removeClass('hide');
				$('li.active:first',context).removeClass('active');
				$(this).parent().addClass('active');
				$('.readmore a').text("Все "+$(this).text().toLowerCase());

			var href=$(this).data('url');
			$('.readmore a').attr('href',href);

			changeView($('form',tabId));
			return false;
		} else
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

	$('.select').each(function(){

		$(this).selectmenu({
			change:function(){

				contextForm=$(this).closest('form');
				processNested($(this));

				if (($(this).data('model')=="carBrands" || $(this).data('model')=='Type') && !$(this).val())
				{
					$('.items-auto .items').empty();
					return;
				}
				if (nestedMap[$(this).data('model')] && $(this).data('map')==true)
					changeNestedMap.apply(this,[$(this,contextForm).data('model')]);
				else 
					onSelectChanged.apply(this,[]);
			},
			disabled:typeof $(this).data('enabled')=='undefined',
		})
	});

	
	// Табы ============================= Конец =================
	
	var owl=$('.items-auto .items').owlCarousel({
	  nav:true,
	  items:7,
	  navText:[],
      margin: 0,
      loop: true,
	}).data('owlCarousel');

	$('.items-news .items').each(function(){
		var owl=$(this).owlCarousel({
				  nav:true,
				  items:5,
				  navText:[],
			      margin: 0,
			      mouseDrag:false,
			      touchDrag:false,
			      loop: true,
				}).data('owlCarousel');
		var navs=$(this).closest('div [id^=tabs]').find('.next,.prev');

		navs.eq(0).click(function(){
			owl.next();
			return false;
		})
		navs.eq(1).click(function(){
			owl.prev();
			return false;
		})
	})

	$('#tabs-6').addClass('hide').removeClass('tab-active');

	$('.cat-auto .prev').click(function(){
			owl.prev();
		return false;
	})

	$('.cat-auto .next').click(function(){
		owl.next();
		return false;		
	})

	var changeView=function(form){

		showLoader();
		$('.items-auto .items').empty();
		$('.loader').show();

		setTimeout(function(){
			$.ajax({
				url:'/site/index',
				data:form.serialize(),
				success:function(data){
					
					if (data.indexOf('empty')<=0 && $('img',data).length>7)
					{
						owl=$('.items-auto .items')
							.empty()
							.append(data)
							.owlCarousel({
								nav:true,
								items:7,
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
					} else {
						$('.items-auto')
							.empty()
							.append(data).find('.prev,.next').hide();
					}
				}
			}).done(function(){
				var total=parseInt($('.total').eq(0).text(),10);
				$('.loader').hide();
				$('.num',form).text(total+" авто");	
				// hideLoader();
			})
		},1000)
	}

	var processNested=function(base){
		if (base.val())
		{
			$(base.data('next'),contextForm).selectmenu('enable');
		} else {
			var elem=base.data('next');

			while(typeof elem !='undefined')
			{
				$('option:not(:first)',$(elem,contextForm)).remove();
				$(elem,contextForm).selectmenu('refresh')
				$(elem,contextForm).selectmenu('disable');
				
				if ($(elem).data('map'))
				{
					changeNestedMap.apply(elem,[$(elem,contextForm).data('model')]);
				};
				base=$(base.data('next'),contextForm)
				elem=base.data('next');
			}
		}
	}

	var onSelectChanged=function()
	{
		var $nested=$(this).data('nested');
			if ($nested)
			{
				changeNested.apply(this,[]);
			}
			changeView(contextForm);
	}

	var changeNestedMap=function(nested){
			if ($('#'+nested,contextForm).val())
			{
				$.each(nestedMap[nested],function(key,val){
					var params={
						value:$('#'+nested,contextForm).val(),
						model:key,
						nested:nested,
						type:contextForm.find('#Search_scenario').val()=="light" ? 1 : 2,
						searchingIn:'UsedCars'	
					};

				$_this=$(this);
				$.ajax({
					url:'/ajaxRequests/getNestedList',
					data:params,

					success:function(data){
						var model=$("#"+params.model,contextForm);
						model.empty();
						model.html(data);
						model.selectmenu('refresh');
						model.selectmenu('enable');
						onSelectChanged.apply(model,[]);
					}
				});	
				})
			} else {

				$.each(nestedMap[nested],function(key,val){
					$('#'+key+" option:not(:first)",contextForm).remove();
					$('#'+key,contextForm).selectmenu("refresh");
					$('#'+key,contextForm).selectmenu("disable");
				})
			}
	}

	var changeNested=function(){
			
		var car_type=contextForm.find('#Search_scenario').val()=="light" ? 1  :
				(contextForm.find('#Search_scenario').val()=="parts" && 
				contextForm.find('#Search_type').val()==1 ? 1 : 2);
		var $_this=$(this),
			params={
				value:$_this.val(),
				model:$_this.data('model'),
				nested:$_this.data('nested'),
				type:car_type,
				searchingIn:contextForm.data('form')!='Parts' ? 'UsedCars' : 'Parts',
			}
		if (params.value)
		{
			$.ajax({
				url:'/ajaxRequests/getNestedList',
				data:params,

				success:function(data){

					$(params.nested,contextForm).empty();
					$(params.nested,contextForm).html(data);
					$(params.nested,contextForm).selectmenu('refresh');
					onSelectChanged.apply($(params.nested,contextForm),[]);
				}
			});		
		}
		
	}
});