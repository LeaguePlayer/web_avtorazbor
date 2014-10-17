$(function(){
	var name=$('.name');
	var alias=$('.alias');
	if (name.length>0)
	{
		name.bind("change",function(){
			alias.val(cyr2lat(name.val()))
		})
	}
})