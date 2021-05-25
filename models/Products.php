<?php

namespace app\models;

class Products extends \yii\db\ActiveRecord
{


    public static function getProducts(){
        return Products::find()->orderBy(['id' => SORT_DESC])->asArray()->all();
    }

    public static function getShownProducts(){
        return Products::find()->where(['is_hide'=>0])->orderBy(['id' => SORT_DESC])->all();
    }

    public static function getShownProductsByCategory($category_id){
        return Products::find()->where(['category_id'=>$category_id])->orderBy(['id' => SORT_DESC])->all();
    }

    public static function getShownProductsBySearch($search){
        return Products::find()->where(['like', 'name', $search])->orderBy(['id' => SORT_DESC])->all();
    }

    public static function getProductById($id){
        return Products::findOne($id);

    }

    public static function getProductsByOwner($id){
        return Products::find()->where(['owner'=>$id])->orderBy(['id' => SORT_DESC])->asArray()->all();

    }

    public static function getProductsByRequest($id){
        return Products::find()->where(['request_id'=>$id])->orderBy(['id' => SORT_DESC])->asArray()->all();
    }

    public static function getProductsByRequestObj($id){
        return Products::find()->where(['request_id'=>$id])->all();
    }




}
