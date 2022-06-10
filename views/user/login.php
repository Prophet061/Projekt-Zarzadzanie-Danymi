<?php
$this->title = 'Logowanie';

use app\models\Industry;
use app\models\OfferType;
use app\models\Education;

?>

<div class="site-index">
  <form method="POST" action="/user/login" class="row">
    <div class="col-12 col-lg-6 offset-lg-3">
      <div class="mb-3">
        <label class="form-label">
          <p>Nazwa użytkownika</p>
          <input type="text" class="form-control" name="login" value="<?= isset($post['login']) ? $post['login'] : "" ?>">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Hasło</p>
          <input type="password" class="form-control" name="password" value="<?= isset($post['password']) ? $post['password'] : "" ?>">
        </label>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-right btn-success"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> <span>Zaloguj się</span> </button>

      </div>
    </div>
  </form>
</div>
