<?php
$this->title = 'Acc Store';

use yii\helpers\Url;
use \yii\widgets\ActiveForm;
?>

<script>

    var name;
    var price;
    var count;
    function buy(id) {
        $.ajax({
            url: '<?php echo Url::to(['site/getproductinfo']); ?>',
            type: 'post',
            data: {'id': id}
        }).done(function (data) {
            var product = JSON.parse(data);
            name = product['name'];
            price = product['price'];
            count = product['count'];
            $('#order-product-id').val(id);
            $('#product-name-modal').text(name);
            $('#product-price-modal').text(price);
            $('#product-count-modal').text(count);
            $('#product-fprice-modal').text(price);
            $('#product-count-input').attr({'min': 1});
            $('#product-count-input').attr({'max': count});
            $('.popup-fade').fadeIn();
            //return;
        })
        .fail(function () {
            alert('Произошла ошибка при отправке данных!');
        })

    }

    function changeFPrice() {
        var countVal = $('#product-count-input').val();
        if (countVal < 0 || countVal > count) {
            $('#product-count-input').val(1);
            countVal = 1;
        }
        var newPrice = countVal * price;
        $('#product-fprice-modal').text(newPrice);
    };

    function checkCoupon(){
        var coupon_text = $('#order-coupon').val();
            $.ajax({
                url: '<?php echo Url::to(['site/couponinfo']); ?>',
                type: 'post',
                data: {'name': coupon_text}
            }).done(function (data) {
                var coupon = JSON.parse(data);
                if (coupon!=1) {
                    $("#coupon-info").text("Вы ввели действительный купон: -"+coupon['discount']+"%");
                }
                else{
                  $("#coupon-info").text("");
                }
            })
            .fail(function () {
                alert('Произошла ошибка при отправке данных!');
            })
    };

</script>

<div id="notifications">
    <?php if (Yii::$app->session->hasFlash('fail_buy')) { ?>
      <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php echo Yii::$app->session->getFlash('fail_buy'); ?>
      </div>
    <?php } ?>

    <?php if (Yii::$app->session->hasFlash('success_buy')) { ?>
      <div class="success">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php echo Yii::$app->session->getFlash('success_buy'); ?>
      </div>
    <?php } ?>
</div>


<div class="content__wrap">
   <div class="wrapper">



              <?php foreach ($categories as $key => $category) { ?>

                <div class="product-group fn_pageload_group">
                   <div class="product-heads"><?php echo $category['name']; ?></div>


                   <?php
                   $empty = true;
                   $more = false;
                   $products_count = 0;
                   foreach ($products as $p_key => $product) {

                       if ($product['category_id']!=$category['id']) {
                         continue;
                       }
                       $products_count++;
                       $empty = false;
                       if ($products_count>5) {
                          $more = true;
                       }

                       ?>

                       <div class="product-item <?php if($more) echo "toggle-product"; ?>">
                          <div class="product-item__icon"><img src="img/category_img/<?php echo $category['img']; ?>" alt=""></div>
                          <a class="product-item__title" href="<?php echo Url::to(['site/productinfo', 'id'=> $product['id']]); ?>"><?php echo $product['name']; ?></a>
                          <div class="product-item__infos">
                             <span class="product-item__prop prop--pcs"><?php echo $product['count']; ?> шт.</span>
                             <span class="product-item__prop prop--price"><?php echo $product['price']; ?> <span class="sc-rubl"><span>р.</span></span></span>
                          </div>
                          <div class="product-item__buy">
                             <div class="product-item__btns">
                                   <?php
                                   if ($product['count']>0) {?>
                                      <a onclick="buy(<?php echo $product['id']; ?>)" class="product-item__btn button" href="#openModal">Купить</a>

                                   <?php
                                 } else{

                                   ?><div class="shop__buy disabled">
                                       <button type="button" class="product-item__btn button bgs--gray btn--preorder">Заказать товар</button>
                                   </div><?php
                                 }?>

                                <a class="product-item__btn button type-cart" href="#"><span class="ics ic-btn-buy"></span></a>
                             </div>
                          </div>
                       </div>

                   <?php }
                   if ($empty) {
                      echo "Нет товаров для данной категории";
                   }
                   if ($more) {
                     ?>
                        <button type="button" class="button bgs--border product-pageload fn_pageload_btn"><span class="btn-icon"></span><span class="btn-show">Показать еще товары</span><span class="btn-hide">Скрыть товары</span></button>
                     <?php
                   }
                    ?>
                </div>
              <?php } ?>

        </div>
    </div>

<?php include_once("buy-product-modal.php"); ?>
