$(function(){
	$('form').on('submit',function(){
		if ($('#fio').val() && $('#pas').val())
		{
			var param=$('form').serialize();
		} else {
			$('.flash').text('Введите ФИО и пароль');
			return false;
		}
	})
})