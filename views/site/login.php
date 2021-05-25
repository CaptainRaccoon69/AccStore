<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">
     <h1>Авторизация</h1>
     <br>

    <?php $form = ActiveForm::begin([
      'id' => 'signup-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <div class="settings__form-row">
            <p class="settings__form-par">
                Логин<span>*</span>:
        </p>
        <?= $form->field($login_model, 'username')->textInput(['class' => 'settings__form-input', 'autofocus' => true])->label(false) ?>
      </div>

      <div class="settings__form-row">
          <p class="settings__form-par">
              Пароль <span>*</span>:
      </p>
        <?= $form->field($login_model, 'password')->passwordInput(['class' => 'settings__form-input'])->label(false) ?>
        </div>

        <div class="form-buttons">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Войти', ['class' => 'settings__form-submit', 'name' => 'login-button']) ?>
            </div>
            <?php $form->end(); ?>
        </div>


</div>
<br>
