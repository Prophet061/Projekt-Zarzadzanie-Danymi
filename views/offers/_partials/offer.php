<?
use app\models\User;
use app\models\Tools;
use app\models\Favorite;


?>


<div class="card mb-3 <?= $offer->isHighlighted() ? "highlighted" : "" ?>">
  <h2 class="card-header h4">
    <?= $offer->name ?>
    <? if(User::isLogged()) { ?>
      <? if(Favorite::isFavorited($offer->id)) { ?>
        <a href="/offers/unfavorite?id=<?=$offer->id?>" class="btn-favorite"><i class="fas fa-heart"></i></a>
      <? } else { ?>
        <a href="/offers/setfavorite?id=<?=$offer->id?>" class="btn-favorite"><i class="far fa-heart"></i></a>
      <? } ?>
    <? } ?>

    <? if($offer->isHighlighted()){ ?>
      <p class="promoted-label d-none d-md-inline-block">Ogłoszenie zostało wypromowane przez Administratora</p>
    <? } ?>
  </h2>
  <div class="card-body row">
    <div class="col-12">
      <p class="offer-header">Opis oferty przygotowany przez pracodawcę:</p>
      <div class="offer-description">
        <?= Tools::truncate($offer->description, 512)?>
      </div>
      <p class="offer-header">Zakres obowiązków: </p>
      <div class="offer-description">
        <?= Tools::truncate($offer->responsibilities, 512)?>
      </div>

      <p class="offer-header">Oferta dodana: </p>
      <div class="offer-description">
        <?= Tools::getDayOfWeek(date("w", strtotime($offer->date_created))) ?>,
        <?= date("j", strtotime($offer->date_created)) ?>
        <?= Tools::getMonthName(date("n", strtotime($offer->date_created))) ?>
        <?= date("Y", strtotime($offer->date_created)) ?>

        <? $d = Tools::getDaysSince($offer->date_created, true) ?>
        <? if ($d != 0){ ?>
          <span class="days-since">(<?= Tools::getDaysSince($offer->date_created)  ?> temu)</span>
        <? } ?>


      </div>
    </div>
    <div class="col-12">

    </div>
  </div>


  <div class="card-footer">
    <a href="/offers/details?id=<?=$offer->id?>" class="btn btn-success me-1"> <i class="fas fa-search"></i> <span>Szczegóły oferty</span> </a>
    <? if(!User::isAdvertiser() && !User::isAdmin()) { ?>
      <a href="mailto:<?=$offer->email?>?subject=Aplikacja na stanowisko <?=$offer->name?>" class="btn btn-success me-1"><i class="fas fa-envelope"></i> <span>Aplikuj</span> </a>
    <? } ?>

    <? if($offer->isOwner() || User::isAdmin()) { ?>
      <a href="/offers/delete?id=<?=$offer->id?>" class="btn btn-danger float-end"><i class="far fa-trash-alt"></i> <span>Wycofaj ofertę</span> </a>
    <? } ?>

    <? if(User::isAdmin()){ ?>
      <? if($offer->isHighlighted()) { ?>
        <a href="/offers/unhighlighted?id=<?=$offer->id?>" class="btn btn-success float-end me-1"><i class="far fa-star"></i> <span>Usuń wyróżnienie</span> </a>
      <? } else { ?>
        <a href="/offers/sethighlighted?id=<?=$offer->id?>" class="btn btn-success float-end me-1"><i class="fas fa-star"></i> <span>Wyróżnij</span> </a>
      <? } ?>
    <? } ?>

    <? if($offer->isOwner()){ ?>
      <a href="/offers/edit?id=<?=$offer->id?>" class="btn btn-success float-end me-1"><i class="fas fa-pen"></i> <span>Edytuj</span> </a>
    <? } ?>
  </div>
</div>
