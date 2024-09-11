<?php
    include_once('./app/controllers/catalog_ctrl.php');
?>

<div class="countShowWrapper">
    <details>
        <summary>показать <?=$countShow ?> товаров на странице </summary>
        <div>
            <?php
            foreach ($arHowMuchToShow as $howMuchToShow) {
                ?>
                <a href="<?=pagination('countShow', $howMuchToShow)?>"><?= $howMuchToShow ?></a>
                <?php
            }
            ?>
            <a href="<?=pagination('countShow', $CountRecords)?>">Все</a>
        </div>
    </details>
</div>
<?php
foreach ($arAllRecords as $Record) {
?>
    <div class="goodUnitWraper">
        <div class="model">
            <div class="goodBrand"><?= $Record['name'] ?></div>
            <div class="goodBrand"><?= $Record['model'] ?></div>
        </div>
        <div class="goodPower"><?= $Record['power'] . ' кВт' ?></div>
        <div class="goodWeight"><?= $Record['weight'] . ' кг' ?></div>
        <div class="goodPrice righted"><?= $Record['price'] . ' руб' ?></div>
    </div>
<?php
}
?>
<div class="NavigationWraper">
    <?php
    if (!empty($arAllRecords)) {
        foreach ($arPagination as $elem => $pageNum) {
            $paginElem = $elem;
            if ($elem == 'before' || $elem == 'after') {
                $paginElem = '...';
            }
            ?><a href="<?= pagination('page', $pageNum) ?>" class="page"><?= $paginElem ?></a><?php
        }
    } else {
    ?>
         <div>Нет товаров</div>
    <?php
    }
    ?>
</div>
