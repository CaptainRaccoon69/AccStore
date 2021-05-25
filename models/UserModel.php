<?php

namespace app\models;

use yii\base\Model;

class UserModel extends model {

    public $id;
    public $username;
    public $email;
    public $admin;
    public $partner;
    public $money;

    public function rules() {
        return [
                [['id'], 'integer'],
                [['username'], 'string'],
                [['admin', 'partner'], 'boolean'],
                [['money'], 'double'],
                ['email', 'email'],
        ];
    }

    public function Update(){
        $user = User::getUserById($this->id);
        $user->username = $this->username;
        $user->email = $this->email;
        $user->is_admin = $this->admin;
        $user->is_partner = $this->partner;
        $user->money = $this->money;
        return $user->save();
    }

}
