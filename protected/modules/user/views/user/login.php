<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>
<style type="text/css">
body {
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
}

.form-signin {
    max-width: 300px;
    padding: 19px 29px 29px;
    margin: 0 auto 20px;
    background-color: #fff;
    border: 1px solid #e5e5e5;
    -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
            border-radius: 5px;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
       -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            box-shadow: 0 1px 2px rgba(0,0,0,.05);
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
    margin-bottom: 10px;
}
.form-signin input[type="text"],
.form-signin input[type="password"] {
    font-size: 16px;
    height: auto;
    margin-bottom: 15px;
    padding: 7px 9px;
}

</style>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions' => array(
        'class' => 'form-signin'
    )
)); ?>
    <h2 class="form-signin-heading">Вход</h2>
    <?php echo $form->textFieldControlGroup($model, 'username', array('class' => 'input-block-level')); ?>
    <?php echo $form->passwordFieldControlGroup($model, 'password', array('class' => 'input-block-level')); ?>
    <?php echo $form->checkboxControlGroup($model, 'rememberMe'); ?>
    <?php echo TbHtml::submitButton('Войти', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
<?php $this->endWidget(); ?>