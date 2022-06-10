<?
use yii\helpers\Html;
use app\assets\AppAsset;
use app\models\User;

AppAsset::register($this);
$this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
      <meta charset="<?= Yii::$app->charset ?>">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php $this->registerCsrfMetaTags() ?>
      <title><?= Html::encode($this->title) ?></title>
      <?php $this->head() ?>
  </head>
  <body>
    <?php $this->beginBody() ?>
    <header>
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="/">Ogłoszenia pracy</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">
              <li class="nav-item">
                <a class="nav-link" href="/offers/index"><i class="fas fa-list-alt"></i> Wszystkie ogłoszenia</a>
              </li>

              <? if(User::isLogged() && !User::isAdvertiser()) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="/offers/favorite"><i class="fas fa-heart"></i> Ulubione</a>
                </li>
              <? } ?>

              <? if(User::isAdvertiser()) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="/offers/own"><i class="fas fa-list-alt"></i> Moje ogłoszenia</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="/offers/add"><i class="fas fa-folder-plus"></i> Dodaj ogłoszenie</a>
                </li>
              <? } ?>

              <li class="nav-item">
                <a class="nav-link" href="/site/contact"><i class="fas fa-phone-alt"></i> Kontakt z nami</a>
              </li>


              <li class="nav-item dropdown ms-lg-auto me-0">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <? $u = User::getCurrentIdentity() ?>
                  <?= User::isLogged() ? "Witaj ".$u->name." ".$u->surname : "Moje konto" ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <? if(User::isLogged()){ ?>
                    <li><a class="dropdown-item" href="/user/edit"><i class="fas fa-pen"></i> Edytuj konto</a></li>
                    <li><a class="dropdown-item" href="/user/logout"><i class="fas fa-sign-out-alt"></i> Wyloguj</a></li>
                  <? } else { ?>
                    <li><a class="dropdown-item" href="/user/login"><i class="fas fa-sign-in-alt"></i> Zaloguj</a></li>
                    <li><a class="dropdown-item" href="/user/register"><i class="fas fa-user-plus"></i> Utwórz konto</a></li>
                  <? } ?>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>


    <section class="container" id="main">
      <div class="row alert-box">
        <?
          $alerts = Yii::$app->session->getAllFlashes();
          if($alerts) foreach ($alerts as $alert_class => $alerts_type) {
            if($alerts_type) foreach ($alerts_type as $alert) { ?>
              <div class="alert alert-<?= $alert_class ?>" role="alert">
                <p><?= $alert ?></p>
              </div>
          <?}
          }
        ?>
      </div>
      <div class="row">
        <?= $content ?>
      </div>
    </section>


    <footer class="d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-4 mb-md-0">
            <p class="text-center">Jakub Janusz - w62006 - <?= date("Y") ?>r</p>
          </div>
        </div>
      </div>
    </footer>
  <?php $this->endBody() ?>
  <script src="https://kit.fontawesome.com/37ef38c4c9.js" crossorigin="anonymous"></script>
  </body>
</html>
<?php $this->endPage() ?>
