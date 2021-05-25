<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
 ?>

<script>


function change(id) {

      var category_id = id;
      var category_name = $('#category-name-'+id).text();
      $('#delete-btn').off();

      $('#delete-btn').click(function(){
          deleteCategory(category_id);
      });
      $("#change-input-id").val(category_id);
      $('#change-input-name').val(category_name);
      $('#myModal').modal();


}

function deleteCategory(id){
  $.ajax({
      url: '<?php echo Url::to(['admin/deletecategory']); ?>',
      type: 'post',
      data: {'id': id}
  }).done(function (data) {
      //alert("deleted");
      $('#category-row-'+id).remove();
      $('#myModal').modal("hide");


  })
          .fail(function () {
              alert('Произошла ошибка при отправке данных!');
          })
}


</script>


<div id="notifications">
    <?php if( Yii::$app->session->hasFlash('category_added') ){ ?>
       <div class="alert alert-success alert-dismissible" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <?php echo Yii::$app->session->getFlash('category_added'); ?>
       </div>
        <?php
          }
        ?>
</div>

<h1>Добавить новую категорию</h1>
<?php

$form = ActiveForm::begin([
    'id' => 'add-category-form',
    'layout' => 'horizontal',
]);
?>
            <?php echo $form->field($category_model, "name")->textInput(["class"=>"category-input"])->label("Название категории"); ?>
            <?php echo $form->field($category_model, "img")->fileInput(["class" => "category-input"])->label("Файл с картинкой"); ?>

            <button class="btn btn-primary" type="submit">Добавить категорию</button>
<?php
    $form->end();
?>


<h1>Категории</h1>


<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Название категории</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($categories as $category) {
            ?>
            <tr id="category-row-<?php echo $category['id']; ?>" onclick="change(<?php echo $category['id']; ?>)">

                <td id="category-name-<?php echo $category['id']; ?>"><img width="25px;" src="img/category_img/<?php echo $category['img'] ?>"/> <?php echo $category['name'] ?></td>

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
                <h5 class="modal-title" id="exampleModalLongTitle">Изменить категорию</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'change-form',
                'layout' => 'horizontal',
            ]); ?>
            <div class="modal-body">

                  <?php echo $form->field($category_model, "id")->hiddenInput(['id'=>'change-input-id'])->label(false) ?>
                  <?php echo $form->field($category_model, "name")->textInput(['id'=>'change-input-name'])->label("Название категории") ?>
                  <?php echo $form->field($category_model, "img")->fileInput(["class" => "category-input"])->label("Картинка категории"); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" id="delete-btn" class="btn btn-secondary">Удалить</button>
                <?= Html::submitButton('Применить изменения', ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
