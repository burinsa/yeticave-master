<section class="lots">
    <div class="lots__header">
        <h2>Результаты поиска по запросу «<span><?=$_GET['search']?></span>»</h2>
    </div>
    <?php if (count($lots)) : ?>
    <ul class="lots__list">
        <?php foreach ($lots as $key => $value): ?>
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
      <h3>Ничего не найдено по вашему запросу</h3>
    </div>
    <?php endif; ?>  
</section>

<script>
    document.querySelector('main').classList.add('container');
</script>