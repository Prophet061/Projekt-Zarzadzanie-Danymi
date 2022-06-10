<?php
namespace app\models;
use Yii;
use app\models\User;

class Favorite extends \yii\db\ActiveRecord{
    public static function tableName(){
        return 'favorite';
    }
    public static function getById($id){
      if(!$id) return NULL;
      return Favorite::findOne(['id' => $id]);
    }

    public static function isFavorited($id){
      if(!$id) return false;

      $me = User::getCurrentIdentity();
      $f = Favorite::find()->where(['id_offer' => $id])->andWhere(['id_user' => $me->id])->all();

      return $f ? true : false;
    }

    public static function markFavorite($id){
      $f = new Favorite;
      $me = User::getCurrentIdentity();

      $f->id_user = $me->id;
      $f->id_offer = $id;

      return $f->save();
    }
    public static function unmarkFavorite($id){
      $me = User::getCurrentIdentity();

      return Favorite::deleteAll(['id_offer' => $id, 'id_user' => $me->id]);
    }

    public static function getFavoriteList(){
      $me = User::getCurrentIdentity();

      $favorites_ids = [];
      $favorites = Favorite::find()->where(['id_user' => $me->id])->all();
      if($favorites) foreach ($favorites as $f) {
        $favorites_ids[] = $f['id_offer'];
      }

      return $favorites_ids;
    }
}
