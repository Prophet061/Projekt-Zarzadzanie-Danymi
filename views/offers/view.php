<?php
$this->title = $title;

use app\models\User;
use app\models\Tools;
use app\models\Favorite;
?>


<div class="site-index">
  <div class="row">
    <div class="col-lg-9">
      <? if($offers) foreach ($offers as $offer) { ?>
        <?= Tools::inc("offer", ['offer' => $offer]) ?>
      <? } ?>

      <? if(!$offers || count($offers) == 0){ ?>
        <div class="alert alert-danger" role="alert">
          <p>Nie znaleziono ofert - spróbuj ustawić inne parametry wyszukiwania.</p>
        </div>
      <? } ?>
    </div>
    <div class="col-lg-3">
      <?= Tools::inc("sidebar", []) ?>
    </div>
  </div>


</div>
