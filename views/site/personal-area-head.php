<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="personal__area-head">
    <div class="personal__area-info">
        <h2 class="personal__title">
            Личный кабинет
        </h2>
        <div class="personal__area-info_cont">
            <div class="personal__area-item">
                <p class="personal__area-text">
                    Ваш логин:
                </p>
                <p class="personal__area-data">
                    <?php echo Yii::$app->user->identity->username; ?>
                </p>
            </div>
            <div class="personal__area-item">
                <p class="personal__area-text">
                    Ваш Email:
                </p>
                <p class="personal__area-data">
                    <?php echo Yii::$app->user->identity->email; ?>
                </p>
            </div>
            <div class="personal__area-item">
                <p class="personal__area-text">
                    Баланс:
                </p>
                <p class="personal__area-data personal-area-balance">
                    <?php echo Yii::$app->user->identity->money;?> руб.
                </p>
            </div>
        </div>
    </div>
    <div class="personal__area-wrapper">
        <div class="personal__area-menu">
            <img src="img/Gamb.png" alt="" class="personal__area-img">
            <p class="personal__area-btn">Меню кабинета</p>
            <img src="../web/img/arrow-down.png" alt="" class="personal__area-arrow">
        </div>
        <div class="personal__area-dropdown">
            <div class="personal__area-drop">
                <a href="<?php echo Url::to(["site/personalareamain"]); ?>"><button class="personal__area-link">Мои заказы</button></a>
            </div>
            <div class="personal__area-drop">
                <a href="<?php echo Url::to(["site/personalareasettings"]); ?>"><button class="personal__area-link">Настройки</button></a>
            </div>
            <div class="personal__area-drop">
                <a href="<?php echo Url::to(["site/personalareatickets"]); ?>"><button class="personal__area-link">Тикеты</button></a>
            </div>
            <div class="personal__area-drop">
                <a href="<?php echo Url::to(["site/personalarearef"]); ?>"><button class="personal__area-link">Реферальная программа</button></a>
            </div>
            <div class="personal__area-drop">
                <a href="<?php echo Url::to(["site/personalareadesktop"]); ?>"><button class="personal__area-link">Пополнение баланса</button></a>
            </div>
        </div>
  </div>
</div>
