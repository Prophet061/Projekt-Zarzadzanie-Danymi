<?php
$this->title = 'Rejestracja';

use app\models\Industry;
use app\models\OfferType;
use app\models\Education;

?>

<div class="site-index">
  <form method="POST" action="/user/register" class="row">
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
        <label class="form-label">
          <p>Powtórz hasło</p>
          <input type="password" class="form-control" name="password_again" value="<?= isset($post['password']) ? $post['password'] : "" ?>">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Imię</p>
          <input type="text" class="form-control" name="name" value="<?= isset($post['name']) ? $post['name'] : "" ?>">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Nazwisko</p>
          <input type="text" class="form-control" name="surname" value="<?= isset($post['surname']) ? $post['surname'] : "" ?>">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Jestem...</p>
          <select class="form-select" name="type">
            <option value="1">Osobą szukającą pracy</option>
            <option value="2">Firmą lub osobą prywatną oferującą pracę</option>
          </select>
        </label>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-right btn-success"><i class="fas fa-user-plus" aria-hidden="true"></i> <span>Zarejestruj się</span> </button>
      </div>
    </div>
  </form>
</div>
