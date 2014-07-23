
function ViewItems(conteiner,params,url)
{
	$.ajax({
		url:url,
		data: {data:params},

		success:function(data){
			conteiner.empty();
			conteiner.html(data);
			
		},

		error:function(data){
			// console.log(data.responseText)
		}
	})
	return false;
}

serialize = function(obj, prefix) {
  var str = [];
  for(var p in obj) {
    var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
    str.push(typeof v == "object" ?
      serialize(v, k) :
      encodeURIComponent(k) + "=" + encodeURIComponent(v));
  }
  return str.join("&");
}

function getNestedList(params,conteiner,callback)
{
	
	$.ajax({
		url:'ajaxRequests/getNestedList',
		dataType:'json',
		data: {
			data:params
		},

		success:function(data){

			var nestedSelect=conteiner.closest('dd').empty().html(data.select).find('select');
				nestedSelect.selectbox();
			if (callback)
				callback(nestedSelect);
		},

		error:function(data){
			console.log(data)
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
						id_country:$('#country option:selected').val(),
						brand:$('#carBrands option:selected').val(),
						transmission:$('#transmission option:selected').val(),
						bascet:$('#bascet option:selected').val(),
						type:$('#car_type .active a').data('type'),
						//bascet:$('#bascet option:selected').val(),
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
		auto:function(){

		}
	}
