
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>

<script>


    function change(id) {
        $.ajax({
            url: '<?php echo Url::to(['admin/getuserinfo']); ?>',
            type: 'post',
            data: {'id': id}
        }).done(function (data) {
            var user = JSON.parse(data);
            var user_id = user['id'];
            var username = user['username'];
            var is_admin = user['is_admin'];
            var is_partner = user['is_partner'];
            var email = user['email'];
            var money = user['money'];
            $('#delete-btn').off();
            $('#delete-btn').click(function () {
                deleteUser(user_id);
            });
            $("#change-input-id").val(user_id);
            $('#change-input-username').val(username);
            if (is_admin) {
                $('#change-input-admin').prop('checked', true);
            } else {
                $('#change-input-admin').prop('checked', false);
            }
            if (is_partner) {
                $('#change-input-partner').prop('checked', true);
            } else {
                $('#change-input-partner').prop('checked', false);
            }
            $('#change-input-email').val(email);
            $('#change-input-money').val(money);
            $('#myModal').modal();
        })
        .fail(function () {
            alert('Произошла ошибка при отправке данных!');
        });

    }

    function deleteUser(id) {
        $.ajax({
            url: '<?php echo Url::to(['admin/deleteuser']); ?>',
            type: 'post',
            data: {'id': id}
        }).done(function (data) {
            //alert("deleted");
            $('#user-row-' + id).remove();
            $('#myModal').modal("hide");


        })
        .fail(function () {
            alert('Произошла ошибка при отправке данных!');
        });
    };

</script>


<div id="notifications">
    <?php if (Yii::$app->session->hasFlash('user_updated')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('user_updated'); ?>
        </div>
        <?php
    }
    ?>
</div>


<h2>Пользователи</h2>

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Имя пользователя</th>
            <th scope="col">Администратор</th>
            <th scope="col">Партнёт</th>
            <th scope="col">Email</th>
            <th scope="col">Баланс</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($users as $user) {
            ?>
            <tr id="user-row-<?php echo $user['id']; ?>" onclick="change(<?php echo $user['id']; ?>)">
                  <th><?php echo $user['id']; ?></th>
                  <th><?php echo $user['username']; ?></th>
                  <th>
                      <?php
                          if ($user['is_admin'])
                              echo 'Да';
                          else
                              echo 'Нет';
                      ?>
                  </th>
                  <th>
                      <?php
                          if ($user['is_partner'])
                              echo 'Да';
                          else
                              echo 'Нет';
                      ?>
                  </th>
                  <td><?php echo $user['email']; ?></td>
                  <td><?php echo $user['money']; ?></td>

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
                <h5 class="modal-title" id="exampleModalLongTitle">Изменить пользователя</h5>
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

                <?php echo $form->field($user_model, "id")->hiddenInput(['id' => 'change-input-id'])->label(false); ?>

                <?php echo $form->field($user_model, "username")->textInput(["id" => "change-input-username"])->label("Имя пользователя"); ?>

                <?php echo $form->field($user_model, "admin")->checkbox(["id" => "change-input-admin"])->label("Администратор"); ?>

                <?php echo $form->field($user_model, "partner")->checkbox(["id" => "change-input-partner"])->label("Партнёр"); ?>

                <?php echo $form->field($user_model, "email")->textInput(["id" => "change-input-email"])->label("Email"); ?>

                <?php echo $form->field($user_model, "money")->textInput(["id" => "change-input-money"])->label("Баланс"); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" id="delete-btn" class="btn btn-secondary">Удалить пользователя</button>
                <?= Html::submitButton('Применить изменения', ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
