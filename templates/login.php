
  <nav class="nav">
    <ul class="nav__list container">
      <li class="nav__item">
        <a href="all-lots.html">Доски и лыжи</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Крепления</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Ботинки</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Одежда</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Инструменты</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Разное</a>
      </li>
    </ul>
  </nav>
  <!-- <?php
  $classname_form = isset($errors) ? 'form--invalid' : ' ';
  ?> -->
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
      <span class="form__error">Введите пароль</span>
    </div>
    <button type="submit" class="button">Войти</button>
  </form>

  <script>
    document.querySelector('main').classList.remove('container');
  </script>