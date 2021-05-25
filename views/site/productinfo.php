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

<div class="content__wrap">
   <div class="wrapper">
      <ul class="breadcrumbs" itemscope="" itemtype="https://schema.org/BreadcrumbList">
         <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="/"><span itemprop="name">Главная</span></a> <meta itemprop="position" content="1">
         </li>
         <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="/"><span itemprop="name"><?php echo $category['name']; ?></span></a> <meta itemprop="position" content="2">
         </li>
         <li><span><?php echo $product['name']; ?></span></li>
      </ul>

      <article class="product__one">
         <div class="product__one-left">
            <div class="product__one-block">
               <div class="product__one-icon"><img src="img/category_img/<?php echo $category['img']; ?>" alt=""></div>
               <div class="product__one-props">
                  <div class="product__one-prop"><span class="prop-value"><?php echo $product['count']; ?></span> шт.</div>
                  <div class="product__one-prop"><span class="prop-value"><?php echo $product['price']; ?></span> <span class="sc-rubl"><span>р.</span></span></div>
               </div>
               <div class="product-item__btns product-one__btns">
                 <?php
                    if ($product['count']>0) {
                        ?>
                          <a class="product-item__btn button" href="#openModal" onclick="buy(<?php echo $product['id']; ?>)">Купить</a>
                          <a class="product-item__btn button type-cart" href="#"><span class="ics ic-btn-buy"></span></a>
                        <?php
                    }else{
                      ?>
                          <button type="button" class="product-item__btn button bgs--gray btn--preorder">Заказать товар</button>
                          <div class="product-item__btn btn--outstock">Нет в наличие</div>
                      <?php
                    }
                 ?>
               </div>
            </div>
         </div>
         <div class="product__one-right">
            <h1 class="page-title product__one-title"><?php echo $product['name']; ?></h1>
            <div class="idesc">
               <p><?php echo $product['description']; ?></p>
            </div>
         </div>
      </article>
   </div>
</div>



<?php include_once("buy-product-modal.php"); ?>
