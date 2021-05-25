
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>

<h1>Заявки партнёров</h1>

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Пользователь</th>
            <th scope="col">Категория</th>
            <th scope="col">Статус</th>
            <th scope="col">Дата</th>
            <th scope="col">Описание продукта</th>
            <th scope="col">Страна регистрации</th>
            <th scope="col">Формат аккаунтов</th>
            <th scope="col">Количество</th>
            <th scope="col">Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($requests as $request) {
          if ($request['status']=='rejected') {
            echo "<tr style=\"background-color:#ffbdbd;\">";
          }else if ($request['status']=='approved') {
            echo "<tr style=\"background-color:#c2ffbd;\">";
          }else{
            echo "<tr>";
          } ?>


                <td><?php echo $request['id'] ?></td>
                <td><?php echo $request["user_name"]."(".$request["user_id"].")"; ?></td>
                <td><?php echo $request['category_name']; ?></td>
                <td><?php echo $request['status']; ?></td>
                <td><?php echo $request['date']; ?></td>
                <td><?php echo $request['description']; ?></td>
                <td><?php echo $request['country']; ?></td>
                <td><?php echo $request['format']; ?></td>
                <td><?php echo $request['count']; ?></td>
                <td>
                    <a href="<?php echo Url::to(['admin/approverequest', 'id' => $request['id']]); ?>">Подтвердить</a>
                    <br>
                    <a href="<?php echo Url::to(['admin/rejectrequest', 'id' => $request['id']]); ?>">Отклонить</a>
                    <br>
                    <a href="<?php echo Url::to(['admin/deletepartnerrequest', 'id' => $request['id']]); ?>">Удалить</a>
                </td>

            </tr>
            <?php
        }
        ?>

    </tbody>
</table>
