<?php
$this->title = 'Edytuj ogłoszenie';

use app\models\Industry;
use app\models\OfferType;
use app\models\Education;
use app\models\EducationSpeciality;

?>

<div class="site-index">
  <form method="POST" action="/offers/edit?id=<?= $_GET['id'] ?>" class="row">
    <div class="col-12 col-lg-6">
      <div class="mb-3">
        <label class="form-label">
          <p>Nazwa stanowiska</p>
          <input type="text" class="form-control" name="name" value="<?= $post['name'] ?>">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Nazwa firmy</p>
          <input type="text" class="form-control" name="company" value="<?= $post['company'] ?>">
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
          <?= Industry::generateOptionList($post['industry']) ?>
          </select>
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Rodzaj umowy</p>
          <select class="form-select" name="offer_type">
            <?= OfferType::generateOptionList($post['offer_type']) ?>
          </select>
        </label>
      </div>

      <div class="row">
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">
              <p>Wynagrodzenie od</p>
              <input type="money" class="form-control" name="salary_from" value="<?= $post['salary_from'] ?>">
            </label>
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">
              <p>Wynagrodzenie do</p>
              <input type="money" class="form-control" name="salary_to" value="<?= $post['salary_to'] ?>">
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
              <input type="text" class="form-control" name="address_city" value="<?= $post['address_city'] ?>">
            </label>
          </div>
        </div>
        <div class="col-3">
          <div class="mb-3">
            <label class="form-label">
              <p>Kod pocztowy</p>
              <input type="zip-code" class="form-control" name="address_zipcode" value="<?= $post['address_zipcode'] ?>">
            </label>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Ulica</p>
          <input type="text" class="form-control" name="address_street" value="<?= $post['address_street'] ?>">
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
          <input type="email" class="form-control" name="email" value="<?= $post['email'] ?>">
        </label>
      </div>

      <div class="mb-3">
        <label class="form-label">
          <p>Kontakt - telefon</p>
          <input type="mobile" class="form-control" name="mobile" value="<?= $post['mobile'] ?>">
        </label>
      </div>

    </div>
    <div class="col-12 col-lg-6">
      <div class="mb-3">
        <label class="form-label">
          <p>Opis stanowiska</p>
          <textarea name="description" rows="5" cols="80" class="form-control"><?= $post['description'] ?></textarea>
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Zakres obowiązków</p>
          <textarea name="responsibilities" rows="5" cols="80" class="form-control"><?= $post['responsibilities'] ?></textarea>
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Dodatkowe wymagania</p>
          <textarea name="requirments" rows="5" cols="80" class="form-control"><?= $post['requirments'] ?></textarea>
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Wymagane wykształcenie</p>
          <select class="form-select" name="education">
            <?= Education::generateOptionList($post['education']) ?>
          </select>
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Kierunek kształcenia</p>
          <select class="form-select" name="speciality">
            <?= EducationSpeciality::generateOptionList($post['speciality']) ?>
          </select>
        </label>
      </div>

    </div>

    <div class="row">
      <div class="col-12">
        <button type="submit" class="btn btn-success">Zapisz zmiany</button>
      </div>
    </div>
  </form>
</div>
