<?php

namespace app\models;

use yii\base\Model;
use Yii;

class ChangeUserData extends model {

    public $id;
    public $old_password;
    public $new_password;
    public $new_email;
    public $new_username;

    public function rules() {
        return [
                [['old_password', 'new_password', 'new_username'], 'string'],
                [['new_email'], 'email']
        ];
    }

    public function updateUser(){
        $user = User::getUserById($this->id);
        if ($this->new_password) {
            if ($user->password == SHA1($this->old_password)) {
                $user->password = SHA1($this->new_password);
                Yii::$app->session->setFlash("success_password_update", "Вы успешно сменили пароль");
            }
            else{
                Yii::$app->session->setFlash("fail_password_update", "Неправильный старый пароль");
            }
        }
        if ($this->new_email) {
            if (User::getUserByEmail($this->new_email)==null) {
              $user->email = $this->new_email;
              Yii::$app->session->setFlash("success_email_update", "Вы успешно сменили email");
            }
            else{
                Yii::$app->session->setFlash("fail_email_update", "Этот email уже занят, выберите другой");
            }

        }
        if ($this->new_username) {
            if (User::getUserByUsername($this->new_username) == null) {
                $user->username = $this->new_username;
                Yii::$app->session->setFlash("success_username_update", "Вы успешно сменили имя пользователя");
            }
            else{
                Yii::$app->session->setFlash("fail_username_update", "Имя пользователя занято, выберите другое");
            }

        }
        return $user->save();
    }



}
