
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    
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
    <?php if (empty($lots)) : ?>
    <div>
        <h3>Открытых лотов нет</h3>
    </div>
    <?php endif; ?>
</section>
<?php if ($pages_count > 1) : ?>
  <ul class="pagination-list">
    <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
    <?php foreach ($pages as $page) : ?>
    <li class="pagination-item <?php if ($page == $cur_page) : ?>pagination-item-active<?php endif; ?>">
      <a href="<?php if(!isset($_GET['category'])) : ?>/index.php?page=<?=$page;?><?php else : ?>/index.php?category=<?=$_GET['category']?>&page=<?=$page;?><?php endif; ?>"><?=$page;?></a>
    </li>
    <?php endforeach; ?>
    <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
  </ul>
<?php endif; ?>