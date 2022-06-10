<?php

namespace app\models;
use Yii;

class Education extends \yii\db\ActiveRecord{
    public static function tableName(){
        return 'education';
    }

    public static function getById($id){
      if(!$id) return NULL;

      return Education::findOne(['id' => $id]);
    }
    public static function getNameById($id){
      if(!$id) return NULL;
      $d = Education::findOne(['id' => $id]);
      return $d->name;
    }

    public static function generateOptionList($default = 1){
      $education = Education::find()->all();
      $html = "";

      if($education) foreach ($education as $v) {
        $html.= "<option ".($v['id'] == $default ? "selected" : "")." value='".$v['id']."'>".$v['name']."</option>";
      }

      return $html;
    }
}
