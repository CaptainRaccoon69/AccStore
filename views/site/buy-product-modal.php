<?php
use yii\helpers\Url;
use \yii\widgets\ActiveForm;

?>


<div id="openModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Покупка товара</h3>
        <a href="#close" title="Close" class="close">×</a>
      </div>
      <div class="modal-body">
				<?php
				$form = ActiveForm::begin(['class' => 'form']);
				echo $form->field($order_model, "product_id")->hiddenInput(['id' => 'order-product-id'])->label(false);
				?>
				<p id="product-name-modal"></p>
				<p>Стоимость 1 шт. <span id="product-price-modal"></span> руб.</p>
				<p>
					Количество: <?php echo $form->field($order_model, "count")->textInput(['class' => 'settings__form-input', 'id' => "product-count-input", "oninput" => "changeFPrice()", "value" => 1, 'type' => 'number'])->label(false); ?>/<span id="product-count-modal">count</span>
				</p>
				<p>К оплате: <span id="product-fprice-modal"></span> руб.</p>
				<?php
						if (Yii::$app->user->isGuest) {
								?><p>Email:</p><?php
								echo $form->field($order_model, "email")->textInput(['id' => 'order-email', "class"=>"settings__form-input", "required" => true])->label(false);
						}
				?>
				<p>Купон:</p>
					<?php echo $form->field($order_model, "coupon")->textInput(['id' => 'order-coupon', "class"=>"settings__form-input", "oninput" => "checkCoupon()"])->label(false); ?>
					<p id=coupon-info></p>
				<button type="submit" class="">Купить</button>
				<?php
				$form->end();
				?>
      </div>
    </div>
  </div>
</div>
