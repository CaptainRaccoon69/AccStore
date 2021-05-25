<?php

namespace app\models;

use yii\base\Model;
use Yii;

class TopUpBalance extends model {

    public $user_id;
    public $count;
    public $payment_system;

    public function rules() {
        return [
                [['count', 'payment_system'], 'required'],
        ];
    }

    public function RedirectToPay(){
        /*switch ($this->payment_system) {
          case 'mastercard-visa':
                echo "mastercard-visa";
            break;
          case 'paykeeper':
                echo "paykeeper";
            break;
          case 'paypal':
                echo "paypal";
            break;
        }*/
        $this->topUp();
    }

    public function topUp(){
        $user = User::getUserById($this->user_id);
        $user->money+=$this->count;
        return $user->save();
    }




}
