<div class="user-info">
	<div class="tabs-type">
		Вы: <ul>
				<li ><a href="#" class="active">Физическое</a></li>
				<li ><a href="#">Юридическое</a></li>
			</ul>
	</div>
	    <div class="form " id="phiz">
	        <a href="/account/entry_list" class="cart-list">Список заказов</a>
	        <?=$this->renderpartial('//cart/userForm',array('model'=>$model))?>
	</div>
</div>