function ViewItems(conteiner,params,url,collback)
{
	$.ajax({
		url:url,
		data: {data:params},

		success:function(data){

			conteiner.empty();
			conteiner.html(data);

			if (collback)
				collback();

		},

		error:function(data){

		}
	})
	return false;
}

function setNestedSelect(callback)
{
		var params={
			data:{
				value:this.value,
				model:$($(this).data('nested')).attr('name'),
				column:$(this).data('column'),
				onchange:'changeView();',
			}
		};

		var $_this=$(this);

		$.ajax({
			url:'/ajaxRequests/getNestedList',
			data:params,
			dataType:"json",
			success:function(data){

				var nested=$_this.data('nested'),
					select=$(nested);

				var $_parent=select.closest('dd');
					$_parent.
						empty().
						html(data.success);

				select = $('select',$_parent);
				select.selectbox();

				if (callback)
				{
					select.on('change',function(){
						callback();
					});
				}

				return false;
			},
			error:function(data){
				alert('Ошиибка! повторите попытку позднее!');
			}
		});
}


var methods = {

		catalog:function(){
			var params={
				conditions:{
					MoreEqual:{

						price:$('#minCost').val(),
						force:$('#minForce').val(),

					},
					LessEqual:{

						price:$('#maxCost').val(),
						force:$('#maxForce').val()

					},
					equal:{
						car_type:$('#car_type .active a').data('type'),
						id_country:$('#country option:selected').val(),
						brand:$('#carBrands').val(),
						car_model_id:$('#carBrands option:selected').index()>0 ? $('#carModels option:selected').val() : 0,
						transmission:$('#transmission option:selected').val(),
						bascet:$('#bascet option:selected').val(),
					}
				},
				pager:{
					sort:$('#sort .active').data('sort'),
					display:parseInt($('#display .active').text(),10),	
				},
				page:$('.yiiPager .selected').index()

			}
			return params;
		},
		parts:function(){

			var params={
				conditions:{

					MoreEqual:{
						price_buy:$('#minCost').val(),
					},

					LessEqual:{
						price_buy:$('#maxCost').val(),
					},

					equal:{

						car_type:$('#car_type li.active a').data('type'),
						id_country:$('#country option:selected').val(),
						brand:$('#carBrands').val(),
						car_model_id:$('#carBrands option:selected').index()>0 ? $('#carModels').val() : 0,
						category_id:$('#subCategories').val(),
						parent: $('#Categories').val(),

					}
				},
				pager:{
					sort:$('#sort .active').data('sort'),
					display:parseInt($('#display .active').text(),10),
				},
				page:$('.yiiPager .selected').index(),
			}
			return params;
		},
		disc:function(){

			var params={
				min:$('#min').val(),
				max:$('#max').val(),
				minCost:$('#minCost').val(),
				maxCost:$('#maxCost').val(),
				sort:$('#sort .active').data('sort'),
				display:parseInt($('#display .active').text(),10),
			};
			return params;
		}
	}
