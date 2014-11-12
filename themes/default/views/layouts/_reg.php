<div class="reg">
        			<ul>
                        <?
                            $authenticated=Yii::app()->user->isGuest;
                        ?>
                    <?if ($authenticated){?>
        				<li>
        					<a class="auth" href="#login">Войти</a>
        				</li>
        				<li>
        					<a href="/account/registration">Регистрация</a>
        				</li>
                    <?}
                        else 
                    {?>
                        <li>
                            <a href="/account/">Личный кабинет</a>
                        </li>
                        <li>
                            <a href="/account/logout">Выйти</a>
                        </li>
                        <?}?>
        			</ul>
        	</div>