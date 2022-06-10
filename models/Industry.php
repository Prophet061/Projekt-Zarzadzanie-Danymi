<?php

namespace app\models;
use Yii;

class Industry extends \yii\db\ActiveRecord{
    public static function tableName(){
        return 'industry';
    }

    public static function getById($id){
      if(!$id) return NULL;

      return Industry::findOne(['id' => $id]);
    }
    public static function getNameById($id){
      if(!$id) return NULL;
      $d = Industry::findOne(['id' => $id]);
      if(!$d) return NULL;
      return $d->name;
    }

    public static function generateOptionList($default = 0){
      $industries = Industry::find()->all();
      $html = "";

      if($industries) foreach ($industries as $v) {
        $html.= "<option ".($default && $v['id'] == $default ? "selected" : "")." value='".$v['id']."'>".$v['name']."</option>";
      }

      return $html;
    }
}
