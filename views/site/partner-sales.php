
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>

<script>




  function change(id) {
    $.ajax({
      url: '<?php echo Url::to(['site/getproductinfo']); ?>',
      type: 'post',
      data: {'id': id}
    }).done(function (data) {
      var product = JSON.parse(data);
      var product_id = product['id'];
      var name = product['name'];
      var description = product['description'];
      var price = product['price'];
      var count = product['count'];
      var category = product['category'];
      var category_id = product['category_id'];
      var img = product['img'];
      var content = product['content'];
      var is_hide = product['is_hide'];
      $('#delete-btn').off();
      $('#delete-btn').click(function () {
          deleteProduct(product_id);
      });
      $("#change-input-id").val(product_id);
      $('#change-input-name').val(name);
      $('#change-input-description').val(description);
      $('#change-input-price').val(price);
      $('#change-input-count').val(count);
      $('#change-input-category').val(category_id);
      $('#change-img').attr("src", "img/category_img/" + img);
      if (is_hide) {
          $('#hidden-checkbox').prop('checked', true);
      } else {
          $('#hidden-checkbox').prop('checked', false);
      }
      $('#hidden-checkbox').off();
      $('#hidden-checkbox').click(function () {
          hideProduct(product_id);
      })
      $('.popup-fade').fadeIn();


    })
            .fail(function () {
              alert('Произошла ошибка при отправке данных!');
            })

  }

  function deleteProduct(id) {
    $.ajax({
      url: '<?php echo Url::to(['admin/deleteproduct']); ?>',
      type: 'post',
      data: {'id': id}
    }).done(function (data) {
      //alert("deleted");
      $('#product-row-' + id).remove();
      $('.popup-fade').fadeOut();


    })
            .fail(function () {
              alert('Произошла ошибка при отправке данных!');
            })
  }
  ;

  function hideProduct(id) {
    var hide;
    if ($('#hidden-checkbox').is(':checked')) {
      hide = 1;
    } else {
      hide = 0;
    }

    $.ajax({
      url: '<?php echo Url::to(['admin/hideproduct']); ?>',
      type: 'post',
      data: {'id': id, 'hide': hide}
    }).done(function (data) {

    })
            .fail(function () {
              alert('Произошла ошибка при отправке данных!');
            })

  }


</script>

<?php include_once("partner-head.php");

if (!Yii::$app->user->identity->is_partner) {
    ?><h1>Вы не являетесь партнёром, отправьте заявку<h2><?php
    return 0;
}
?>

<br>
<h1>Ваши продажи</h1>
<br>

<h2>Продано на сумму: <?php echo $total_price; ?> руб. <h2>
<br>


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
        <th class="orders__header-quantity">
            Цена
        </th>
        <th class="orders__header-price">
            Статус
        </th>
        <th class="orders__header-price">
            Дата покупки
        </th>
    </tr>
    <?php foreach ($orders as $key => $order): ?>
      <tr class="orders__row">

          <td class="orders__row-number">
              <?php echo $order['id']; ?>
          </td>
          <td class="orders__row-text">
              <img width="25px" src="img/category_img/<?php echo $order['img'] ?>"/>
              <?php echo $order['name']; ?>
          </td>
          <td class="orders__row-quantity">
              <?php echo $order['count']; ?> шт.
          </td>
          <td class="orders__row-quantity">
              <?php echo $order['price']; ?> руб.
          </td>
          <td class="orders__row-price">
              <?php echo $order['status']; ?>
          </td>
          <td class="orders__row-price">
              <?php echo $order['date']; ?>
          </td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
