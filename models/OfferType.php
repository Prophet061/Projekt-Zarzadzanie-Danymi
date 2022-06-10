<?php

namespace app\models;
use Yii;

class OfferType extends \yii\db\ActiveRecord{
    public static function tableName(){
        return 'offer_type';
    }

    public static function getById($id){
      if(!$id) return NULL;

      return OfferType::findOne(['id' => $id]);
    }
    public static function getNameById($id){
      if(!$id) return NULL;
      $d = OfferType::findOne(['id' => $id]);
      return $d->name;
    }

    public static function generateOptionList($default = 1){
      $offertypes = OfferType::find()->all();
      $html = "";

      if($offertypes) foreach ($offertypes as $v) {
        $html.= "<option ".($v['id'] == $default ? "selected" : "")." value='".$v['id']."'>".$v['name']."</option>";
      }

      return $html;
    }
}
