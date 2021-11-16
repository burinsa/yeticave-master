

<?php
$classname_form = isset($errors) ? 'form--invalid' : ' ';
?> 
<form class="form container <?= $classname_form; ?>" action="/sign-up.php" method="post" enctype="multipart/form-data" > 
  <h2>Регистрация нового аккаунта</h2>
  <?php 
      $classname_input = isset($errors['email']) ? 'form__item--invalid' : '';
      $value = isset($form['email']) ? $form['email'] : '';
    ?>
  <div class="form__item <?= $classname_input; ?>"> <!-- form__item--invalid -->
    <label for="email">E-mail*</label>
    <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $value; ?>">
    <span class="form__error"><?= $errors['email']; ?></span>
  </div>
  <?php 
      $classname_input = isset($errors['password']) ? 'form__item--invalid' : '';
      $value = isset($form['password']) ? $form['password'] : '';
    ?>
  <div class="form__item <?= $classname_input; ?>">
    <label for="password">Пароль*</label>
    <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?= $value; ?>">
    <span class="form__error"><?= $errors['password']; ?></span>
  </div>
  <?php 
      $classname_input = isset($errors['name']) ? 'form__item--invalid' : '';
      $value = isset($form['name']) ? $form['name'] : '';
    ?>
  <div class="form__item <?= $classname_input; ?>">
    <label for="name">Имя*</label>
    <input id="name" type="text" name="name" placeholder="Введите имя" value="<?= $value; ?>">
    <span class="form__error"><?= $errors['name']; ?></span>
  </div>
  <?php 
      $classname_input = isset($errors['message']) ? 'form__item--invalid' : '';
      $value = isset($form['message']) ? $form['message'] : '';
    ?>
  <div class="form__item <?= $classname_input; ?>">
    <label for="message">Контактные данные*</label>
    <textarea id="message" name="message" placeholder="Напишите как с вами связаться" value="<?= $value; ?>"></textarea>
    <span class="form__error"><?= $errors['message']; ?></span>
  </div>
  <div class="form__item form__item--file form__item--last">
    <label>Аватар</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img class="img-prew" src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo2" name="photo2" value=""  onchange="readFile(this)">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Зарегистрироваться</button>
  <a class="text-link" href="#">Уже есть аккаунт</a>
</form>

<script>
    function readFile (input) {
      let file = input.files[0];
      let urlFile = URL.createObjectURL(file);
      let img = document.querySelector('.img-prew');
      img.setAttribute('src', urlFile);
      document.querySelector('.preview').style.display = 'block';
    }
  </script>