<?php

namespace app\models;

use app\models\Products;
use yii\db\Expression;

class Orders extends \yii\db\ActiveRecord
{

    public static function getOrders(){
        return Orders::find()->orderBy(['id' => SORT_DESC])->asArray()->all();
    }

    public static function getOrderById($id){
        return Orders::findOne($id);
    }

    public static function getOrdersByUser($user_id){
        return Orders::find()->where(["user_id"=>$user_id])->orderBy(['id' => SORT_DESC])->asArray()->all();
    }

    public static function getOrdersByProduct($product_id){
        return Orders::find()->where(["product_id"=>$product_id])->all();
    }

    public static function getUnpaidOrders(){
        return Orders::find()->where(["status"=>'reserved'])->all();
    }

    public static function getTotalSum(){
      return Orders::find()->where(['status'=>'done'])->asArray()->sum('price');
    }

    /*public static function getMonthSum(){
      Orders::find()->where(['>', 'date', '2018-11-24 00:00:00' ])
                       ->all();
    }*/



}
