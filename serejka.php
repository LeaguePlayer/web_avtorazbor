<html>
<head>
	<title></title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<div class="flash"></div>
	<?
		if (empty($_GET))
		{
	?>
	<form name="form">
		<div class="row">
			<label for="fio" name="ФИО">Введите Ваше ФИО *</lable>
			<input type="text" id="fio" placeholder="ФИО...">
		</div>
		<div class="row">
			<label for="pas">Введите пароль *</lable>
			<input name="Пароль" type="password" id="pas" placeholder="Пароль...">
		</div>
		<div class="row">
			<label for="occupation">Род занятий</label>
			<select id="occupation" name="Род_занятий">
				<option>-------</option>
				<option>Кухарка</option>
				<option>Плотник</option>
				<option>Хипстер</option>
				<option>Бывалый</option>
			</select>
		</div>
		<div class="row">
			<label for="gender">Пол:</lable>
				<div class="row">
					<label for="gender_1">Мужской</label>
					<input type="radio" name="Пол" id="gender_1" value="Мужской">
					<label for="gender_2">Женский</label>
					<input type="radio" name="Пол" id="gender_2" value="Женский">
				</div>
		</div>
		<div class="row">
			<label for="info">Сведения об образовании</label>
			<br>
			<textarea id="info" name="Сведения об образовании">
			</textarea>
		</div>
		<div class="row">
			<label>Ваши предпочтения (один или несколько вариантов)</lable><br>
			<div class="row">
				<label for="item_1">Первое</label>
				<input type="Checkbox" name="Предпочтения[Первое]" id="item_1" value="Первое">
			</div>
			<br>
			<div class="row">
				<label for="item_2">Второе</label>
				<input type="Checkbox" name="Предпочтения[Второе]" id="item_2" value="Второе">
			</div>
			<br>
			<div class="row">
				<label for="item_3">Третье</label>
				<input type="Checkbox" name="Предпочтения[Третье]" id="item_3" value="Третье">
			</div>
			<br>
			<div class="row">
				<label for="item_4">Четвертое</label>
				<input type="Checkbox" name="Предпочтения[Четвертое]" id="item_4" value="Четвертое">
			</div>
			<br>
		</div>
		<input type="reset" value="очистить форму">
		<input type="submit" value="отправить форму">
	</form>
	<?} else
	{
		var_dump("<pre>",$_GET);
}?>
</body>
</html>
<style>
	lable{
		display: inline-block;
	}
	input{
		display: inline-block;
	}
	input[type=submit]{
		background: blue;
	}
	input[type=submit]:hover{
		background: red;
	}
	.flash{
		color:red;
	}
</style>
