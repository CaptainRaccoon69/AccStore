<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="utf-8">
   <meta content="True" name="HandheldFriendly">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>B-P.sale</title>
   <link href="css/style.css" rel="stylesheet" type="text/css">
   <link href="css/css.css" rel="stylesheet" type="text/css">
</head>

<body id="body" class="load--preload focus-disabled">
<?php $this->beginBody() ?>

<div class="wraps">

   <header class="header-wrap">
      <div class="header-panel">
         <div class="wrapper">
            <ul class="header-panel__links links-main">
               <li><a href="#"><span class="link-icon"><img alt="" src="img/icons/contact-tg.png"></span><span class="link-label">Канал в Telegram</span></a></li>
               <li><a href="#"><span class="link-icon"><img alt="" src="img/icons/contact-tg.png"></span><span class="link-label">Связаться с нами</span></a></li>
            </ul>
            <div class="header-panel__right">
               <div class="shop-profile header-profile">
                 <?php if (Yii::$app->user->isGuest) {
                   ?>
                       <button type="button" class="shop-profile__btn">
                          <span class="btn-icon"><img alt="" src="img/icons/profile-btn.png"></span>
                          <span class="btn-label">Гость</span>
                       </button>
                       <div class="shop-profile__drop">
                          <ul>
                             <li><a href="<?php echo Url::to(['site/signup']); ?>">Регистрация</a></li>
                             <li><a href="<?php echo Url::to(['site/login']); ?>">Войти</a></li>
                          </ul>
                       </div>
                    <?php
                 } else {
                     ?>
                         <button type="button" class="shop-profile__btn">
                            <span class="btn-icon"><img alt="" src="img/icons/profile-btn.png"></span>
                            <span class="btn-label"><?php echo Yii::$app->user->identity->username; ?></span>
                         </button>
                         <div class="shop-profile__drop">
                            <ul>
                               <li><a href="<?php echo Url::to(['site/personalareamain']); ?>">Личный кабинет</a></li>
                               <li><a href="<?php echo Url::to(['site/partnerregister']); ?>">Для поставщиков</a></li>
                               <li><a href="<?php echo Url::to(['site/logout']); ?>">Выйти</a></li>
                            </ul>
                         </div>
                      <?php
                 } ?>
               </div>
               <div class="link-languages header-languages">
                  <a class="link-language" href="#"><img alt="" src="img/icons/flag-english.png"></a>
                  <a class="link-language current" href="#"><img alt="" src="img/icons/flag-russia.png"></a>
               </div>
            </div>
         </div>
      </div>
      <div class="header-middle">
         <div class="wrapper">
            <div class="header-logo"><a href="/"><img alt="" src="img/logo.png"></a></div>
            <nav class="header-nav">
               <ul class="header-nav__list">
                  <li><a href="#">Правила</a></li>
                  <li><a href="#">FAQ</a></li>
                  <li><a href="#">Для партнёров</a></li>
                  <li><a href="#">Термины</a></li>
                  <li><a href="#">Блог</a></li>
                  <li><a href="#" class="link-drop">Полезная информация<span class="link-arrw"></span></a>
                     <div class="header-nav__drop">
                        <ul class="header-nav__drop-list">
                           <li><a href="#">Окно под длинную полезную ссылку</a></li>
                           <li><a href="#">Окно под длинную полезную ссылку</a></li>
                           <li><a href="#">Окно под длинную полезную ссылку</a></li>
                           <li><a href="#">Окно под длинную полезную ссылку</a></li>
                           <li><a href="#">Окно под длинную полезную ссылку</a></li>
                        </ul>
                     </div>
                  </li>
               </ul>
            </nav>
         </div>
      </div>
   </header>

   <nav class="header-shop">
      <div class="wrapper">
         <div class="header-menu">
            <button type="button" class="button header-menu__btn" id="fn_menu">
               <svg class="btn-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 512 383.5" style="enable-background:new 0 0 512 383.5;" xml:space="preserve">
               <path d="M464.9,0H47.1C21.1,0,0,21.1,0,47.1c0,26,21.1,47.1,47.1,47.1h417.8c26,0,47.1-21.1,47.1-47.1C512,21.1,490.9,0,464.9,0z"/>
                                 <path d="M464.9,144.6H47.1c-26,0-47.1,21.1-47.1,47.1c0,26,21.1,47.1,47.1,47.1h417.8c26,0,47.1-21.1,47.1-47.1
                   C512,165.7,490.9,144.6,464.9,144.6L464.9,144.6z"/>
                                 <path d="M464.9,289.2H47.1c-26,0-47.1,21.1-47.1,47.1c0,26,21.1,47.1,47.1,47.1h417.8c26,0,47.1-21.1,47.1-47.1
                   C512,310.3,490.9,289.2,464.9,289.2z"/>
               </svg>
               <span class="btn-label">Выберите категорию</span>
               <span class="btn-arrw"></span>
            </button>
            <div class="header-menu__drop">
               <ul class="header-menu__list">
                  <!--<li>
                     <a href="#"><span class="link-icon"><img alt="" src="img/icons/cat-tg.png"></span> Telegram Telegram Telegram Telegramv Telegram</a>
                     <button type="button" class="link-arrw"></button>
                     <div class="menu-list__drop">
                        <ul class="menu-list__drop-list">
                           <li><a href="#">Ссылка</a></li>
                           <li><a href="#">Ссылка</a></li>
                           <li><a href="#">Ссылка</a></li>
                           <li><a href="#">Ссылка</a></li>
                           <li><a href="#">Ссылка</a></li>
                        </ul>
                     </div>
                  </li>-->

               </ul>
            </div>
         </div>
         <div class="header-search" data-fastsearch-form>
            <input type="text" class="input__place header-search__input" id="fn_search_text" placeholder="Введите название товара..."
                   aria-describedby="fn_search_results" data-fastsearch-input autocomplete="off">
            <button class="button bgs--blue header-search__button">Найти</button>

            <!--<div class="header__search-drop" data-fastsearch-drop>
               <div class="header__search-drop-box">
                  <div class="header__search-content" id="fn_search_results"></div>
               </div>
            </div>-->
         </div>
      </div>
      <div class="header-shop__layer"></div>
   </nav>


    <div class="container">
        <?php echo $content; ?>
    </div>


    <footer class="footer-wrap">
       <div class="footer-heads">
          <div class="wrapper">
             <div class="footer-left">
                <div class="footer-col__nav">
                   <ul class="footer-nav">
                      <li><a href="#">Главная</a></li>
                      <li><a href="#">Партнерам</a></li>
                      <li><a href="#">Правил</a></li>
                      <li><a href="#">Термины</a></li>
                      <li><a href="#">FAQ</a></li>
                   </ul>
                </div>
                <div class="footer-col__support">
                   <div class="support-title">Нужна помощь?</div>
                   <a class="button bgs--blue support-button" href="#">Написать нам</a>
                </div>
             </div>
             <div class="footer-right">
                <a class="footer-logo" href="#"><img alt="" src="_img/logo-footer.png"></a>
                <div class="footer-stats">
                   <div class="footer-stat"><a href="#"><img alt="" src="_img/blank/stat.png"></a></div>
                   <div class="footer-stat"><a href="#"><img alt="" src="_img/blank/stat.png"></a></div>
                </div>
             </div>
          </div>
       </div>
       <div class="footer-foots">
          <div class="wrapper">
             <ul class="footer-foots__nav">
                <li>Все права защищены</li>
                <li><a href="#">Карта сайта</a></li>
             </ul>
          </div>
       </div>
    </footer>
    <div class="layer__panel__nav fn_close_switch"></div>

    <a class="button-cart" href="#">
       <span class="button-cart__counter">3</span>
    </a>
 </div>

 <!-- JS Template -->
 <script type="text/template" id="search_items_tmpl">
    <% if (typeof items !== 'undefined' && items) { %>
    <div class="search-drop__header">Результаты поиска</div>
    <div class="search__items scrollbar-inner">
       <div class="nano-content">
          <div class="search__container"><%=items%></div>
       </div>
    </div>
    <% } else { %>
    <div class="header__search-drop-nosearch">К сожалению, нечего не найдено :(</div>
    <% } %>
 </script>
 <script type="text/template" id="search_group_tmpl">
    <div class="product-group">
       <div class="product-heads"><%=header%></div>
       <% for ( var i = 0; i < data.length; i++ ) { %>
       <%= tmpl("search_item_tmpl", data[i]) %>
       <% } %>
    </div>
 </script>
 <script type="text/template" id="search_item_tmpl">
    <div class="product-item">
       <div class="product-item__icon"><img src="<%=image%>" alt=""></div>
       <a class="product-item__title" href="<%=url%>"><%=title%></a>
       <div class="product-item__infos">
          <span class="product-item__prop prop--pcs">21 шт.</span>
          <span class="product-item__prop prop--price">3234 <span class="sc-rubl"><span>р.</span></span></span>
       </div>
       <div class="product-item__buy">
          <% if (typeof stock !== 'undefined' && stock) { %>
          <div class="product-item__btns">
             <a class="product-item__btn button" href="<%=url%>">Купить</a>
             <a class="product-item__btn button type-cart" href="<%=url%>"><span class="ics ic-btn-buy"></span></a>
          </div>
          <% } else { %>
          <div class="product-item__btns">
             <button type="button" class="product-item__btn button bgs--gray btn--preorder">Заказать товар</button>
          </div>
          <% } %>
       </div>
    </div>
 </script>



    <?php $this->endBody() ?>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/script_site.js"></script>

    <script>
        $('.header-search__button').click(function(){
          var request = $(".header-search__input").val();
          var link = "<?php echo Url::to(['site/index']); ?>&search_request="+request;
          $(location).attr('href',link);
        });


        $.ajax({
            url: '<?php echo Url::to(['site/getcategories']); ?>',
            type: 'get',
        }).done(function (data) {
            var categories = JSON.parse(data);
            categories.forEach((item, i) => {
                $(".header-menu__list").append("<li><a href=\"<?php echo Url::to(['site/index']); ?>&category_id="+item['id']+"\"><span class=\"link-icon\"><img alt=\"\" src=\"img/category_img/"+item['img']+"\"></span> "+item['name']+"</a></li>");
            });

            //return;
        })
        .fail(function () {
            alert('Произошла ошибка при отправке данных!');
        });
        </script>
    </div>
  </body>
</html>
<?php $this->endPage() ?>
