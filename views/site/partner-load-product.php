
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
  };

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
}?>

<div id="notifications">
    <?php if (Yii::$app->session->hasFlash('product_added')) { ?>
      <div class="success">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php echo Yii::$app->session->getFlash('product_added'); ?>
      </div>
    <?php } ?>
</div>

<br>


<br>
<h1>Ваши товары</h1>
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
            Категория
        </th>
        <th class="orders__header-quantity">
            Количество
        </th>
        <th class="orders__header-price">
            Цена
        </th>
    </tr>
    <?php foreach ($products as $key => $product): ?>
      <tr class="orders__row products__row" onclick="change(<?php echo $product['id']; ?>)">

          <td class="orders__row-number">
              <?php echo $product['id']; ?>
          </td>
          <td class="orders__row-text">
              <img width="25px" src="img/category_img/<?php echo $product['img'] ?>"/>
              <?php echo $product['name']; ?>
          </td>
          <td class="orders__row-quantity">
              <?php echo $product['category_name']; ?>
          </td>
          <td class="orders__row-quantity">
              <?php echo $product['count']; ?> шт.
          </td>
          <td class="orders__row-price">
              <?php echo $product['price']; ?> руб.
          </td>
    </tr>
    <?php endforeach; ?>
</table>
<br>


<div class="products__modal">
  <div class="products__modal-overlay">
      <div class="products__modal-inner">
        <img src="images/close.png" alt="" class="products__modal-close">
        <div class="products__modal-content">
          <?php $form = ActiveForm::begin([
              'id' => 'change-form',
              'layout' => 'horizontal',
          ]);
          ?>
          <?php echo $form->field($product_model, "product_id")->hiddenInput(['class' => 'settings__form-input', 'id' => 'change-input-id'])->label(false); ?>
          <div class="products__modal-item">
            <p class="products__modal-text">
              Имя товара
            </p>
            <?php echo $form->field($product_model, "name")->textarea(['class' => 'current__requests-textarea', "id" => "change-input-name"])->label(false); ?>
          </div>
          <div class="products__modal-item">
            <p class="products__modal-text">
              Описание товара
            </p>
            <?php echo $form->field($product_model, "description")->textarea(['class' => 'current__requests-textarea', "id" => "change-input-description"])->label(false); ?>
          </div>
          <div class="products__modal-item">
            <p class="products__modal-text">
              Цена за 1 шт.
            </p>
            <?php echo $form->field($product_model, "price")->textInput(['class' => 'products__modal-input', "id" => "change-input-price"])->label(false); ?>
          </div>
          <div class="products__modal-item">
            <p class="products__modal-text">
              Количество считается автоматически из файла с аккаунтами
            </p>
            <?php echo $form->field($product_model, "category_id")->dropDownList($categories, ['class' => 'products__modal-input', "id" => "change-input-category"])->label("Категория"); ?>
          </div>
          <div class="products__modal-item">
            <p class="products__modal-text">
              Количество считается автоматически из файла с аккаунтами
            </p>
            <?php echo $form->field($product_model, "count")->textInput(['class' => 'products__modal-input', "id" => "change-input-count", 'disabled' => true])->label(false); ?>
          </div>
          <div class="products__modal-item">
            <p class="products__modal-text">
              Файл с аккаунтами
            </p>
            <?php echo $form->field($product_model, "content")->fileInput(["class" => "current__requests-label"])->label(false); ?>
          </div>
          <div class="products__modal-item product__checkbox">
            <p class="products__modal-text">
              Скрыть товар
            </p>
            <input id="hidden-checkbox" type="checkbox"/>
          </div>
          <div class="products__modal-buttons">
            <button type="button" id="delete-btn" class="settings__form-submit">Удалить товар</button>
            <?= Html::submitButton('Применить', ['class' => 'settings__form-submit', 'name' => 'change-button']) ?>
            <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
  </div>
</div>
