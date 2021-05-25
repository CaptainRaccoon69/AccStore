<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
 ?>

<script>

function change(id) {

      var ticket_id = id;
      var response = $('#ticket-response-'+ticket_id).text();
      $('#delete-btn').off();

      $('#delete-btn').click(function(){
          deleteTicket(ticket_id);
      });
      $("#change-input-id").val(ticket_id);
      $('#change-input-response').val(response);
      $('#myModal').modal();


}

function deleteTicket(id){
  $.ajax({
      url: '<?php echo Url::to(['admin/deleteticket']); ?>',
      type: 'post',
      data: {'id': id}
  }).done(function (data) {
      //alert("deleted");
      $('#ticket-row-'+id).remove();
      $('#myModal').modal("hide");


  })
          .fail(function () {
              alert('Произошла ошибка при отправке данных!');
          })
}


</script>

<div id="notifications">
    <?php if( Yii::$app->session->hasFlash('ticket_responsed') ){ ?>
       <div class="alert alert-success alert-dismissible" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <?php echo Yii::$app->session->getFlash('ticket_responsed'); ?>
       </div>
        <?php
          }
        ?>
</div>

<h1>Тикеты</h1>


<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Тема</th>
            <th scope="col">Статус</th>
            <th scope="col">Дата</th>
            <th scope="col">Сообщение</th>
            <th scope="col">Ответ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($tickets as $ticket) {
            ?>
            <tr id="ticket-row-<?php echo $ticket['id']; ?>" onclick="change(<?php echo $ticket['id']; ?>)">
                <td id="ticket-<?php echo $ticket['id']; ?>"><?php echo $ticket['id'] ?></td>
                <td id="ticket-subject-<?php echo $ticket['id']; ?>"><?php echo $ticket['subject'] ?></td>
                <td id="ticket-status-<?php echo $ticket['id']; ?>"><?php echo $ticket['status'] ?></td>
                <td id="ticket-date-<?php echo $ticket['id']; ?>"><?php echo $ticket['date'] ?></td>
                <td id="ticket-message-<?php echo $ticket['id']; ?>"><?php echo $ticket['message'] ?></td>
                <td id="ticket-response-<?php echo $ticket['id']; ?>"><?php echo $ticket['response'] ?></td>

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
                <h5 class="modal-title" id="exampleModalLongTitle">Ответить на тикет</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'response-form',
                'layout' => 'horizontal',
            ]); ?>
            <div class="modal-body">

                  <?php echo $form->field($ticket_model, "id")->hiddenInput(['id'=>'change-input-id'])->label(false) ?>
                  <?php echo $form->field($ticket_model, "response")->textarea(['id'=>'change-input-response'])->label("Ответ") ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" id="delete-btn" class="btn btn-secondary">Удалить тикет</button>
                <?= Html::submitButton('Ответить на тикет', ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
