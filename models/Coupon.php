<?php

namespace app\models;

use yii\base\Model;

class Coupon extends model {

    public $id;
    public $name;
    public $discount;

    public function rules() {
        return [
                [['name', 'discount'], 'required'],
                [['id'], 'integer']
        ];
    }

    public function addOrUpdate(){
        $coupon;
        if($this->id){
            $coupon = Coupons::getCouponById($this->id);
        }
        else{
          $coupon = new Coupons();
        }

        $coupon->name = $this->name;
        $coupon->discount = $this->discount;
        return $coupon->save();
    }



}
