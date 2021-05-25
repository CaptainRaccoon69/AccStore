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

if (!Yii::$app->user->identity->is_admin) {
    return 0;
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="stylesheet" href="css/admin_css.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <style>
            .container{
              width: 100%;
            }
        </style>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);


            $items = [
                    ['label' => 'Shop', 'url' => ['/site/index']],
            ];
                $username = Yii::$app->user->identity->username;
                if (Yii::$app->user->identity->is_admin) {
                    $username = $username . "(admin)";
                }
                array_push($items, ['label' => $username]);
                array_push($items, ['label' => 'Logout', 'url' => ['/site/logout']]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $items,
            ]);
            NavBar::end();
            ?>

            <div class="container">

                <div class="row">
                    <div class="col-md-2">
                        <h1>Admin panel</h1>
                        <ul id="admin_nav" class="list-group">

                            <a href="<?php echo Url::to(['admin/users']); ?>"><li class="list-group-item">Пользователи</li></a>
                            <a href="<?php echo Url::to(['admin/products']); ?>"><li class="list-group-item">Товары</li></a>
                            <a href="<?php echo Url::to(['admin/sales']); ?>"><li class="list-group-item">Продажи</li></a>
                            <a href="<?php echo Url::to(['admin/statistic']); ?>"><li class="list-group-item">Статистика</li></a>
                            <a href="<?php echo Url::to(['admin/coupons']); ?>"><li class="list-group-item">Купоны</li></a>
                            <a href="<?php echo Url::to(['admin/categories']); ?>"><li class="list-group-item">Категории</li></a>
                            <a href="<?php echo Url::to(['admin/tickets']); ?>"><li class="list-group-item">Тикеты</li></a>
                            <a href="<?php echo Url::to(['admin/partnerrequests']); ?>"><li class="list-group-item">Запросы партнёров</li></a>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <?= $content ?>
                    </div>
                </div>


            </div>
        </div>

        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
