<div id="login" >
            <dl>
                <dt>
                    Авторизация
                </dt>
                <!-- <dd>
                    <span class="req">*</span>
                    - поля, обязательные для заполнения
                </dd> -->
            </dl>
        <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'action' => $this->createUrl('/account/login'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnType' => false,
            'validateOnSubmit' => true,
            'afterValidate' => "js: function(form, data, hasError) {
                    if ( hasError ) return;
                    var action = form.attr('action');
                    $.ajax({
                        url: action,
                        type: 'POST',
                        dataType: 'json',
                        data: form.serialize()+'&controller=".$this->id."',
                        success: function(data) {

                            if ( !data.error ) {
                                if (data.user)
                                {
                                    $('#accept .user').empty();
                                    $('#accept .user').append(data.user);
                                }

                                $('.reg').empty().append(data.lk);
                                if ($('.content .bascet').length)
                                {
                                    $('.right.auth').slideUp().delay(200).remove();
                                    var li=$('.content .basket li').removeClass('active').eq(1);
                                    var width=li.removeClass('hide').width();
                                    li.addClass('active');
                                    $('.bascet:first').addClass('hide').removeClass('tab-active');
                                    $('#accept').addClass('tab-active').removeClass('hide');
                                    li.width(0);
                                    li.animate({width:width},200,function(){
                                        li.css('width','auto')
                                    });
                                }
                                $.fancybox.close();
                            } else {
                                var error=data.error.email ? data.error.email : data.error.password;
                                $('.flash').text(error);
                            }
                        },
                        error:function(){
                            
                        }
                    });
                    return false;
                }"
        ),
            'htmlOptions' => array('class' => 'request_form')
        )) ?>
        <div class="flash" style='color:red;font-size:10px;'>
            <?php echo $form->error($model,'email',array('style'=>'color:red;font-size:10px;'));?>
            <?php echo $form->error($model,'password',array('style'=>'color:red;font-size:10px;'));?>
        </div>
    <ul>
        <li>
            <input type="hidden" name="return" value="<?=$_GET['return']?>">
            <?php echo $form->labelEx($model,'email');?>
            <?php echo $form->textField($model,'email',array('class'=>'i-text','width'=>'255px','autocomplete'=>'off')); ?>
        </li>
        <li>
            <?php echo $form->labelEx($model,'password');?>
            <?php echo $form->passwordField($model,'password',array('class'=>'i-text','width'=>'255px','autocomplete'=>'off')); ?>
            
        </li>
        <li>
            <a href="/account/registration">Регистрация</a>
            
        </li>
    </ul>
    <?=CHtml::submitButton('Авторизироваться',array('class'=>'i-submit'))?>
    <?php $this->endWidget(); ?>
</div>
</div>
</div>
