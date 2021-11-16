
 
  <?php
  $classname_form = isset($errors) ? 'form--invalid' : ' ';
  ?>
  <form class="form container <?= $classname_form; ?>" action="/login.php" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <?php 
        $classname_input = isset($errors['email']) ? 'form__item--invalid' : '';
        $value = isset($form['email']) ? $form['email'] : '';
      ?>
    <div class="form__item <?= $classname_input?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" value="<?= $value; ?>" placeholder="Введите e-mail" >
      <span class="form__error"><?= $errors['email']?></span>
    </div>
    <?php 
        $classname_input = isset($errors['password']) ? 'form__item--invalid' : '';
        $value = isset($form['password']) ? $form['password'] : '';
      ?>
    <div class="form__item form__item--last <?= $classname_input?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" value="<?= $value; ?>" placeholder="Введите пароль">
      <span class="form__error"><?= $errors['password'] ?></span>
    </div>
    <button type="submit" class="button">Войти</button>
  </form>

