<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div id="notifications">
    <?php if (Yii::$app->session->hasFlash('ticket_sent')) { ?>
      <div class="success">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php echo Yii::$app->session->getFlash('ticket_sent'); ?>
      </div>
    <?php } ?>
</div>

    <?php include_once("personal-area-head.php");?>



<div class="container">
  <h1 class="tickets__title">Новый тикет</h2>
  <?php $form = ActiveForm::begin([
      'layout' => 'horizontal',
      'fieldConfig' => [
          'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
          'labelOptions' => ['class' => 'col-lg-1 control-label'],
      ],
  ]); ?>

      <div class="settings__form-row">
          <p class="settings__form-par">
              Тема: <span>*</span>:
      </p>
      <?= $form->field($ticket_model, 'subject')->textarea(["class"=>"form-textarea"])->label(false) ?>
    </div>
    <div class="settings__form-row">
        <p class="settings__form-par">
            Сообщение: <span>*</span>:
    </p>
    <?= $form->field($ticket_model, 'message')->textarea(["class"=>"form-textarea"])->label(false) ?>
  </div>


      <div class="form-group">
          <div class="col-lg-offset-1 col-lg-11">
              <?= Html::submitButton('Отправить', ['class' => 'settings__form-submit', 'name' => 'update-button']) ?>
          </div>
      </div>

  <?php $form->end(); ?>


    <div class="personal__area-orders tickets">
        <h2 class="personal__area-title ticket">
            Ваши тикеты
        </h2>
        <?php
        if ($tickets) {
         ?>
        <div class="personal__area-row">
            <div class="personal__area-item">
                <p class="personal__area-status">
                    Статус:
                </p>
                <select name="" id="" class="personal__area-select">
                    <option value="" class="personal__area-option">Status</option>
                    <option value="" class="personal__area-option">Status</option>
                    <option value="" class="personal__area-option">Status</option>
                </select>
            </div>
            <div class="personal__area-search">
                <span class="search__span">
                    Поиск:
                </span>
                <div class="search personal__area">
                    <!-- <img src="img/lense.png" alt="" class="search__lense"> -->
                    <input type="text" class="search__input">
                    <button class="search__button personal__area">Искать</button>
                </div>
            </div>
        </div>


        <div class="tickets__table-wrapper">
            <table class="tickets__table">
                <tr class="tickets__header">
                    <th class="tickets__header-number">
                        №
                    </th>
                    <th class="tickets__header-topic">
                        Тема
                    </th>
                    <th class="tickets__header-status">
                        Статус
                    </th>
                    <th class="tickets__header-date">
                        Дата
                    </th>
                    <th class="tickets__header-message">
                        Сообщение
                    </th>
                    <th class="tickets__header-response">
                        Ответ
                    </th>
                </tr>

                <?php foreach ($tickets as $key => $ticket) {
                  ?>

                <tr class="tickets__row">
                    <td class="tickets__row-number">
                        <?php echo $ticket['id'];?>
                    </td>
                    <td class="tickets__row-topic">
                        <?php echo $ticket['subject']; ?>
                    </td>
                    <td class="tickets__row-status">

                        <?php
                        if ($ticket['status']=="new") {
                          echo "Новый";
                        }

                        ?>
                    </td>
                    <td class="tickets__row-date">
                        <?php echo $ticket['date']; ?>
                    </td>
                    <td class="tickets__row-message">
                        <?php echo $ticket['message']; ?>
                    </td>
                    <td class="tickets__row-message">
                        <?php echo $ticket['response']; ?>
                    </td>
                </tr>
                <?php
                }
                ?>

            </table>
        </div>
      <?php }
      else{
          ?> <h2 class="no__tickets">У вас нет тикетов</h2> <?php
      } ?>



    </div>
</div>
