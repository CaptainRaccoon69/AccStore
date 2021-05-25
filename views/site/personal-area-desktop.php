<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>


<div class="container">

    <?php include_once("personal-area-head.php"); ?>

    <div class="personal__area-settings">
        <h2 class="personal__area-title">
            Пополнение баланса:
        </h2>


        <?php $form = ActiveForm::begin([
            'id' => 'change-form',
            'layout' => 'horizontal',
        ]);
        ?>
        <div class="modal-body">



        <div class="pay__services">
            <a id="pay-paykeeper" onclick="change_pay_system('#pay-paykeeper')" href="#" class="pay__services-item">
                <!-- <a href="#" class="pay__services-link"> -->
                    <img src="img/paykeeper.png" alt="" class="pay__services-img">
                    <?= $form->field($top_up_balance_model, 'payment_system')->radio(["class" => "pay-input", 'label' => '', 'value' => 'paykeeper', 'checked' => true]) ?>
                <!-- </a> -->
            </a>
            <a id="pay-mastercard" onclick="change_pay_system('#pay-mastercard')" href="#" class="pay__services-item">
                <!-- <a href="#" class="pay__services-link"> -->
                    <img src="img/mastercard-visa.png" alt="" class="pay__services-img">
                    <?= $form->field($top_up_balance_model, 'payment_system')->radio(["class" => "pay-input", 'label' => '', 'value' => 'mastercard-visa', 'uncheck' => null]) ?>
                <!-- </a> -->
            </a>
            <a id="pay-paypal" onclick="change_pay_system('#pay-paypal')" href="#" class="pay__services-item">
                <!-- <a href="#" class="pay__services-link"> -->
                    <img src="img/paypal.png" alt="" class="pay__services-img">
                    <?= $form->field($top_up_balance_model, 'payment_system')->radio(["class"=>"pay-input", 'label' => '', 'value' => 'paypal', 'uncheck' => null]) ?>
                <!-- </a> -->
            </a>
            <a id="pay-googlePay" onclick="change_pay_system('#pay-googlePay')" href="#" class="pay__services-item">
                <!-- <a href="#" class="pay__services-link"> -->
                    <img src="img/googlePay.png" alt="" class="pay__services-img">
                    <?= $form->field($top_up_balance_model, 'payment_system')->radio(["class"=>"pay-input", 'label' => '', 'value' => 'googlePay', 'uncheck' => null]) ?>
                <!-- </a> -->
            </a>
            <a id="pay-iomoney" onclick="change_pay_system('#pay-iomoney')" href="#" class="pay__services-item">
                <!-- <a href="#" class="pay__services-link"> -->
                    <img src="img/iomoney.png" alt="" class="pay__services-img">
                    <?= $form->field($top_up_balance_model, 'payment_system')->radio(["class"=>"pay-input", 'label' => '', 'value' => 'iomoney', 'uncheck' => null]) ?>
                <!-- </a> -->
            </a>
            <a id="pay-qiwi" onclick="change_pay_system('#pay-qiwi')" href="#" class="pay__services-item">
                <!-- <a href="#" class="pay__services-link"> -->
                    <img src="img/qiwi_logo_rgb_small.png" alt="" class="pay__services-img">
                    <?= $form->field($top_up_balance_model, 'payment_system')->radio(["class"=>"pay-input", 'label' => '', 'value' => 'qiwi', 'uncheck' => null]) ?>
                <!-- </a> -->
            </a>
            <a id="pay-paypass" onclick="change_pay_system('#pay-paypass')" href="#" class="pay__services-item">
                <!-- <a href="#" class="pay__services-link"> -->
                    <img src="img/paypass.png" alt="" class="pay__services-img">
                    <?= $form->field($top_up_balance_model, 'payment_system')->radio(["class"=>"pay-input", 'label' => '', 'value' => 'paypass', 'uncheck' => null]) ?>
                <!-- </a> -->
            </a>
            <a id="pay-mir" onclick="change_pay_system('#pay-mir')" href="#" class="pay__services-item">
                <!-- <a href="#" class="pay__services-link"> -->
                    <img src="img/mir.png" alt="" class="pay__services-img">
                    <?= $form->field($top_up_balance_model, 'payment_system')->radio(["class"=>"pay-input", 'label' => '', 'value' => 'mir', 'uncheck' => null]) ?>
                <!-- </a> -->
            </a>
        </div>
        <div class="payment">
            <div class="payment__row">
                <p class="payment__text">
                    Введите сумму платежа:
                    <br>
                </p>
                <?= $form->field($top_up_balance_model, 'count')->textInput(['type' => 'number', 'min'=>0])->label(false) ?>
                <br>
                <?= Html::submitButton('Оплатить', ['class' => 'payment__button', 'name' => 'pay-button']) ?>
                <br><br>

            </div>
            <br>
            <div class="payment__row">

                <p class="payment__row-license"><input required id="payment__checkbox" type="checkbox" class=""> Я согласен с
                    <a href="#" class="payment__row-link">публичной офертой</a>
                    и
                    <a href="#" class="payment__row-link">условиями использования</a>
                .</p>
                <br>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
</div>

<script>

    function change_pay_system(payment_system)
    {
        $(".pay__services-item").removeClass("payment-active");
        /*$('input:checked').prop('checked', false);*/
        let payment = $(payment_system);
        payment.addClass("payment-active");

        payment.find('.pay-input').prop('checked', true);
    }

</script>
