<?php
$this->title = 'Dodaj ogłoszenie';

use app\models\Industry;
use app\models\OfferType;
use app\models\Education;
use app\models\EducationSpeciality;

?>

<div class="site-index">
  <form method="POST" action="/offers/add" class="row">
    <div class="col-12 col-lg-6">
      <div class="mb-3">
        <label class="form-label">
          <p>Nazwa stanowiska</p>
          <input type="text" class="form-control" name="name" value="<?= isset($post['name']) ? $post['name'] : "" ?>">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Nazwa firmy</p>
          <input type="text" class="form-control" name="company" value="<?= isset($post['company']) ? $post['company'] : "" ?>">
        </label>
      </div>

      <div class="row">
        <div class="col-12">
          <hr>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">
          <p>Branża</p>
          <select class="form-select" name="industry">
          <?= Industry::generateOptionList(isset($post['industry']) ? $post['industry'] : 0) ?>
          </select>
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Rodzaj umowy</p>
          <select class="form-select" name="offer_type">
            <?= OfferType::generateOptionList(isset($post['offer_type']) ? $post['offer_type'] : 0) ?>
          </select>
        </label>
      </div>

      <div class="row">
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">
              <p>Wynagrodzenie od</p>
              <input type="money" class="form-control" name="salary_from" value="<?= isset($post['salary_from']) ? $post['salary_from'] : 0 ?>">
            </label>
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">
              <p>Wynagrodzenie do</p>
              <input type="money" class="form-control" name="salary_to" value="<?= isset($post['salary_to']) ? $post['salary_to'] : 0 ?>">
            </label>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <hr>
        </div>
      </div>

      <div class="row">
        <div class="col-9">
          <div class="mb-3">
            <label class="form-label">
              <p>Miejscowość</p>
              <input type="text" class="form-control" name="address_city" value="<?= isset($post['address_city']) ? $post['address_city'] : "" ?>">
            </label>
          </div>
        </div>
        <div class="col-3">
          <div class="mb-3">
            <label class="form-label">
              <p>Kod pocztowy</p>
              <input type="zip-code" class="form-control" name="address_zipcode" value="<?= isset($post['address_zipcode']) ? $post['address_zipcode'] : "" ?>">
            </label>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Ulica</p>
          <input type="text" class="form-control" name="address_street" value="<?= isset($post['address_street']) ? $post['address_street'] : "" ?>">
        </label>
      </div>

      <div class="row">
        <div class="col-12">
          <hr>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">
          <p>Kontakt - email</p>
          <input type="email" class="form-control" name="email" value="<?= isset($post['email']) ? $post['email'] : "" ?>">
        </label>
      </div>

      <div class="mb-3">
        <label class="form-label">
          <p>Kontakt - telefon</p>
          <input type="mobile" class="form-control" name="mobile" value="<?= isset($post['mobile']) ? $post['mobile'] : "" ?>">
        </label>
      </div>

    </div>
    <div class="col-12 col-lg-6">
      <div class="mb-3">
        <label class="form-label">
          <p>Opis stanowiska</p>
          <textarea name="description" rows="5" cols="80" class="form-control"><?= isset($post['description']) ? $post['description'] : "" ?></textarea>
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Zakres obowiązków</p>
          <textarea name="responsibilities" rows="5" cols="80" class="form-control"><?= isset($post['responsibilities']) ? $post['responsibilities'] : "" ?></textarea>
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Dodatkowe wymagania</p>
          <textarea name="requirments" rows="5" cols="80" class="form-control"><?= isset($post['requirments']) ? $post['requirments'] : "" ?></textarea>
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Wymagane wykształcenie</p>
          <select class="form-select" name="education">
            <?= Education::generateOptionList(isset($post['education']) ? $post['education'] : 0) ?>
          </select>
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Kierunek kształcenia</p>
          <select class="form-select" name="speciality">
            <?= EducationSpeciality::generateOptionList(isset($post['speciality']) ? $post['speciality'] : 0) ?>
          </select>
        </label>
      </div>

    </div>

    <div class="row">
      <div class="col-12">
        <button type="submit" class="btn btn-success"><i class="fas fa-folder-plus" aria-hidden="true"></i> <span>Dodaj ogłoszenie</span> </button>
      </div>
    </div>
  </form>
</div>
