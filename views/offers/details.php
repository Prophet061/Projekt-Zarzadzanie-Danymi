<?php
$this->title = 'Oferta pracy - '.$offer->name;

use app\models\User;
use app\models\Industry;
use app\models\OfferType;
use app\models\Education;
use app\models\EducationSpeciality;

?>

<div class="card card-details">
  <h2 class="card-header h4">
    <?= $offer->name ?>
    <a href="/offers/unfavorite?id=9" class="btn-favorite"><i class="fas fa-heart" aria-hidden="true"></i></a>
    <p class="promoted-label d-none d-md-inline-block">Ogłoszenie wystawione przez <?= $offer->company ?></p>
  </h2>
  <div class="card-body row">
    <div class="col-12 col-lg-9">
      <h2 class="card-details-header">Opis stanowiska: </h2>
      <div class="card-details-text">
        <?= $offer->description ? $offer->description : "-" ?>
      </div>

      <h2 class="card-details-header">Zakres obowiązków na stanowisku <?= $offer->name ?>: </h2>
      <div class="card-details-text">
        <?= $offer->description ? $offer->description : "-" ?>
      </div>

      <h2 class="card-details-header">Dodatkowe wymagania ze strony pracodawcy: </h2>
      <div class="card-details-text">
        <?= $offer->requirments ? $offer->requirments : "-" ?>
      </div>

      <h2 class="card-details-header">Wymagane wykształcenie: </h2>
      <div class="card-details-text">
        <?= Education::getNameById($offer->education) ?> <span class="fw-normal">dla specjalizacji</span> <?= EducationSpeciality::getNameById($offer->speciality) ?>
      </div>

      <h2 class="card-details-header">Rodzaj oferty: </h2>
      <div class="card-details-text">
        <?= OfferType::getNameById($offer->offer_type) ?>
      </div>

      <h2 class="card-details-header">Wynagrodzenie netto: </h2>
      <div class="card-details-text">
        <?= $offer->salary_from." - ".$offer->salary_to." zł" ?>
      </div>
    </div>
    <div class="col-12 col-lg-3">
      <div class="sticky">
        <h2 class="card-details-header">Dane pracodawcy: </h2>

        <p class="company-name"><?= $offer->company ?></p>
        <p class="company-address"> <?= $offer->address_street ?><br><?= $offer->address_zipcode ?> <?= $offer->address_city ?></p>


        <h2 class="card-details-header">Kontakt z pracodawcą: </h2>

        <p class="company-address">
          <a href="https://www.google.com/maps/search/<?= $offer->address_street ?>, <?= $offer->address_zipcode ?> <?= $offer->address_city ?>/" target="_blank" class="btn w-100 mb-3 btn-success"><i class="fas fa-map-marked-alt"></i> <span>Pokaż na mapie</span> </a>
          <a href="https://www.google.com/maps/dir//<?= $offer->address_street ?>, <?= $offer->address_zipcode ?> <?= $offer->address_city ?>/" target="_blank" class="btn w-100 btn-success"><i class="fas fa-route"></i> <span>Ustaw nawigację</span> </a></p>
        <p class="company-mobile"><a href="tel:<?=$offer->mobile?>" class="btn w-100 btn-success"><i class="fas fa-mobile"></i> <span>Zadzwoń</span> </a></p>
        <p class="company-mail"><a href="mailto:<?=$offer->email?>?subject=Aplikacja na stanowisko <?=$offer->name?>" class="btn w-100 btn-success"><i class="fas fa-envelope"></i> <span>Aplikuj</span> </a></p>

        <? if($offer->isOwner() || User::isAdmin()) { ?>
          <h2 class="card-details-header">Zarządzaj ofertą: </h2>

          <? if($offer->isOwner()){ ?>
            <a href="/offers/edit?id=<?=$offer->id?>" class="btn w-100 mb-3 btn-success float-end"><i class="fas fa-pen"></i> <span>Edytuj</span> </a>
          <? } ?>

          <? if(User::isAdmin()){ ?>
            <? if($offer->isHighlighted()) { ?>
              <a href="/offers/unhighlighted?id=<?=$offer->id?>" class="btn w-100 mb-3 btn-success float-end"><i class="far fa-star"></i> <span>Usuń wyróżnienie</span> </a>
            <? } else { ?>
              <a href="/offers/sethighlighted?id=<?=$offer->id?>" class="btn w-100 mb-3 btn-success float-end"><i class="fas fa-star"></i> <span>Wyróżnij</span> </a>
            <? } ?>
          <? } ?>

          <a href="/offers/delete?id=<?=$offer->id?>" class="btn w-100 mb-3 btn-danger"><i class="far fa-trash-alt"></i> <span>Wycofaj ofertę</span> </a>
        <? } ?>

      </div>
    </div>
  </div>
</div>
