<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<link rel="stylesheet" href="css/personal-area.css">

<div id="notifications">
    <?php if (Yii::$app->session->hasFlash('success_signup')) { ?>
      <div class="success">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php echo Yii::$app->session->getFlash('success_signup'); ?>
      </div>
    <?php } ?>
</div>

<div class="container">
    <!--<div class="navigation navigation-personal">
        <a href="./index.html" class="navigation__link">Главная</a>
        <span>/</span>
        <a href="./index.html" class="navigation__link">Личный кабинет</a>
        <span>/</span>
        <p class="navigation__path">Покупки</p>
    </div>-->

    <?php include_once("personal-area-head.php");?>


            <div class="personal__area-orders">
                <h2 class="personal__area-title">
                    Реферальная программа
                </h2>
                <div class="payment__area-inner">
                    <div class="personal__calc">
                        <div class="personal__calc-item">
                            <p class="personal__calc-par">
                                Всего выплачено:
                            </p>
                            <p class="personal__calc-count">
                                <?php echo Yii::$app->user->identity->ref_count; ?> руб.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="personal__content">
                    <div class="personal__links">
                        <h2 class="personal__area-title">
                            Ссылки и купоны
                        </h2>
                        <div class="personal__link-item">
                            <p class="personal__link-text">
                                Ссылка №1:
                            </p>
                            <input type="text" class="personal__link-input" value="<?php echo "http://".$_SERVER['SERVER_NAME'].Url::to(["site/signup", "ref_id" => Yii::$app->user->identity->id]); ?>">
                        </div>
                        <div class="personal__link-item">
                            <p class="personal__link-text">
                                Ссылка №2:
                            </p>
                            <input type="text" class="personal__link-input">
                        </div>
                        <div class="personal__link-item">
                            <p class="personal__link-text info">
                                При переходе по ссылке №2 происходит мгновенный редирект
                            </p>
                        </div>
                    </div>
                    <div class="personal__information">
                        <h2 class="personal__area-title">
                            Информация:
                        </h2>
                        <div class="personal__info">
                            <div class="personal__info-item">
                                <img src="images/checked.png" alt="" class="personal__info-checked">
                                <p class="personal__info-text">
                                    Вы получаете 5% от суммы каждого заказа приведенного вами клиента.
                                    Выплаты производятся в течение 3 суток с момента запроса.
                                </p>
                            </div>
                            <div class="personal__info-item">
                                <img src="images/checked.png" alt="" class="personal__info-checked">
                                <p class="personal__info-text">
                                    Если клиент уже совершал покупки на нашем сервисе или же принадлежит другому рефералу, то за вами он не закрепится.
                                </p>
                            </div>
                            <div class="personal__info-item">
                                <img src="images/checked.png" alt="" class="personal__info-checked">
                                <p class="personal__info-text">
                                    На данный момент реферал закрепляется за вами на 24 месяца. Спустя 24 месяца реферал открепляется от вас и вы больше не будете получать по нему выплату.
                                </p>
                            </div>
                            <div class="personal__info-item">
                                <img src="images/checked.png" alt="" class="personal__info-checked">
                                <p class="personal__info-text">
                                    За нарушение <a href="#" class="personal__info-link" > правил работы </a> сервиса и партнерской программы администрация сервиса имеет право блокировать партнерские ссылки и аккаунты без выплаты вознаграждения.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="personal__statistic">
                    <h2 class="personal__area-title">
                        Статистика:
                    </h2>
                </div>
            </div>
        </div>
    </section>
