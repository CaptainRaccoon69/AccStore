<?php

namespace app\models;

class PartnerRequests extends \yii\db\ActiveRecord
{


    public static function getRequests(){
        return PartnerRequests::find()->asArray()->all();
    }

    public static function getRequestById($id){
        return PartnerRequests::findOne($id);

    }

    public static function getRequestsByPartnerId($id){
        return PartnerRequests::find()->where(["user_id"=>$id])->asArray()->all();
    }




}
