<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>



<script>

    function makeNewProduct(id){
      $.ajax({
          url: '<?php echo Url::to(['site/getrequestinfo']); ?>',
          type: 'post',
          data: {'id': id}
      }).done(function (data) {
          var request = JSON.parse(data);
          $("#product_name").val(request["description"]);
          $("#change-input-byrequest").val(request["id"]);
          $("#product_description").val(request["description"]);
          $("#product_category").val(request["category_id"]);
          $("#load-form-wrap").css({"display":"block"});
      })
      .fail(function () {
          alert('Произошла ошибка при отправке данных!');
      })
    };

    function deleteUnsold(id){
      $.ajax({
          url: '<?php echo Url::to(['site/deleteunsold']); ?>',
          type: 'post',
          data: {'id': id}
      }).done(function (data) {
          location.reload();
      })
      .fail(function () {
          alert('Произошла ошибка при отправке данных!');
      })
    };


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


<div id="notifications">
    <?php if (Yii::$app->session->hasFlash('request_sent')) { ?>
      <div class="success">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php echo Yii::$app->session->getFlash('request_sent'); ?>
      </div>
    <?php } ?>

    <?php if (Yii::$app->session->hasFlash('product_added')) { ?>
      <div class="success">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php echo Yii::$app->session->getFlash('product_added'); ?>
      </div>
    <?php } ?>

    <?php if (Yii::$app->session->hasFlash('products_removed')) { ?>
      <div class="success">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php echo Yii::$app->session->getFlash('products_removed'); ?>
      </div>
    <?php } ?>
</div>

