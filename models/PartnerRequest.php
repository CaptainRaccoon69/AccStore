<?php

namespace app\models;

use yii\base\Model;

class PartnerRequest extends model {

    public $user_id;
    public $category_id;
    public $description;
    public $country;
    public $format;
    public $count;

    public function rules() {
        return [
                [['user_id', 'category_id', 'description','country','format','count'], 'required']
        ];
    }

    public function addRequest(){
        $partner_request = new PartnerRequests();
        $partner_request->user_id = $this->user_id;
        $partner_request->category_id = $this->category_id;
        $partner_request->description = $this->description;
        $partner_request->country = $this->country;
        $partner_request->format = $this->format;
        $partner_request->count = $this->count;
        return $partner_request->save();
    }





}
