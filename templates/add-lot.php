

  
  <?php
  $classname_form = isset($errors) ? 'form--invalid' : ' ';
  ?>
  <form class="form form--add-lot container <?=$classname_form;?>" action="/add.php" method="POST" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <?php 
        $classname_input = isset($errors['Наименование']) ? 'form__item--invalid' : '';
        $value = isset($lot['title']) ? $lot['title'] : '';
      ?>
      <div class="form__item <?= $classname_input; ?> "> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="title" placeholder="Введите наименование лота" value="<?= $value; ?>">
        <span class="form__error"><?=$errors['Наименование']?></span>
      </div>
      <?php 
        $classname_input = isset($errors['Категория']) ? 'form__item--invalid' : '';
      ?>
      <div class="form__item <?= $classname_input; ?> ">
        <label for="category">Категория</label>
        <?php if(isset($lot)) :?>
        <select id="category" name="category">
          <option >Выберите категорию</option>
          <option <?= selected($lot['category'], 'Доски и лыжи');?>>Доски и лыжи</option>
          <option <?= selected($lot['category'], 'Крепления');?>>Крепления</option>
          <option <?= selected($lot['category'], 'Ботинки');?>>Ботинки</option>
          <option <?= selected($lot['category'], 'Одежда');?>>Одежда</option>
          <option <?= selected($lot['category'], 'Инструменты');?>>Инструменты</option>
          <option <?= selected($lot['category'], 'Разное');?>>Разное</option>          
        </select>
        <?php else :?>
          <select id="category" name="category">
          <option >Выберите категорию</option>
          <option>Доски и лыжи</option>
          <option>Крепления</option>
          <option>Ботинки</option>
          <option>Одежда</option>
          <option>Инструменты</option>
          <option>Разное</option>          
        </select>
        <?php endif; ?>
        <span class="form__error"><?=$errors['Категория']?></span>
      </div>
    </div>
    <?php 
        $classname_input = isset($errors['Описание']) ? 'form__item--invalid' : '';
        $value = isset($lot['description']) ? $lot['description'] : '';
      ?>
    <div class="form__item form__item--wide <?= $classname_input; ?>">
      <label for="message">Описание</label>
      <textarea id="message" name="description" placeholder="Напишите описание лота"><?= $value; ?></textarea>
      <span class="form__error"><?=$errors['Описание']?></span>
    </div>
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img class="img-prew" src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="photo2" name="photo2" value="" onchange="readFile(this)">
        <label class="prewImg" for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <div class="form__container-three">
    <?php 
        $classname_input = isset($errors['Начальная цена']) ? 'form__item--invalid' : '';
        $value = isset($lot['price']) ? $lot['price'] : '';
    ?>
      <div class="form__item form__item--small <?= $classname_input; ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="price" placeholder="0" value="<?= $value; ?>">
        <span class="form__error"><?=$errors['Начальная цена']?></span>
      </div>
    <?php 
        $classname_input = isset($errors['Шаг ставки']) ? 'form__item--invalid' : '';
        $value = isset($lot['lot-step']) ? $lot['lot-step'] : '';
    ?>
      <div class="form__item form__item--small <?= $classname_input; ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?= $value; ?>">
        <span class="form__error"><?=$errors['Шаг ставки']?></span>
      </div>
    <?php 
        $classname_input = isset($errors['Дата окончания торгов']) ? 'form__item--invalid' : '';
        $value = isset($lot['lot-date']) ? $lot['lot-date'] : '';
    ?>
      <div class="form__item <?= $classname_input; ?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?= $value; ?>">
        <span class="form__error"><?=$errors['Дата окончания торгов']?></span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
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