<div class="container">
    <?php include_once("partner-head.php"); ?>
    <div class="partner__request">

      <div class="tab">
          <button id="my-requests-btn" class="partner__buttons-link tablinks" onclick="openTab(event, 'my_requests')">Текущие заявки на поставку</button>
          <button id="new-request-btn" class="partner__buttons-button tablinks" onclick="openTab(event, 'new_request')">Заявка на поставку аккаунтов</button>
      </div>
      <br>
      <div id="new_request" class="tabcontent"><!-- Блок с формной на новую заявку -->
        <!--<h2 class="personal__area-title">
            Заявка на поставку аккаунтов
        </h2>
        <div class="partner__buttons">
            <a href="#" class="partner__buttons-link">
                Текущие заявки на поставку
            </a>
            <button class="partner__buttons-button">Добавить новую заявку</button>
        </div>-->
        <div class="partner__panel">
            <a href="#" class="partner__panel-link">Категория аккаунтов<span>*</span></a>
            <a href="#" class="partner__panel-link">Общее описание<span>*</span></a>
            <a href="#" class="partner__panel-link">IP страны регистрации<span>*</span></a>
            <a href="#" class="partner__panel-link">Формат аккаунтов<span>*</span></a>
            <a href="#" class="partner__panel-link">Возможный объем поставок, шт<span>*</span></a>
        </div>

        <?php $form = ActiveForm::begin([
            'id' => 'partner-request-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
            ],
        ]); ?>


            <div class="request__form-inputs">
                <a href="#" class="partner__panel-link responsive">Категория аккаунтов<span>*</span></a>
                    <?php echo $form->field($partner_request_model, "category_id")->dropDownList($categories,["class"=>"request__form-select"])->label(false); ?>
                <a href="#" class="partner__panel-link responsive">Общее описание<span>*</span></a>
                    <?= $form->field($partner_request_model, 'description')->textInput(["class"=>"request__form-input"])->label(false); ?>
                <a href="#" class="partner__panel-link responsive">IP страны регистрации<span>*</span></a>
                    <?= $form->field($partner_request_model, 'country')->textInput(["class"=>"request__form-input"])->label(false); ?>
                <a href="#" class="partner__panel-link responsive">Формат аккаунтов<span>*</span></a>
                <?= $form->field($partner_request_model, 'format')->textInput(["class"=>"request__form-input"])->label(false); ?>
                <a href="#" class="partner__panel-link responsive">Возможный объем поставок, шт<span>*</span></a>
                <?= $form->field($partner_request_model, 'count')->textInput(["class"=>"request__form-count"])->label(false); ?>
                <select name="" id="" class="request__form-time">
                    <option value="" class="request__form-opt">В день</option>
                    <option value="" class="request__form-opt">В день</option>
                    <option value="" class="request__form-opt">В день</option>
                </select>
              </div>



            <div class="request__form-row">
                <div class="request__list">
                    <p class="request__list-title">
                        Что будет после регистрации?
                    </p>
                    <div class="request__list-item">
                        <img src="img/request-1.png" alt="" class="request__list-num">
                        <p class="request__form-txt">Заявка будет обработана в течении 48 часов.</p>
                    </div>
                    <div class="request__list-item">
                        <img src="img/request-2.png" alt="" class="request__list-num">
                        <p class="request__form-txt">
                            После регистрации, в личном кабинете вы сможете добавлять и отправлять на проверку новые заявки.
                        </p>
                    </div>
                    <div class="request__list-item">
                        <img src="img/request-3.png" alt="" class="request__list-num">
                        <p class="request__form-txt">
                            Если заявка будет одобрена, то вы получите доступ в личный кабинет партнера и сможете загружать туда аккаунты.
                            О любом решении мы уведомим вас по почте, а также в статусе заявки в личном кабинете.
                        </p>
                    </div>
                </div>
                <div class="request__form-submit">
                    <div class="request__form-buttons">
                        <div class="request__form-add">
                            <img src="img/plus-black.png" alt="" class="request__from-plus">
                            <button class="request__form-btn">Добавить еще одну строку</button>
                        </div>
                        <?= Html::submitButton('Отправить заявку', ['class' => 'request__form-send', 'name' => 'send-button']) ?>
                    </div>
                    <p class="request__form-info">
                        <span>*</span> - Все поля обязательны к заполнению
                    </p>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
      </div>

      <div id="my_requests" class="tabcontent">
            <h3 class="current__request-subtitle">Ваши заявки на поставку аккаунтов</h3>
            <br>


            <div class="orders__table-wrapper">
              <table class="orders__table">
                  <tr class="orders__header">
                      <th class="orders__header-number">
                          №
                      </th>
                      <th class="">
                          Дата создания
                      </th>
                      <th class="">
                          Статус
                      </th>
                      <th class="">
                          Информация о продукте
                      </th>
                      <th class="">
                          Цена за 1 шт.
                      </th>
                      <th class="">
                          Загружено\осталось
                      </th>
                      <th class="">
                          Действия
                      </th>
                      <th class="">
                          Выплаты
                      </th>
                  </tr>
                  <?php foreach ($requests as $key => $request): ?>
                    <tr class="orders__row">

                        <td class="orders__row-number">
                            <?php echo $request['id']; ?>
                        </td>
                        <td class="orders__row-text">
                            <?php echo $request['date']; ?>
                        </td>
                        <td class="orders__row-quantity">
                            <?php
                            if ($request['status']=="approved") {
                              ?>
                                Подтверждено
                              <?php
                            }
                            else if($request['status']=="wait"){
                                ?> Ожидает <?php
                            }
                            else if ($request['status']=="rejected") {
                                ?> Отклонено <?php
                            }
                            ?>
                        </td>
                        <td class="orders__row-quantity">
                            <?php echo $request['description']; ?>
                        </td>
                        <td class="orders__row-quantity">
                          руб.
                        </td>
                        <td class="orders__row-price">
                            <?php echo $request['loaded_count']; ?>/<?php echo $request['products_count']; ?> шт.
                        </td>
                        <td class="orders__row-actions">
                            <?php
                            if ($request['status']=="approved") {
                              ?>
                              <br>
                                <a onclick="makeNewProduct(<?php echo $request['id']; ?>)" href="#">Создать на основе этой</a>
                                <br>
                                <br>
                                <a onclick="deleteUnsold(<?php echo $request['id']; ?>)" href="#">Удалить непроданные</a>
                                <br>
                                <br>
                                <a href="<?php echo Url::to(["site/partnerrequest", "id_request"=>$request['id']]); ?>">Показать оставшиеся товары</a>
                                <br>
                                <br>
                              <?php
                            }
                            ?>
                        </td>
                        <td class="orders__row-pays">
                            <?php echo $request['pays']; ?> руб.
                        </td>
                  </tr>
                  <?php endforeach; ?>
              </table>
            </div>



            <div style="display:none;" id="load-form-wrap">

                <br>
                <h1>Загрузить новый товар</h1>
                <br>

                <?php
                $form = ActiveForm::begin([
                    'id' => 'add-product-form',
                    'layout' => 'horizontal',
                  ]);
                ?>
                <?php echo $form->field($product_model, "request_id")->hiddenInput(['class' => 'settings__form-input', 'id' => 'change-input-byrequest'])->label(false); ?>
                  <div class="current__requests-row">
                    <p class="current__requests-name">
                      Название товара <span>*</span>
                    </p>
                    <?php echo $form->field($product_model, "name")->textarea(["class" => "current__requests-textarea", 'id'=>"product_name"])->label(false); ?>
                  </div>
                  <div class="current__requests-row">
                    <p class="current__requests-name">
                      Описание товара <span>*</span>
                    </p>
                    <?php echo $form->field($product_model, "description")->textarea(["class" => "current__requests-textarea", 'id'=>"product_description"])->label(false); ?>
                  </div>
                  <div class="current__requests-row price-row">
                    <p class="current__requests-name">
                      Цена за 1 шт. <span>*</span>
                    </p>
                    <?php echo $form->field($product_model, "price")->textInput(["class" => "current__requests-input", 'id'=>"product_price"])->label(false); ?>
                  </div>
                  <div class="current__requests-row category-row">
                    <p class="current__requests-name">
                      Категория <span>*</span>
                    </p>
                    <?php echo $form->field($product_model, "category_id")->dropDownList($categories, ["class" => "current__requests-select", 'id'=>"product_category"])->label(false); ?>
                  </div>
                  <div class="current__requests-row file-row">
                    <p class="current__requests-name">
                      Файл с аккаунтами <span>*</span>
                    </p>
                    <?php echo $form->field($product_model, "content")->fileInput(["class" => "current__requests-label", "required"=>""])->label(false); ?>
                  </div>
                  <?= Html::submitButton('Добавить товар', ['class' => 'current__request-submit', 'name' => 'send-button']) ?>
                  <?php
                  $form->end();
                  ?>
          </div>

            <br>
            <?php if (Yii::$app->request->get("id_request")) {
                ?> <h1>Ваши товары по заявке № <?php echo Yii::$app->request->get("id_request"); ?></h1> <a href="<?php echo Url::to(["site/partnerrequest"]); ?>">Показать все</a><br> <?php

            }else{
                ?> <h1 class="current__request-title">Ваши товары</h1> <?php
            } ?>

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
                  <tr class="orders__row products__row" id="product-row-<?php echo $product['id']; ?>" onclick="change(<?php echo $product['id']; ?>)">

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


      </div>


    </div>
</div>
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
            <!--<input id="products__modal-file" type="file" class="">
            <label for="products__modal-file" class="products__modal-label">Выберите файл</label>-->
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



<script>
document.getElementById("my-requests-btn").click();
function openTab(evt, tabRequest) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabRequest).style.display = "block";
    evt.currentTarget.className += " active";
}

</script>
