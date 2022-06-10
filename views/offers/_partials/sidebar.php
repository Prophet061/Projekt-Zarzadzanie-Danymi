<?

use app\models\Offer;
use app\models\Industry;
use app\models\OfferType;
use app\models\Education;
use app\models\EducationSpeciality;

$g = $_GET;
?>

<form class="card mb-3 sidebar filter" method="get">
  <h2 class="card-header h4">
    Filtruj oferty
  </h2>
  <div class="card-body row">
    <div class="col-12">
      <? $r = rand(1, 10) ?>
      <p>Zawód<?= $r < 2 ? " dla rodziny" : "" ?>: </p>
      <select class="form-select" name="industry">
        <option value="0">Dowolne</option>
        <?= Industry::generateOptionList(isset($g['industry']) ? $g['industry'] : 0) ?>
      </select>

      <p>Wymagane wykształcenie: </p>
      <select class="form-select" name="education">
        <option value="0">Dowolne</option>
        <?= Education::generateOptionList(isset($g['education']) ? $g['education'] : 0) ?>
      </select>

      <p>Rodzaj umowy: </p>
      <select class="form-select" name="offer_type">
        <option value="0">Dowolne</option>
        <?= OfferType::generateOptionList(isset($g['offer_type']) ? $g['offer_type'] : 0) ?>
      </select>

      <? $cities =  Offer::getAddressCityDynamic() ?>

      <p>Miejscowość: </p>
      <select class="form-select" name="address_city">
        <option value="0">Dowolne</option>
        <? if(isset($cities) && count($cities) > 0 ) foreach ($cities as $c) { ?>
           <option <?= isset($g['address_city']) && $g['address_city'] == $c ? "selected" : "" ?> value="<?= $c ?>"><?= $c ?></option>
        <? } ?>
      </select>
    </div>
  </div>


  <div class="card-footer">
    <button type="submit" class="btn w-100 btn-success me-1"> <i class="fas fa-search"></i> <span>Filtruj oferty</span> </button>
  </div>
</form>
