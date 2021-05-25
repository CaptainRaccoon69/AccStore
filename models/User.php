<?php

namespace app\models;
use yii\web\IdentityInterface;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{


    public static function findIdentity($id){
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){

    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){

    }

    public function validateAuthKey($authKey){

    }

    public static function getAllUsers(){
        return User::find()->asArray()->all();
    }

    public static function getUserById($id){
        return User::findOne($id);
    }

    public static function getUserByUsername($username){
        return User::find()->where(["username" => $username])->one();
    }

    public static function getUserByEmail($email){
        return User::find()->where(["email" => $email])->one();
    }

}
