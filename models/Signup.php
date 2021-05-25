<?php

namespace app\models;

use yii\base\Model;

class Signup extends model {

    public $username;
    public $email;
    public $password;
    public $ref_id;

    public function rules() {
        return [
                [['username', 'password'], 'required'],
                ['username', 'unique', 'targetClass'=>'app\models\User'],
                [['ref_id'], 'integer'],
                ['email', 'unique', 'targetClass'=>'app\models\User'],
                ['password', 'string', 'min' => 5, 'max' => 35]
        ];
    }

    public function signup(){
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = SHA1($this->password);
        if ($this->ref_id) {
            $user->ref_id = $this->ref_id;
        }
        return $user->save();
    }

}
