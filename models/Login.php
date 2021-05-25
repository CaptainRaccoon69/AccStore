<?php

namespace app\models;

use yii\base\Model;

class Login extends model {

    public $username;
    public $password;

    public function rules() {
        return [
                [['username', 'password'], 'required'],
                ['password', 'string', 'min' => 5, 'max' => 35],
                ['password', 'validatePassword']
        ];
    }

    public function Login(){
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = SHA1($this->password);
        return $user->save();
    }

    public function validatePassword($attributes, $params){
        $user = $this->getUser();
        if(!$user || $user->password!= SHA1($this->password)){
            $this->addError($attributes, "Login or password is wrong");
            return false;
        }
        return true;
    }

    public function getUser(){
        return User::findOne(['username'=> $this->username]);
    }

}
