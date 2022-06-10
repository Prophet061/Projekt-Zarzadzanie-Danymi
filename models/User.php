<?php

namespace app\models;

use Yii;
use yii\db\Query;
use app\models\Tools;
use app\models\Validate;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface{
    public static function tableName(){
        return 'user';
    }
    public static function findIdentity($id){
        return static::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type = null){
        return static::findOne(['access_token' => $token]);
    }
    public function getId(){
        return $this->id;
    }
    public function getAuthKey(){
        return $this->auth_key;
    }
    public function validateAuthKey($authKey){
        return $this->getAuthKey() === $authKey;
    }
    public static function getById($id){
      if(!$id) return NULL;

      return User::findOne(['id' => $id]);
    }
    public static function getByLogin($login){
      if(!$login) return NULL;

      return User::findOne(['login' => $login]);
    }
    public function validatePassword($password){
        return $this->password === md5($password);
    }
    public static function getCurrentIdentity(){
      return Yii::$app->user->identity;
    }
    public static function isAdmin(){
      if(!Yii::$app) return false;
      if(!Yii::$app->user) return false;
      if(!Yii::$app->user->identity) return false;
      if(!Yii::$app->user->identity->type) return false;
      if(Yii::$app->user->identity->type === 3) return true;

      return false;
    }
    public static function isSeeker(){
      if(!Yii::$app) return false;
      if(!Yii::$app->user) return false;
      if(!Yii::$app->user->identity) return false;
      if(!Yii::$app->user->identity->type) return false;
      if(Yii::$app->user->identity->type === 1) return true;

      return false;
    }
    public static function isAdvertiser(){
      if(!Yii::$app) return false;
      if(!Yii::$app->user) return false;
      if(!Yii::$app->user->identity) return false;
      if(!Yii::$app->user->identity->type) return false;
      if(Yii::$app->user->identity->type === 2) return true;

      return false;
    }
    public static function isLogged(){
      if(!Yii::$app) return false;
      if(!Yii::$app->user) return false;
      if(!Yii::$app->user->identity) return false;

      return true;
    }


    public static function create($p){
      $u = new User;

      $valid_ok = true;
      $user = User::getByLogin($p['login']);
      if($user){
        Yii::$app->session->addFlash('danger', 'Użytkownik o podanej nazwie użytkownika jest już zarejestrowany');
        $valid_ok = false;
      }

      if(!Tools::validate($p['name'], 'first_name', 3)){
        Yii::$app->session->addFlash('danger', 'Podane imie stanowiska jest niepoprawne');
        $valid_ok = false;
      }
      if(!Tools::validate($p['surname'], 'last_name', 3)){
        Yii::$app->session->addFlash('danger', 'Podane nazwisko stanowiska jest niepoprawne');
        $valid_ok = false;
      }
      if(!Tools::validate($p['password'], 'password')){
        Yii::$app->session->addFlash('danger', 'Podane hasło jest niepoprawne - hasło musi składać się z minimum 8 znaków, jednej dużej litery, jednej cyfry i znaku specjalnego');
        $valid_ok = false;
      }
      if($p && $p['password'] && ($p['password'] != $p['password_again'])){
        Yii::$app->session->addFlash('danger', 'Podane hasła nie są identyczne');
        $valid_ok = false;
      }



      $u->login = $p['login'];
      $u->password = md5($p['password']);

      $u->name = $p['name'];
      $u->surname = $p['surname'];


      $u->access_token = Tools::generateRandomString(32);
      $u->auth_key = Tools::generateRandomString(32);
      $u->type = $p['type'];

      return $valid_ok && $u->save() ? array('success' => true, 'user' => $u) : array('success' => false);
    }
    public static function updateMe($p){
      $u = User::getCurrentIdentity();

      $valid_ok = true;
      if(!Tools::validate($p['name'], 'first_name', 3)){
        Yii::$app->session->addFlash('danger', 'Podane imie stanowiska jest niepoprawne');
        $valid_ok = false;
      }
      if(!Tools::validate($p['surname'], 'last_name', 3)){
        Yii::$app->session->addFlash('danger', 'Podane nazwisko stanowiska jest niepoprawne');
        $valid_ok = false;
      }

      if(isset($d['new_password']) && isset($d['new_password_again'])){

        if($d['new_password'] != $d['new_password_again']){
          Yii::$app->session->addFlash('danger', 'Podane hasła nie są identyczne');
          $valid_ok = false;
        }

        if($u->password != md5($p['old_password'])){
          Yii::$app->session->addFlash('danger', 'Stare hasło jest niepoprawne');
          $valid_ok = false;
        }

        if(!Tools::validate($p['new_password'], 'password')){
          Yii::$app->session->addFlash('danger', 'Podane hasło jest niepoprawne - hasło musi składać się z minimum 8 znaków, jednej dużej litery, jednej cyfry i znaku specjalnego');
          $valid_ok = false;
        }

          if($valid_ok) $u->password = md5($p['new_password']);
      }






      $u->name = $p['name'];
      $u->surname = $p['surname'];

      return $valid_ok && $u->save() ? array('success' => true, 'user' => $u) : array('success' => false);
    }
    public static function login($login, $password){
      $user = User::getByLogin($login);
      if(!$user){
        Yii::$app->session->addFlash('danger', 'Nie znaleziono użytkownika o wskazanej nazwie użytkownika');
        return false;
      }

      $password_ok = $user->validatePassword($password);
      if($password_ok){
        return Yii::$app->user->login($user);
      } else {
        Yii::$app->session->addFlash('danger', 'Podane hasło jest nieprawidłowe');
        return false;
      };
    }
}
