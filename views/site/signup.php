<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>

<div class="site-login">
     <h1>Регистрация</h1>
     <br>

<?php
$form = ActiveForm::begin([
    'id' => 'signup-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]);

?>
<div class="settings__form-row">
    <p class="settings__form-par">
        Логин<span>*</span>:
    </p>
    <?php
        if (Yii::$app->request->get('ref_id')) {
            echo $form->field($signup_model, "ref_id")->hiddenInput(["value" => Yii::$app->request->get('ref_id')])->label(false);
        }
     ?>
    <?php echo $form->field($signup_model, "username")->textInput(['class' => 'settings__form-input','autofocus'=>true])->label(false);?>
    </div>
<div class="settings__form-row">
    <p class="settings__form-par">
        Email<span>*</span>:
    </p>
    <?php echo $form->field($signup_model, "email")->textInput(['class' => 'settings__form-input'])->label(false); ?>
</div>
<div class="settings__form-row">
    <p class="settings__form-par">
        Пароль<span>*</span>:
    </p>
    <?php echo $form->field($signup_model, "password")->passwordInput(['class' => 'settings__form-input'])->label(false);?>
</div>

<?= Html::submitButton('Регистрация', ['class' => 'settings__form-submit', 'name' => 'signup-button']) ?>
<?php
$form->end();
?>
<br>
<br>
</div>
