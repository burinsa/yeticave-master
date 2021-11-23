
  
<section class="lot-item container">
  <?php if (isset($lot)): ?>
  <h2><?=htmlspecialchars($lot['title'])?></h2>
  <div class="lot-item__content">
    <div class="lot-item__left">
      <div class="lot-item__image">
        <img src="<?=$lot['img']?>" width="730" height="548" alt="<?=htmlspecialchars($lot['title'])?>">
      </div>
      <p class="lot-item__category">Категория: <span><?=htmlspecialchars($lot['category'])?></span></p>
      <p class="lot-item__description"><?=htmlspecialchars($lot['description'])?></p>
    </div>
    <div class="lot-item__right">
      <?php if(isset($_SESSION['user']) && $_SESSION['user']['user_id'] !== $lot['user'] ) : ?>
      <div class="lot-item__state">
        <div class="lot-item__timer timer">
          <?=timer($lot['lot-date'])?>
        </div>
        <div class="lot-item__cost-state">
          <div class="lot-item__rate">
            <span class="lot-item__amount">Текущая цена</span>
            <span class="lot-item__cost"><?=htmlspecialchars($lot['price'])?><b class="rub">р</b></span>
          </div>
          <div class="lot-item__min-cost">
            Мин. ставка <span>12 000 р</span>
          </div>
        </div>
        <form class="lot-item__form" action="/rate.php?id_lot=<?=$lot['lot_id']?>" method="post">
          <p class="lot-item__form-item">
            <label for="cost">Ваша ставка</label>
            <input id="cost" type="number" name="cost" min="<?=$lot['price'] + $lot['step']?>" step="<?=$lot['step']?>" placeholder="12 000">
          </p>
          <button type="submit" class="button">Сделать ставку</button>
        </form>
      </div>
      <?php endif; ?>
      <div class="history">
        <h3>История ставок (<span><?=count($rates)?></span>)</h3>
        <?php if (!empty($rates)): ?>
        <table class="history__list">        
        <?php foreach ($rates as $key => $rate) : ?>
          <tr class="history__item">
            <td class="history__name"><?= $rate['name']?></td>
            <td class="history__price"><?= $rate['price']?> р</td>
            <td class="history__time"><?=date('d.m.Y, H:m', strtotime($rate['date'])); ?></td>
          </tr>
        <?php endforeach; ?> 
        
        </table>
        <?php else :?>
        <div>
          <h3>Ставок пока нет.</h3>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php else: ?>
    <div>
      <h1 style="color: brown; text-align: center;">Такого лота не существует</h1>
    </div>
    <?php endif; ?> 
</section>

