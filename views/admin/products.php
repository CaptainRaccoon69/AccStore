
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
            $('#myModal').modal();


        })
                .fail(function () {
                    alert('Произошла ошибка при отправке данных!');
                });

    }

    function deleteProduct(id) {
        $.ajax({
            url: '<?php echo Url::to(['admin/deleteproduct']); ?>',
            type: 'post',
            data: {'id': id}
        }).done(function (data) {
            //alert("deleted");
            $('#product-row-' + id).remove();
            $('#myModal').modal("hide");


        })
                .fail(function () {
                    alert('Произошла ошибка при отправке данных!');
                });
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
                });

    }


</script>


<div id="notifications">
    <?php if (Yii::$app->session->hasFlash('product_added')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('product_added'); ?>
        </div>
        <?php
    }
    ?>
</div>


<h2>Добавить новый товар</h2>
<?php
$form = ActiveForm::begin([
            'id' => 'add-product-form',
            'layout' => 'horizontal',
        ]);
?>
<?php echo $form->field($product_model, "name")->textarea(["class" => "product-input"])->label("Название"); ?>
<?php echo $form->field($product_model, "description")->textarea(["class" => "product-input"])->label("Описание"); ?>
<?php echo $form->field($product_model, "price")->textInput(["class" => "product-input"])->label("Цена за 1 шт."); ?>
<?php echo $form->field($product_model, "category_id")->dropDownList($categories, ["class" => "product-input"])->label("Категория"); ?>
<?php echo $form->field($product_model, "content")->fileInput(["class" => "product-input"])->label("Файл с аккаунтами"); ?>

<button class="btn btn-primary" type="submit">Добавить товар</button>
<?php
$form->end();
?>


<h2>Товары</h2>
<p>Чтобы редактировать товар, нажмите на него</p>

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Название</th>
            <th scope="col">Категория</th>
            <th scope="col">Цена за 1 шт.</th>
            <th scope="col">Количество</th>
            <th scope="col">Владелец товара</th>
            <th scope="col">Скачать товар</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($products as $product) {
            ?>
            <tr id="product-row-<?php echo $product['id']; ?>" >
                <th><?php echo $product['id']; ?></th>
                <th scope="row" onclick="change(<?php echo $product['id']; ?>)">
                  <div class="th-select">
                    <img width="25px" src="img/category_img/<?php echo $product['img'] ?>"/>
                    <?php echo $product['name'] ?>
                  </div>
                </th>
                <td><?php echo $product['category_name'] ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['count']; ?> руб.</td>
                <?php
                if ($product["owner"]!="admin"){ ?>
                    <td><?php echo $product['owner_name']." (заявка №".$product["request_id"].")"; ?></td>
                <?php }
                else{
                    ?> <td><?php echo $product['owner_name']; ?></td> <?php
                } ?>
                <td><a Download href="products/<?php echo $product['content']; ?>">Download</a></td>

            </tr>
            <?php
        }
        ?>

    </tbody>
</table>




<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Изменить товар</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $form = ActiveForm::begin([
                        'id' => 'change-form',
                        'layout' => 'horizontal',
            ]);
            ?>
            <div class="modal-body">

                <?php echo $form->field($product_model, "product_id")->hiddenInput(['id' => 'change-input-id'])->label(false); ?>

                <?php echo $form->field($product_model, "name")->textarea(["id" => "change-input-name"])->label("Название"); ?>

                <?php echo $form->field($product_model, "description")->textarea(["id" => "change-input-description"])->label("Описание"); ?>

                <?php echo $form->field($product_model, "price")->textInput(["id" => "change-input-price"])->label("Цена за 1 шт."); ?>

                <?php echo $form->field($product_model, "category_id")->dropDownList($categories, ["id" => "change-input-category"])->label("Категория"); ?>

                <?php echo $form->field($product_model, "count")->textInput(["id" => "change-input-count", 'disabled' => true])->label("Количество"); ?>

                <?php echo $form->field($product_model, "content")->fileInput(["id" => "change-input-content"])->label("Файл с аккаунтами"); ?>

                <label>Скрыть товар</label>
                <input id="hidden-checkbox" type="checkbox"/>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" id="delete-btn" class="btn btn-secondary">Удалить</button>
                <?= Html::submitButton('Применить изменения', ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
