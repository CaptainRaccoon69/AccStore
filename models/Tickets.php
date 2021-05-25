<?php

namespace app\models;

class Tickets extends \yii\db\ActiveRecord
{

    public static function getTickets(){
        return Tickets::find()->asArray()->all();
    }

    public static function getTicketById($id){
        return Tickets::findOne($id);

    }

    public static function getTicketsByUser($id){
        return Tickets::find()->where(['user_id'=>$id])->asArray()->all();

    }




}
