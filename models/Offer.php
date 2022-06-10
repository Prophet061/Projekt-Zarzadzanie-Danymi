<?php

namespace app\models;

use Yii;
use app\models\User;
use app\models\Tools;
use app\models\Favorite;
use yii\db\Query;


class Offer extends \yii\db\ActiveRecord{
    public static function tableName(){
        return 'offer';
    }
    public static function getById($id){
      if(!$id) return NULL;
      return Offer::findOne(['id' => $id]);
    }

    public function isOwner(){
      $me = User::getCurrentIdentity();

      if(!$me) return false;
      return $this->id_user == $me->id ? true : false;
    }

    public static function createOffer($p){
      return Offer::updateOffer(false, $p);
    }
    public static function updateOffer($id, $p){
      $o = $id ? Offer::getById($id) : new Offer();
      $me = User::getCurrentIdentity();

      $owner = $o->isOwner();
      if($id && !$owner){
        Yii::$app->session->addFlash('danger', 'Nie jesteś właścicielem, oferty którą próbujesz edytować');
        return array('success' => false);
      }

      $valid_ok = true;
      if(!Tools::validate($p['name'], 'name', 3)){
        Yii::$app->session->addFlash('danger', 'Podana nazwa stanowiska jest niepoprawna');
        $valid_ok = false;
      }
      if(!Tools::validate($p['company'], 'name', 3)){
        Yii::$app->session->addFlash('danger', 'Podana nazwa firmy jest niepoprawna');
        $valid_ok = false;
      }

      if(!Tools::validate($p['salary_from'], 'number')){
        Yii::$app->session->addFlash('danger', 'Podane wynagrodzenie minimalne jest niepoprawne');
        $valid_ok = false;
      }
      if(!Tools::validate($p['salary_to'], 'number')){
        Yii::$app->session->addFlash('danger', 'Podane wynagrodzenie maksymalne jest niepoprawne');
        $valid_ok = false;
      }

      if(!Tools::validate($p['address_city'], 'city', 3)){
        Yii::$app->session->addFlash('danger', 'Podana miejscowość jest niepoprawna');
        $valid_ok = false;
      }
      if(!Tools::validate($p['address_zipcode'], 'zipcode', 6)){
        Yii::$app->session->addFlash('danger', 'Podany kod pocztowy jest niepoprawny');
        $valid_ok = false;
      }
      if(!Tools::validate($p['address_street'], 'street', 3)){
        Yii::$app->session->addFlash('danger', 'Podana ulica jest niepoprawna');
        $valid_ok = false;
      }

      if(!Tools::validate($p['email'], 'email')){
        Yii::$app->session->addFlash('danger', 'Podany email jest niepoprawny');
        $valid_ok = false;
      }
      if(!Tools::validate($p['mobile'], 'mobile')){
        Yii::$app->session->addFlash('danger', 'Podany telefon jest niepoprawny');
        $valid_ok = false;
      }

      if(!$id) $o->id_user = $me->id;

      $o->name = $p['name'];
      $o->company = $p['company'];
      $o->salary_from = $p['salary_from'];
      $o->salary_to = $p['salary_to'];
      $o->address_city = $p['address_city'];
      $o->address_zipcode = $p['address_zipcode'];
      $o->address_street = $p['address_street'];

      $o->description = $p['description'];
      $o->responsibilities = $p['responsibilities'];
      $o->requirments = $p['requirments'];

      $o->offer_type = $p['offer_type'];
      $o->education = $p['education'];
      $o->speciality = $p['speciality'];
      $o->industry = $p['industry'];

      $o->email = $p['email'];
      $o->mobile = $p['mobile'];

      return $valid_ok && $o->save() ? array('success' => true, 'id' => $o->id) : array('success' => false);
    }
    public static function deleteOffer($id){
      if(!$id) return NULL;
      $offer = Offer::getById($id);

      $owner = $offer->isOwner() || User::isAdmin();
      if(!$owner) return false;

      $offer->status = 0;
      return $offer->save();
    }

    public static function getOffers($params){
      $q = Offer::find()
                  ->where(['=', 'status', 1])
                  ->orderBy(['highlighted' => SORT_DESC, 'date_created' => SORT_DESC]);

      if($params) foreach ($params as $v) $q->andWhere($v);

      return $q->all();
    }
    public static function getFavoriteOffers(){

      $favorites = Favorite::getFavoriteList();

      return Offer::find()
      ->where(['=', 'status', 1])
      ->andWhere(['in', 'id', $favorites])
      ->orderBy(['highlighted' => SORT_DESC, 'date_created' => SORT_DESC])
      ->all();
    }

    public static function getAddressCityDynamic(){
      $query = (new Query)->select('address_city')
      ->from('offer')
      ->distinct()
      ->where(['status' => 1]);

      $query = $query->all();

      $cities = [];

      foreach ($query as $v) {
        $cities[] = $v['address_city'];
      }

      return $cities;
    }

    public function isHighlighted(){
      return $this->highlighted == 1 ? true : false;
    }
    public static function highlightOffer($id){
      if(!User::isAdmin()) return false;
      $o = Offer::getById($id);
      $o->highlighted = 1;

      return $o->save();
    }
    public static function unhighlightOffer($id){
      if(!User::isAdmin()) return false;
      $o = Offer::getById($id);
      $o->highlighted = 0;

      return $o->save();
    }

}
