<?php
$this->title = 'Aktualizacja konta';

use app\models\Industry;
use app\models\OfferType;
use app\models\Education;

?>
<div class="container">
  <form method="POST" action="/user/edit" class="row">
    <div class="col-12 col-lg-6 offset-lg-3">
      <div class="mb-3">
        <label class="form-label">
          <p>Stare hasło</p>
          <input type="password" class="form-control" name="old_password" value="">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Nowe hasło</p>
          <input type="password" class="form-control" name="new_password" value="">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Powtórz nowe hasło</p>
          <input type="password" class="form-control" name="new_password_again" value="">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Imię</p>
          <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Nazwisko</p>
          <input type="text" class="form-control" name="surname" value="<?= $user['surname'] ?>">
        </label>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-right btn-success"><i class="fas fa-pen" aria-hidden="true"></i> <span>Zaktualizuj dane</span> </button>
      </div>
    </div>
  </form>
</div>
