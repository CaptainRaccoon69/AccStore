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


    <section class="personal-area">
        <div class="container">
            <div class="personal__area-orders">
                <h2 class="personal__area-title">
                    Ваши заказы
                </h2>
                <table class="orders__table">
                    <tr class="orders__header">
                        <th class="orders__header-number">
                            №
                        </th>
                        <th class="orders__header-name">
                            Наименование
                        </th>
                        <th class="orders__header-quantity">
                            Количество
                        </th>
                        <th class="orders__header-price">
                            Цена
                        </th>
                        <th class="orders__header-seller">
                            Продавец
                        </th>
                        <th class="orders__header-download">
                            Скачать
                        </th>
                        <th class="orders__header-status">
                            Статус
                        </th>
                        <th class="orders__header-ticket">
                            Тикет
                        </th>
                    </tr>
                    <?php foreach ($orders as $key => $order): ?>
                    <tr class="orders__row">

                        <td class="orders__row-number">
                            <?php echo $order['id']; ?>
                        </td>
                        <td class="orders__row-text">
                            <?php
                                if ($order['deleted']) {
                                    echo "Товар удалён";
                                }
                                else {
                                    ?>
                                      <img src="img/category_img/<?php echo $order['img'] ?>" class="personal__item-icon">
                                      <a href="<?php echo Url::to(["site/productinfo","id"=> $order['product_id']]); ?>"><?php echo $order['name'] ?></a>
                                    <?php
                                }
                            ?>
                        </td>
                        <td class="orders__row-quantity">
                            <?php echo $order['count']; ?> шт.
                        </td>
                        <td class="orders__row-price">
                            <?php echo $order['price']; ?> руб.
                        </td>
                        <td class="orders__row-seller">
                            <?php
                            if (!$order['deleted']) {
                                if ($order['seller']=="admin") {
                                    echo "Site";
                                } else{
                                    echo "№ ".$order['seller'];
                                }
                              }
                            ?>
                        </td>
                        <td class="orders__row-download">
                              <?php
                                  if ($order['status']=="reserved") {
                                      ?><p class="shop__item-not">Оплатите товар</p><?php
                                  }
                                  else{
                                      ?><a download href="orders/<?php echo $order['content'] ?>">Скачать txt</a><?php
                                  }
                              ?>
                        </td>
                        <td class="orders__row-status">
                            <div class="orders__row-payment">
                              <?php
                                  if ($order['status']=="reserved") {
                                      ?><p class="orders__row-not">Не оплачено</p>
                                      <a href="<?php echo Url::to(['site/pay', 'id' => $order['id']]); ?>">Оплатить</a><?php
                                  }
                                  else{
                                      ?><p class="shop__item-payed">Oплачено</p><?php
                                  }
                              ?>
                            </div>
                        </td>
                        <td class="orders__row-ticket">
                            Нет
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>


            <div class="personal__area-orders tickets">
                <h2 class="personal__area-title ticket">
                    Ваши тикеты
                </h2>
                <?php
                if ($tickets) {
                 ?>
                <div class="tickets__table-wrapper">
                    <table class="tickets__table">
                        <tr class="tickets__header">
                            <th class="tickets__header-number">
                                №
                            </th>
                            <th class="tickets__header-topic">
                                Тема
                            </th>
                            <th class="tickets__header-status">
                                Статус
                            </th>
                            <th class="tickets__header-date">
                                Дата
                            </th>
                            <th class="tickets__header-message">
                                Сообщение
                            </th>
                            <th class="tickets__header-response">
                                Ответ
                            </th>
                        </tr>

                        <?php foreach ($tickets as $key => $ticket) {
                          ?>

                        <tr class="tickets__row">
                            <td class="tickets__row-number">
                                <?php echo $ticket['id'];?>
                            </td>
                            <td class="tickets__row-topic">
                                <?php echo $ticket['subject']; ?>
                            </td>
                            <td class="tickets__row-status">

                                <?php
                                if ($ticket['status']=="new") {
                                  echo "Новый";
                                }

                                ?>
                            </td>
                            <td class="tickets__row-date">
                                <?php echo $ticket['date']; ?>
                            </td>
                            <td class="tickets__row-message">
                                <?php echo $ticket['message']; ?>
                            </td>
                            <td class="tickets__row-message">
                                <?php echo $ticket['response']; ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>

                    </table>
                </div>
              <?php }
              else{
                  ?> <h2 class="no__tickets">У вас нет тикетов</h2> <?php
              } ?>



            </div>
        </div>
    </section>
</div>
