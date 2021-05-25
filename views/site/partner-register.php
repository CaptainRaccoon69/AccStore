<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>



<div class="container">
    <!--<div class="navigation navigation-personal">
        <a href="./index.html" class="navigation__link">Главная</a>
        <span>/</span>
        <a href="./index.html" class="navigation__link">Личный кабинет</a>
        <span>/</span>
        <p class="navigation__path">Покупки</p>
    </div>-->
    <div class="registr">
        <p class="registr__title">
            Принимаем ваши аккаунты к продаже даже в автоматическом режиме
        </p>
        <p class="registr__subtitle">
            Cистема подходит как магазинам, так и частным лицам
        </p>
        <div class="pegistr__row">
            <div class="registr__list">
                <p class="registr__list-title">
                    Что магазин берет на себя?
                </p>
                <div class="registr__list-item">
                    <p class="registr__list-text">
                        1) Автоматическую продажу ваших аккаунтов в русском и иностранном сегментах аудитории по вашей цене.
                    </p>
                    <p class="register__list-sub">
                        *иностранный сегмент составляет 70% всех продаж.
                    </p>
                </div>
                <div class="registr__list-item">
                    <p class="registr__list-text">
                        2) Всестороннюю рекламу магазина и ваших товаров в поисковиках, контекстной рекламе, форумах.
                    </p>
                    <p class="register__list-sub">
                        *мы вкладываем в рекламу сотни тысяч рублей ежемесячно
                    </p>
                </div>
                <div class="registr__list-item">
                    <p class="registr__list-text">
                        3) Общение с клиентами, разбор проблемных случаев.
                    </p>
                    <p class="register__list-sub">
                        *доля замен и возвратов составляет всего 0,5% от всех продаж
                    </p>
                </div>
                <div class="registr__list-item">
                    <p class="registr__list-text">
                        4) Прием платежей.
                    </p>
                    <p class="register__list-sub">
                        *мы принимаем любые виды электронных кошельков и банковский карт, в т.ч. Европу, США и Китай.
                    </p>
                </div>
                <div class="registr__list-item">
                    <p class="registr__list-text">
                        5) Беспроцентные выплаты.
                    </p>
                    <p class="register__list-sub">
                        *мы не берем процент за выплаты своим поставщикам.
                    </p>
                </div>
                <div class="registr__list-item">
                    <p class="registr__list-text">
                        6) Удобный партнерский кабинет.
                    </p>
                </div>
            </div>
            <div class="registr__window">
                <div class="registr__window-item">
                    <p class="registr__window-title">
                        ВОЙТИ В КАБИНЕТ
                    </p>
                    <?php
                        if (Yii::$app->user->isGuest) {
                          ?><a href="<?php echo Url::to(["site/signup"]); ?>" class="register__window-link">
                              Зарегестрируйтесь
                          </a><?php
                        }else{
                          ?>
                          <a href="<?php echo Url::to(["site/partnerrequest"]); ?>" class="register__window-link">
                              Войти в кабинет
                          </a>
                          <?php
                        }
                     ?>

                </div>
            </div>
        </div>
    </div>
    <div class="profile__bar">
        <img src="img/profile.jpg" alt="" class="profile__bar-img">
    </div>
    <div class="profile__req">
        <div class="registr__list">
            <p class="registr__list-title">
                Что требуется от Вас?
            </p>
            <div class="registr__list-item">
                <p class="registr__list-text">
                    1) Периодически загружать аккаунты в магазин..
                </p>
            </div>
            <div class="registr__list-item">
                <p class="registr__list-text">
                    2) Следить за работоспособностью загруженных аккаунтов.
                </p>
            </div>
            <div class="registr__list-item">
                <p class="registr__list-text">
                    3) Нажимать кнопку “Запросить выплату”.
                </p>
            </div>
        </div>
        <div class="registr__list req__list">
            <p class="registr__list-title">
                Как начать работать с нами?
            </p>
            <div class="registr__list-item">
                <p class="registr__list-text">
                    1) Посмотреть на таблицу аккаунтов, которые нас могут заинтересовать.
                </p>
            </div>
            <div class="registr__list-item">
                <p class="registr__list-text">
                    2) Зарегистрироваться в кабинете партнера и заполнить заявку на добавление аккаунтов.
                </p>
            </div>
            <div class="registr__list-item">
                <p class="registr__list-text">
                    3) Ожидать одобрения заявки. В случае отклонения заявки вы увидите причину отказа.
                    В случае одобрения - вы сразу же сможете загружать аккаунты в магазин.
                </p>
            </div>
        </div>
    </div>
    <div class="profile__table">
        <table class="table" cellspacing="0">
            <tr>
                <th align="center" class="table-col-1" >сайт</th>
                <th class="table-col-2" >минимальные условия</th>
                <th class="table-col-3">типы аккаунтов и их краткое описание</th>
                <th class="table-col-4" >минимальное количество поставки</th>
            </tr>
            <tr>
                <td class="table__site-name" align="center" >вконтакте</td>
                <td>1) периодические достаки</td>
                <td>автореги, обязательная регистрация на русские номера +7</td>
                <td>минимальное количество поставки</td>
            </tr>
            <tr>
                <th align="center" class="table-col-1" >сайт</th>
                <th class="table-col-2" >минимальные условия</th>
                <th class="table-col-3">типы аккаунтов и их краткое описание</th>
                <th class="table-col-4" >минимальное количество поставки</th>
            </tr>
            <tr >
                <td class="table__site-name" align="center" rowspan="4">instagram</td>
                <td rowspan="4">
                    1) наличие родной почты <br>
                    2) периодические поставки
                </td>
                <td>аккаунты с 5, 10, 20 публикациями</td>
                <td>
                    от 50 шт в каждом типе аккаунтов
                </td>
            </tr>
            <tr >
                <td>старые автореги, от 6 месяцев</td>
                <td>
                    от 100 шт в каждом типе аккаунтов
                </td>
            </tr>
            <tr >
                <td>
                    раскрученные массфолловингом и масслайкингом
                    (не боты), от 2000 подписчиков
                </td>
                <td>
                    от 1 шт
                </td>
            </tr>
            <tr >
                <td>
                    раскрученные ботами, от 5000 подписчиков
                </td>
                <td>
                    от 1 шт
                </td>
            </tr>
            <tr>
                <th align="center" class="table-col-1" >сайт</th>
                <th class="table-col-2" >минимальные условия</th>
                <th class="table-col-3">типы аккаунтов и их краткое описание</th>
                <th class="table-col-4" >минимальное количество поставки</th>
            </tr>
            <tr>
                <td class="table__site-name" align="center" >facebook</td>
                <td align="center">
                    1) периодические поставки
                    2) ip регистрации - все, кроме микса из стран, РФ и СНГ.
                    Т.е. должна быть сортировка по стране регистрации.
                    3) латинские имена в профиле
                </td>
                <td align="center">аккаунты с почтой в комплекте</td>
                <td align="center">от 500 шт в каждом типе аккаунтов</td>
            </tr>
            <tr>
                <th align="center" class="table-col-1" >сайт</th>
                <th class="table-col-2" >минимальные условия</th>
                <th class="table-col-3">типы аккаунтов и их краткое описание</th>
                <th class="table-col-4" >минимальное количество поставки</th>
            </tr>
            <td align="center" rowspan="7" >twitter</td>
            <td align="center" rowspan="7">
                1) периодические поставки
                2) ip регистрации - все, кроме микса из стран, РФ и СНГ.
                Т.е. должна быть сортировка по стране регистрации.
                3) латинские имена в профиле
            </td>
            <td>любые авторег аккаунты</td>
            <td>от 200 шт в каждом типе аккаунтов</td>
            <tr>
                <td>любые старые аккаунты 2017-2018 годов</td>
                <td>от 100 шт в каждом типе аккаунтов</td>
            </tr>
            <tr>
                <td>любые старые аккаунты до 2017 года</td>
                <td>от 50 шт в каждом типе аккаунтов</td>
            </tr>
            <tr>
                <td>любые раскрученные аккаунты 50-500 фолловеров</td>
                <td>от 50 шт в каждом типе аккаунтов</td>
            </tr>
            <tr>
                <td>любые раскрученные аккаунты 500-2000 фолловеров</td>
                <td>от 20 шт в каждом типе аккаунтов</td>
            </tr>
            <tr>
                <td>любые раскрученные аккаунты 2000+ фолловеров</td>
                <td>от 10 шт в каждом типе аккаунтов</td>
            </tr>
            <tr>
                <td>любые раскрученные аккаунты 10000+ фолловеров</td>
                <td>от 1 шт </td>
            </tr>
            <tr>
                <th align="center" class="table-col-1" >сайт</th>
                <th class="table-col-2" >минимальные условия</th>
                <th class="table-col-3">типы аккаунтов и их краткое описание</th>
                <th class="table-col-4" >минимальное количество поставки</th>
            </tr>
            <td class="table__site-name" align="center" rowspan="4" >reddit</td>
            <td align="center" rowspan="4">
                1) периодические поставки
                2) ip регистрации - все, кроме микса из стран, РФ и СНГ.
                Т.е. должна быть сортировка по стране регистрации.
                3) латинские имена в профиле
            </td>
            <td>любые авторег аккаунты</td>
            <td>от 200 шт в каждом типе аккаунтов</td>
            <tr>
                <td>любые старые аккаунты 2017-2018 годов</td>
                <td>от 100 шт в каждом типе аккаунтов</td>
            </tr>
            <tr>
                <td>любые старые аккаунты до 2017 года</td>
                <td>от 50 шт в каждом типе аккаунтов</td>
            </tr>
            <tr>
                <td>любые раскрученные аккаунты</td>
                <td>от 1 шт</td>
            </tr>
            <tr>
                <th align="center" class="table-col-1" >сайт</th>
                <th class="table-col-2" >минимальные условия</th>
                <th class="table-col-3">типы аккаунтов и их краткое описание</th>
                <th class="table-col-4" >минимальное количество поставки</th>
            </tr>
            <tr>
                <td class="table__site-name" align="center" >mail</td>
                <td align="center">
                    1) периодические поставки
                </td>
                <td>старые почты, от 6 месяцев</td>
                <td>от 1000 шт</td>
            </tr>
            <tr>
                <th align="center" class="table-col-1" >сайт</th>
                <th class="table-col-2" >минимальные условия</th>
                <th class="table-col-3">типы аккаунтов и их краткое описание</th>
                <th class="table-col-4" >минимальное количество поставки</th>
            </tr>
            <td class="table__site-name" align="center" rowspan="2">
                yahoo
            </td>
            <td align="center" rowspan="2">
                1) периодические поставки
            </td>

            <td>старые почты, от 6 месяцев</td>
            <td>от 1000 шт</td>
            <tr>
                <td>почты с сортировкой по стране регистрации</td>
                <td>от 1000 шт</td>
            </tr>
            <tr>
                <th align="center" class="table-col-1" >сайт</th>
                <th class="table-col-2" >минимальные условия</th>
                <th class="table-col-3">типы аккаунтов и их краткое описание</th>
                <th class="table-col-4" >минимальное количество поставки</th>
            </tr>
            <tr>
                <td class="table__site-name" align="center" rowspan="8">другие почты</td>
                <td align="center" rowspan="8">1) периодические поставки</td>
                <td>aol</td>
                <td>от 500 шт</td>
            </tr>
            <tr>
                <td>hotmail</td>
                <td>от 500 шт</td>
            </tr>
            <tr>
                <td>outlook</td>
                <td>от 500 шт</td>
            </tr>
            <tr>
                <td>rediffmail</td>
                <td>от 500 шт</td>
            </tr>
            <tr>
                <td>gmx</td>
                <td>от 500 шт</td>
            </tr>
            <tr>
                <td>protonmail</td>
                <td>от 500 шт</td>
            </tr>
            <tr>
                <td>o2</td>
                <td>от 500 шт</td>
            </tr>
            <tr>
                <td>любые другие почты, не представленные в магазине</td>
                <td>от 500 шт</td>
            </tr>
            <tr>
                <th align="center" class="table-col-1" >сайт</th>
                <th class="table-col-2" >минимальные условия</th>
                <th class="table-col-3">типы аккаунтов и их краткое описание</th>
                <th class="table-col-4" >минимальное количество поставки</th>
            </tr>
            <tr>
                <td align="center" rowspan="15" >другие аккаунты</td>
                <td align="center" rowspan="15" >1) периодические поставки</td>
                <td>amazon</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>avito</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>steam</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>spaces</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>drom</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>auto</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>olx</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>linkedin</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>wordpress</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>mamba</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>spotify</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>spanchat</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>textnow</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>telegram</td>
                <td>от 200 шт</td>
            </tr>
            <tr>
                <td>другие аккаунты, не представленные в магазине</td>
                <td>от 200 шт</td>
            </tr>
        </table>
    </div>
</div>
