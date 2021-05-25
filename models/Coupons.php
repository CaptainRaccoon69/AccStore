<?php

namespace app\models;

use app\models\Products;

class Coupons extends \yii\db\ActiveRecord
{

    public static function getCoupons(){
        return Coupons::find()->asArray()->all();
    }

    public static function getCouponById($id){
        return Coupons::findOne($id);
    }

    public static function getCouponByName($name){
        return Coupons::find()->where(['name'=>$name])->one();
    }



}
