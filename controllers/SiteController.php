<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class SiteController extends Controller{
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
      return $this->redirect(['offers/index']);
  }

  public function actionContact(){
    if (Yii::$app->request->isPost) {
      $post = Yii::$app->request->post();

      $email = $post['mail'];
      $subject = $post['subject'];
      $content = $post['content'];

      $stop = false;
      if(!$email){
        $stop = true;
        Yii::$app->session->addFlash('danger', 'Podany email jest niepoprawny');
      }
      if(!$subject){
        $stop = true;
        Yii::$app->session->addFlash('danger', 'Podany temat wiadomości jest niepoprawny');
      }
      if(!$content){
        $stop = true;
        Yii::$app->session->addFlash('danger', 'Podana treść wiadomości jest niepoprawna');
      }

      if(!$stop){
        $mail = mail("spam@".$_SERVER['SERVER_NAME'], $subject, $content);
        $s = $mail ? Yii::$app->session->addFlash('success', 'Wiadomość została wysłana') : Yii::$app->session->addFlash('success', 'Nie udało się wysłać wiadomości');
        return $this->render('contact');

      } else {
        return $this->render('contact', ['post' => $post]);
      }
    } else {
      return $this->render('contact');
    }
  }



}
