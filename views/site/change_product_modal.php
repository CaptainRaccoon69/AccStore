<?php
use yii\helpers\Url;
use \yii\widgets\ActiveForm;
?>


<div class="popup-fade">
  <div class="popup">
    <a class="popup-close" href="#">Закрыть</a>
    <?php $form = ActiveForm::begin([
        'id' => 'change-form',
        'layout' => 'horizontal',
    ]);
    ?>
    <div class="modal-body">

      <?php echo $form->field($product_model, "product_id")->hiddenInput(['id' => 'change-input-id'])->label(false); ?>

      <?php echo $form->field($product_model, "name")->textarea(["id" => "change-input-name"]); ?>

      <?php echo $form->field($product_model, "description")->textarea(["id" => "change-input-description"]); ?>

      <?php echo $form->field($product_model, "price")->textInput(["id" => "change-input-price"]); ?>

      <?php echo $form->field($product_model, "category_id")->dropDownList([$categories], ["id" => "change-input-category"]); ?>

      <?php echo $form->field($product_model, "count")->textInput(["id" => "change-input-count", 'disabled' => true]); ?>

      <?php echo $form->field($product_model, "content")->fileInput(["id" => "change-input-content"]); ?>

      <label>Hidden product</label>
      <input id="hidden-checkbox" type="checkbox"/>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" id="delete-btn" class="btn btn-secondary">Delete</button>
      <?= Html::submitButton('ChangeProduct', ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
      <?php ActiveForm::end(); ?>
  </div>
</div>
</div>
