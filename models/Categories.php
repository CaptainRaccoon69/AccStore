<?php

namespace app\models;

use app\models\Products;

class Categories extends \yii\db\ActiveRecord
{

    public static function getCategories(){
        return Categories::find()->asArray()->all();
    }

    public static function getCategoriesObj(){
        return Categories::find()->all();
    }

    public static function getCategoryById($id){
        return Categories::findOne($id);
    }

    public static function getCategoryByIdArray($id){
        return Categories::find()->where(["id"=>$id])->asArray()->all();
    }

}
