
<div class="container">
  <section class="lots">
    <h2>История просмотров</h2>
    <?php if (isset($new_lots)) : ?>
    <ul class="lots__list">
      <?php foreach ($new_lots as $key => $value): ?>
          <li class="lots__item lot">
              <div class="lot__image">
                  <img src="<?=$value['img']?>" width="350" height="260" alt="Сноуборд">
              </div>
              <div class="lot__info">
                  <span class="lot__category"><?=$value['category']?></span>
                  <h3 class="lot__title"><a class="text-link" href="/lot.php?id_lot=<?=$value['lot_id'];?>"><?=$value['title']?></a></h3>
                  <div class="lot__state">
                      <div class="lot__rate">
                          <span class="lot__amount">Стартовая цена</span>
                          <span class="lot__cost"><?=format_price($value['price'])?></span>
                      </div>
                      <div class="lot__timer timer">
                          <?= $time ?>
                      </div>
                  </div>
              </div>
          </li>
      <?php endforeach ?>
    </ul>
    <?php else : ?>
      <div>
        <h1 style="color: brown; text-align: center;">У вас нет просмотренных лотов</h1>
      </div>
    <?php endif; ?> 
  </section>
  
</div>

