

<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
 ?>

<script>


function change(id) {

      var coupon_id = id;
      var coupon_name = $('#coupon-name-'+id).text();
      var coupon_discount = $('#coupon-discount-'+id).text();
      $('#delete-btn').off();

      $('#delete-btn').click(function(){
          deleteCoupon(coupon_id);
      });
      $("#change-input-id").val(coupon_id);
      $('#change-input-name').val(coupon_name);
      $('#change-input-discount').val(coupon_discount);
      $('#myModal').modal();


}

function deleteCoupon(id){
  $.ajax({
      url: '<?php echo Url::to(['admin/deletecoupon']); ?>',
      type: 'post',
      data: {'id': id}
  }).done(function (data) {
      //alert("deleted");
      $('#coupon-row-'+id).remove();
      $('#myModal').modal("hide");


  })
          .fail(function () {
              alert('Произошла ошибка при отправке данных!');
          })
}


</script>

<div id="notifications">
    <?php if( Yii::$app->session->hasFlash('coupon_added') ){ ?>
       <div class="alert alert-success alert-dismissible" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <?php echo Yii::$app->session->getFlash('coupon_added'); ?>
       </div>
        <?php
          }
        ?>
</div>

<h1>Добавить новый купон</h1>

<?php

$form = ActiveForm::begin([
    'id' => 'add-coupon-form',
    'layout' => 'horizontal',
]);
?>
            <?php echo $form->field($coupon_model, "name")->textInput(["class"=>"coupon-input"])->label("Название купона"); ?>
            <?php echo $form->field($coupon_model, "discount")->textInput(["class"=>"coupon-input"])->label("% скидки"); ?>

            <button class="btn btn-primary" type="submit">Добавить купон</button>
<?php
    $form->end();
?>


<h1>Купоны</h1>


<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">% скидки</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($coupons as $coupon) {
            ?>
            <tr id="coupon-row-<?php echo $coupon['id']; ?>" onclick="change(<?php echo $coupon['id']; ?>)">

                <td id="coupon-name-<?php echo $coupon['id']; ?>"><?php echo $coupon['name'] ?></td>
                <td id="coupon-discount-<?php echo $coupon['id']; ?>"><?php echo $coupon['discount'] ?></td>

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
                <h5 class="modal-title" id="exampleModalLongTitle">Изменить купон</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'change-form',
                'layout' => 'horizontal',
            ]); ?>
            <div class="modal-body">

                  <?php echo $form->field($coupon_model, "id")->hiddenInput(['id'=>'change-input-id'])->label(false) ?>
                  <?php echo $form->field($coupon_model, "name")->textInput(['id'=>'change-input-name'])->label("Название купона") ?>
                  <?php echo $form->field($coupon_model, "discount")->textInput(['id'=>'change-input-discount'])->label("% скидки") ?>

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
