<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="partners__interface">
    <h2 class="personal__area-title partner__area-title">
        Партнерский интерфейс
    </h2>
    <div class="partners__menu">
        <div class="partners__menu-item">
            <img src="img/question.svg" alt="" class="partners__menu-img">
            <!-- <svg src="img/question.svg" width="14" height="15" viewBox="бешеный код" fill="blue"></svg> -->
            <a href="#" class="partners__menu-link">Ответы на вопросы</a>
        </div>
        <div class="partners__menu-item">
            <img src="img/note.svg" alt="" class="partners__menu-img">
            <a href="<?php echo Url::to(["site/partnerrequest"]); ?>" class="partners__menu-link">Мои заявки</a>
        </div>
        <div class="partners__menu-item">
            <img src="img/upload.svg" alt="" class="partners__menu-img">
            <a href="<?php echo Url::to(["site/partnerloadproduct"]); ?>" class="partners__menu-link">Мои товары</a>
        </div>
        <div class="partners__menu-item">
            <img src="img/payment.svg" alt="" class="partners__menu-img">
            <a href="<?php echo Url::to(["site/partnersales"]); ?>" class="partners__menu-link">Продажи</a>
        </div>
        <div class="partners__menu-item">
            <img src="img/profile.svg" alt="" class="partners__menu-img">
            <a href="#" class="partners__menu-link">Настройки профиля</a>
        </div>
        <div class="partners__menu-item">
            <img src="img/exit.svg" alt="" class="partners__menu-img">
            <a href="#" class="partners__menu-link">Выход</a>
        </div>
    </div>
</div>
