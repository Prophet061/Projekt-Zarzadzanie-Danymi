<?php
namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\User ;
use app\models\Offer ;
use app\models\Favorite;
use app\models\Validate;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class OffersController extends Controller{
  public function behaviors(){
      return [
          'access' => [
              'class' => AccessControl::className(),
              'only' => ['logout'],
              'rules' => [
                  [
                      'actions' => ['logout'],
                      'allow' => true,
                      'roles' => ['@'],
                  ],
              ],
          ],
          'verbs' => [
              'class' => VerbFilter::className(),
              'actions' => [
                  'logout' => ['post'],
              ],
          ],
      ];
  }
  public function actions(){
      return [
          'error' => [
              'class' => 'yii\web\ErrorAction',
          ],
          'captcha' => [
              'class' => 'yii\captcha\CaptchaAction',
              'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
          ],
      ];
  }

  public function beforeAction($action){
    $this->enableCsrfValidation = false;
    if($action->id != "index" && !User::isLogged()) return $this->redirect(['user/login']);

    return true;
  }

  public function actionIndex(){
    $g = Yii::$app->request->get();
    $p = Yii::$app->request->post();

    $params = [];

    if(isset($g['industry']) && $g['industry']) $params[] = ['industry' => $g['industry']];
    if(isset($g['education']) && $g['education']) $params[] = ['education' => $g['education']];
    if(isset($g['offer_type']) && $g['offer_type']) $params[] = ['offer_type' => $g['offer_type']];
    if(isset($g['address_city']) && $g['address_city']) $params[] = ['LIKE', 'address_city', ucfirst($g['address_city'])];

    $offers = Offer::getOffers($params);
    return $this->render('view', ['offers' => $offers, 'title' => "Oferty pracy"]);
  }
  public function actionFavorite(){
    $favorites = Favorite::getFavoriteList();
    $params[] = ['in', 'id', $favorites];

    if(isset($g['industry']) && $g['industry']) $params[] = ['industry' => $g['industry']];
    if(isset($g['education']) && $g['education']) $params[] = ['education' => $g['education']];
    if(isset($g['offer_type']) && $g['offer_type']) $params[] = ['offer_type' => $g['offer_type']];
    if(isset($g['address_city']) && $g['address_city']) $params[] = ['LIKE', 'address_city', ucfirst($g['address_city'])];


    $offers = Offer::getOffers($params);
    return $this->render('view', ['offers' => $offers, 'title' => "Ulubione oferty"]);
  }
  public function actionOwn(){
    $my_id = User::getCurrentIdentity()->id;
    $params[] = ['in', 'id', $my_id];

    if(isset($g['industry']) && $g['industry']) $params[] = ['industry' => $g['industry']];
    if(isset($g['education']) && $g['education']) $params[] = ['education' => $g['education']];
    if(isset($g['offer_type']) && $g['offer_type']) $params[] = ['offer_type' => $g['offer_type']];
    if(isset($g['address_city']) && $g['address_city']) $params[] = ['LIKE', 'address_city', ucfirst($g['address_city'])];


    $offers = Offer::getOffers($params);
    return $this->render('view', ['offers' => $offers, 'title' => "Moje oferty pracy"]);
  }


  public function actionDetails(){
    $get = Yii::$app->request->get();
    $id = $get['id'];

    $offer = Offer::getById($id);
    if($offer->status != 1) return $this->redirect(['offers/index']);

    return $this->render('details', ['offer' => $offer]);
  }
  public function actionAdd(){
    if(!User::isAdvertiser()) return $this->redirect(['offers/index']);

    if (Yii::$app->request->isPost) {
      $post = Yii::$app->request->post();
      $offer = Offer::createOffer($post);

      if($offer['success']){
        Yii::$app->session->addFlash('success', 'Ogłoszenie zostało dodane');
        return $this->redirect(['offers/details', 'id' => $offer['id']]);
      }
      return $this->render('add', ['post' => $post]);
    } else {
      return $this->render('add');
    }
  }

  public function actionEdit(){
    if (Yii::$app->request->isPost) {
      $post = Yii::$app->request->post();
      $get = Yii::$app->request->get();

      $offer = Offer::updateOffer($get['id'], $post);

      if($offer['success']){
        Yii::$app->session->addFlash('success', 'Ogłoszenie zostało zaktualizowane');
        return $this->redirect(['offers/details', 'id' => $offer['id']]);
      }
      return $this->render('edit', ['post' => $post]);
    } else {
      $get = Yii::$app->request->get();
      $offer = Offer::getById($get['id']);
      return $this->render('edit', ['post' => $offer]);
    }
  }
  public function actionDelete(){
      $get = Yii::$app->request->get();
      $id = $get['id'];

      $offer = Offer::deleteOffer($id);
      if($offer){
        Yii::$app->session->addFlash('success', 'Ogłoszenie zostało usunięte');
      } else {
        Yii::$app->session->addFlash('danger', 'Nie udało się usunąć ogłoszenia');
      }
      return $this->redirect(['offers/index']);
  }

  public function actionSetfavorite(){
    $get = Yii::$app->request->get();
    $id = $get['id'];

    if(Favorite::markFavorite($id)) Yii::$app->session->addFlash('success', 'Ogłoszenie zostało dodane do ulubionych');
    return $this->redirect(['offers/index']);
  }
  public function actionUnfavorite(){
    $get = Yii::$app->request->get();
    $id = $get['id'];

    if(Favorite::unmarkFavorite($id)) Yii::$app->session->addFlash('success', 'Ogłoszenie zostało usunięte z ulubionych');
    return $this->redirect(['offers/index']);
  }

  public function actionSethighlighted(){
    $get = Yii::$app->request->get();
    $id = $get['id'];

    if(Offer::highlightOffer($id)) Yii::$app->session->addFlash('success', 'Ogłoszenie zostało wyróżnione');
    return $this->redirect(['offers/index']);
  }
  public function actionUnhighlighted(){
    $get = Yii::$app->request->get();
    $id = $get['id'];

    if(Offer::unhighlightOffer($id)) Yii::$app->session->addFlash('success', 'Ogłoszenie zostało usunięte z listy wyróżnionych');
    return $this->redirect(['offers/index']);
  }
}
