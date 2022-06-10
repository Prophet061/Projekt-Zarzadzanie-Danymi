<?php
$this->title = 'Kontakt z nami';

use app\models\User;
use app\models\Favorite;

?>

<div class="row">
  <h1>Potrzebujesz pomocy?</h1>
</div>
<div class="row mt-4">
  <div class="col-12 col-lg-6">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1061.7423919934884!2d21.98081341143239!3d50.04894411529476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473cfb6d2f4ddf8f%3A0x958858da08f8753b!2sWy%C5%BCsza%20Szko%C5%82a%20Informatyki%20i%20Zarz%C4%85dzania!5e0!3m2!1spl!2spl!4v1624393424725!5m2!1spl!2spl" width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </div>
  <div class="col-12 col-lg-6">
    <p class="mb-3">Skontaktuj się z nami za pośrednictwem formularza kontaktowego zamieszczonego poniżej!</p>

    <form method="POST" class="row">
      <div class="mb-3">
        <label class="form-label">
          <p>Mój adres e-mail</p>
          <input type="email" class="form-control" name="mail" value="<?= isset($post['mail']) ? $post['mail'] : "" ?>">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Temat wiadomości</p>
          <input type="text" class="form-control" name="content" value="<?= isset($post['content']) ? $post['content'] : "" ?>">
        </label>
      </div>
      <div class="mb-3">
        <label class="form-label">
          <p>Treść wiadomości</p>
          <textarea name="subject" rows="5" cols="80" class="form-control"><?= isset($post['subject']) ? $post['subject'] : "" ?></textarea>
        </label>
      </div>

      <div class="">
        <button type="submit" class="btn btn-right btn-success"><i class="fas fa-paper-plane"></i> <span>Wyślij wiadomość</span> </button>
      </div>
    </form>
  </div>
</div>
