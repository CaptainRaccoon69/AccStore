
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>

<a href="<?php echo Url::to(['admin/clearunpaid']); ?>">Clear unpaid items</a>

<h1>Продажи</h1>

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Товар</th>
            <th scope="col">Категория</th>
            <th scope="col">Цена заказа</th>
            <th scope="col">Количество</th>
            <th scope="col">Пользователь</th>
            <th scope="col">Дата</th>
            <th scope="col">Статус</th>
            <th scope="col">Купон</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($orders as $order) {
            ?>

                <td><?php echo $order['id']; ?></td>
                <th scope="row">
                  <?php
                      if (isset($order['product_name'])) {
                        ?>
                            <img width="25px" src="img/category_img/<?php echo $order['category_img']?>"/>
                            <?php echo $order['product_name'] ?>
                        <?php
                      }
                      else{
                          echo "Товар удалён";
                      }
                  ?>
                </th>
                <td>
                  <?php
                      if (isset($order['category_name'])) {
                          echo $order['category_name'];
                      }
                  ?>
                </td>
                <td><?php echo $order["price"]; ?> руб.</td>
                <td><?php echo $order['count']; ?></td>
                <td>
                    <?php if (isset($order['user_name'])) {
                        echo $order['user_name'];
                    }else{
                        echo $order['user_email'];
                    }  ?>
                </td>
                <td><?php echo $order['date']; ?></td>
                <td><?php echo $order['status']; ?></td>
                <td>
                <?php
                    if (isset($order['coupon_name'])) {
                        echo $order['coupon_name'].'('.$order['coupon_discount'].')';
                    }
                ?>
                </td>

            </tr>
            <?php
        }
        ?>

    </tbody>
</table>
