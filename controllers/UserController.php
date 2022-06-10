<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\User;
use app\models\Validate;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class UserController extends Controller{
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

      return true;
    }


  public function actionIndex(){
      $offers = Offer::getAllOffers();

      return $this->render('index', ['offers' => $offers]);
    }
  public function actionRegister(){
      if(User::isLogged()) return $this->redirect(['offers/index']);

      if (Yii::$app->request->isPost) {
        $post = Yii::$app->request->post();

        $user = User::create($post);

        if($user['success']){
          Yii::$app->session->addFlash('success', 'Konto zostało pomyślnie utworzone');
          User::login($post['login'], $post['password']);

          return $this->redirect(['offers/index']);
        }
        return $this->render('register', ['post' => $post]);
      } else {



        return $this->render('register');
      }
    }
  public function actionLogin(){
      if(User::isLogged()) return $this->redirect(['offers/index']);

      if (Yii::$app->request->isPost) {
        $post = Yii::$app->request->post();

        $login = $post['login'];
        $password = $post['password'];

        $login = User::login($login, $password);

        if($login) return $this->redirect(['offers/index']);
        return $this->render('login', ['post' => $post]);
      } else {
        return $this->render('login');
      }
    }
  public function actionEdit(){
    $me = User::getCurrentIdentity();
      if (Yii::$app->request->isPost) {
        $post = Yii::$app->request->post();

        $user = User::updateMe($post);
        if($user['success']){
          Yii::$app->session->addFlash('success', 'Dane konta zostały zaktualizowane');
          return $this->redirect(['offers/index']);
        }
        return $this->render('edit', ['user' => $me]);
      } else {
        return $this->render('edit', ['user' => $me]);
      }
    }
  public function actionLogout(){
      if(!User::isLogged()) return $this->redirect(['user/login']);

      Yii::$app->user->logout();
      return $this->redirect(['user/login']);
    }
}
