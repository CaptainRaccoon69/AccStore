<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<link rel="stylesheet" href="css/personal-area.css">

<div class="container">
  <div id="notifications">

      <?php if (Yii::$app->session->hasFlash('success_password_update')) { ?>
        <div class="success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo Yii::$app->session->getFlash('success_password_update'); ?>
        </div>
      <?php } ?>

      <?php if (Yii::$app->session->hasFlash('success_email_update')) { ?>
        <div class="success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo Yii::$app->session->getFlash('success_email_update'); ?>
        </div>
      <?php } ?>

      <?php if (Yii::$app->session->hasFlash('success_username_update')) { ?>
        <div class="success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo Yii::$app->session->getFlash('success_username_update'); ?>
        </div>
      <?php } ?>

      <?php if (Yii::$app->session->hasFlash('fail_password_update')) { ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo Yii::$app->session->getFlash('fail_password_update'); ?>
        </div>
      <?php  } ?>

      <?php if (Yii::$app->session->hasFlash('fail_email_update')) { ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo Yii::$app->session->getFlash('fail_email_update'); ?>
        </div>
      <?php  } ?>

      <?php if (Yii::$app->session->hasFlash('fail_username_update')) { ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo Yii::$app->session->getFlash('fail_username_update'); ?>
        </div>
      <?php  } ?>

  </div>

    <?php include_once("personal-area-head.php");?>

    <div class="personal__area-settings">
        <h2 class="personal__area-title">
            Настройки
        </h2>
        <div class="settings__wrapper">
           <div class="settings__content">
           <div class="settings__form-container">
                    <div class="settings__form-item">
                        <p class="settings__form-title">
                            Изменение личных данных:
                        </p>

                        <?php $form = ActiveForm::begin([
                            'layout' => 'horizontal',
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                        ]); ?>

                            <div class="settings__form-row">
                                <p class="settings__form-par">
                                    Имя пользователя:
                            </p>
                            <?= $form->field($change_user_data_model, 'new_username')->textInput(["class"=>"settings__form-input"])->label(false) ?>
                          </div>

                          <div class="settings__form-row">
                              <p class="settings__form-par">
                                  Email: :
                          </p>
                            <?= $form->field($change_user_data_model, 'new_email')->textInput(["class"=>"settings__form-input"])->label(false) ?>
                            </div>

                            <div class="settings__form-row">
                                <p class="settings__form-par">
                                    Старый пароль:
                            </p>
                            <?= $form->field($change_user_data_model, 'old_password')->passwordInput(["class"=>"settings__form-input"])->label(false) ?>
                            </div>

                            <div class="settings__form-row">
                                <p class="settings__form-par">
                                    Новый пароль:
                            </p>
                            <?= $form->field($change_user_data_model, 'new_password')->passwordInput(["class"=>"settings__form-input"])->label(false) ?>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-1 col-lg-11">
                                    <?= Html::submitButton('Сохранить', ['class' => 'settings__form-submit', 'name' => 'update-button']) ?>
                                </div>
                            </div>

                        <?php $form->end(); ?>
                    <!-- </div>         -->


                <div class="settings__form-container">
                    <div class="settings__form-item">
                        <p class="settings__form-title">
                            Данные о платежных системах:
                        </p>
                        <div class="settings__form-row">
                            <p class="settings__form-par">
                                Dash (DASH):
                            </p>
                            <input type="text" class="settings__form-input">
                        </div>
                        <div class="settings__form-row">
                            <p class="settings__form-par">
                                Perfect money USD:
                            </p>
                            <input type="text" class="settings__form-input">
                        </div>
                        <div class="settings__form-row">
                            <p class="settings__form-par">
                                Lightcoin (LTC):
                            </p>
                            <input type="text" class="settings__form-input">
                        </div>
                        <div class="settings__form-row">
                            <p class="settings__form-par">
                                AdvCash:
                            </p>
                            <input type="text" class="settings__form-input">
                        </div>
                        <div class="settings__form-row">
                            <p class="settings__form-par">
                                Monero (XMR):
                            </p>
                            <input type="text" class="settings__form-input">
                        </div>
                        <div class="settings__form-row">
                            <p class="settings__form-par">
                                WebMoney (WMZ):
                            </p>
                            <input type="text" class="settings__form-input">
                        </div>
                        <div class="settings__form-row">
                            <p class="settings__form-par">
                                Ripple (XRP):
                            </p>
                            <input type="text" class="settings__form-input">
                        </div>
                        <div class="settings__form-row">
                            <p class="settings__form-par">
                                Balance:
                            </p>
                            <input type="text" class="settings__form-input">
                        </div>
                        <div class="settings__form-row">
                            <p class="settings__form-par">
                                Qiwi:
                            </p>
                            <input type="text" class="settings__form-input">
                        </div>
                        <div class="settings__form-row">
                            <p class="settings__form-par">
                                Bitcoin Cash (BTC):
                            </p>
                            <input type="text" class="settings__form-input">
                        </div>
                        <div class="settings__form-row">
                            <p class="settings__form-par">
                                BTC (выплаты от $500):
                            </p>
                            <input type="text" class="settings__form-input">
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>
</div>
</div>
