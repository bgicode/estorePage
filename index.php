
<?php
require_once('handler.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script src="./script.js" type="text/javascript"></script>
</head>
<body>
    <div class="mainWraper">

        <div class="filterWraper">
            <div class="filterWraperFix">
                <form action="<?php $_SERVER['REQUEST_URI']?>" method="GET" id='form'>

                    <div class="filterParametrWraper">
                        <span class="filterUnitTitle">Цена</span>
                        <div class="parametrWraper">
                            <div class="parametr priceFrom">
                                <input class="filterUnitValue" type="number" step="any" min="<?= $minPrice ?>" max="<?= $maxPrice ?>" placeholder="от <?= $minPrice ?>" name="price[from]" value="<?= $_GET['price']['from'] ?>">
                            </div>
                            <div class="parametr priceTo">
                                <input class="filterUnitValue" type="number" step="any" min="<?= $minPrice?>" max="<?= $maxPrice ?>" placeholder="до <?= $maxPrice ?>" name="price[to]" value="<?= $_GET['price']['to'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="filterParametrWraper">
                        <span class="filterUnitTitle">Мощность</span>
                        <div class="parametrWraper">
                            <div class="parametr powerFrom">
                                <input class="filterUnitValue" type="number" step="any" min="<?= $minPower ?>" max="<?= $maxPower ?>" placeholder="от <?= $minPower ?>" name="power[from]" value="<?= $_GET['power']['from'] ?>">
                            </div>
                            <div class="parametr powerTo">
                                <input class="filterUnitValue" type="number" step="any" min="<?= $minPower ?>" max="<?= $maxPower ?>" placeholder="до <?= $maxPower ?>" name="power[to]" value="<?= $_GET['power']['to'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="filterParametrWraper">
                        <span class="filterUnitTitle">Вес</span>
                        <div class="parametrWraper">
                            <div class="parametr weightFrom">
                                <input class="filterUnitValue" type="number" step="any" min="<?= $minWeight ?>" max="<?= $maxWeight ?>" placeholder="от <?= $minWeight ?>" name="weight[from]" value="<?= $_GET['weight']['from'] ?>">
                            </div>
                            <div class="parametr powerTo">
                                <input class="filterUnitValue" type="number" step="any" min="<?= $minWeight ?>" max="<?= $maxWeight ?>" placeholder="до <?= $maxWeight ?>" name="weight[to]" value="<?= $_GET['weight']['to']?>">
                            </div>
                        </div>
                    </div>

                    <div class="filterBrandWraper">
                        <div class="filterUnitTitle">Бренд</div>
                        <div class="brandList">
                            <?php
                            foreach ($arBrandList as $brand) {
                            ?>
                                <label class="filterBrandUnit
                                    <?php
                                    foreach ($arBrandListGet as $brandGet) {
                                        if ($brandGet['brand'] != $brand['brand']) {
                                            $flag = true;
                                        } else {
                                            $flag = false;
                                            break;
                                        }
                                    }
                                    if ($flag) {
                                        echo 'notAvailable';
                                    }
                                    ?>
                                    ">
                                    <input type="checkbox" name="filterBrands[]" value="<?= $brand['brand'] ?>"
                                        <?php
                                        if (isset($_GET['filterBrands'])) {
                                            if (in_array($brand['brand'], $_GET['filterBrands'])) {
                                                echo 'checked';
                                            }
                                        }
                                        ?>
                                    /><?= read($pdo, 'SELECT DISTINCT name FROM brands WHERE brand_id = ' . $brand["brand"] . ';')[0]['name'] ?><br />
                                </label>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <input class="show" type="submit" value="Показать">
                </form>
            </div>
        </div>

        <div class="goodsListWraper">
            <?php
            if (!empty($arAllRecords)) {
            ?>
                <div class="countShowWrapper">
                    <details>
                        <summary>показать <?=$countShow ?> товаров на странице </summary>
                        <div>
                            <?php
                            if ($CountRecords > 3) {
                                ?>
                                    <a href="<?=pagination('countShow', 3)?>">3</a>
                                <?php
                            }
                            if ($CountRecords > 5) {
                                ?>
                                    <a href="<?=pagination('countShow', 5)?>">5</a>
                                <?php
                            }
                            if ($CountRecords > 7) {
                                ?>
                                    <a href="<?=pagination('countShow', 7)?>">7</a>
                                <?php
                            }
                            if ($CountRecords > 10) {
                                ?>
                                    <a href="<?=pagination('countShow', 10)?>">10</a>
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
                    if ($countPages >= 2) {
                    ?>
                        <div class="pageChange">
                            <a href="
                                <?php
                                if (isset($_GET['page'])){
                                    $previousPage = $_GET['page'] - 1;
                                } else {
                                    $previousPage = $countPages;
                                }
                                
                                if ($previousPage > 1) {
                                    echo pagination('page', $previousPage);
                                }
                                ?>
                            "><</a>
                        </div>
                    <?php
                    }
                    // Начало пагинации, сокрытие страниц при их количестве больше 9
                    if ($countPages > 9) {
                    ?>
                        <a href="<?= pagination('page', 1) ?>" class="page">1</a>
                        <?php
                        // начало символ сокрытия страниц
                        if (isset($_GET['page'])) {
                            if ($_GET['page'] >= 6) {
                        ?>
                                <a href="<?= pagination('page', ($_GET['page'] - 3)) ?>" class="page">...</a>
                                <?php
                                $afterHidenPageStart = true;
                            }
                        }
                        // конец символ сокрытия страниц
                        // начало без окрытия
                        if (($countPages - $_GET['page']) <= 4) {
                            for ($i = 0; $i < 4; $i++) {
                                ?>
                                <a href="<?= pagination('page', $countPages - 4 + $i) ?>" class="page"><?= $countPages - 4 + $i ?></a>
                            <?php
                            }
                        } else {
                        // конец без сокрытия
                        // начало страницы если первые скрыты
                            for ($i = 0; $i <= 3; $i++) {
                                if(isset($_GET['page'])) {
                                    if (!$afterHidenPageStart) {
                            ?>
                                        <a href="<?= pagination('page', $i + 2) ?>" class="page"><?= $i + 2 ?></a>
                                    <?php
                                    } elseif ($_GET['page']+ $i < $countPages) {
                                    ?>
                                        <a href="<?= pagination('page', $_GET['page'] + $i) ?>" class="page"><?= $_GET['page'] + $i ?></a>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <a href="<?= pagination('page', $i + 2) ?>" class="page"><?= $i + 2 ?></a>
                                <?php
                                }
                            }
                        }
                        // конец страницы если первые скрыты
                        // начало сокрыет последних страниц
                        if ($countPages > 9 && ($countPages - $_GET['page']) > 4) {
                            if (isset($_GET['page'])) {
                                if (!$afterHidenPageStart && $_GET['page'] < 6) {
                                    $nextPages = 6;
                                } elseif ($_GET['page'] == 1) {
                                    $nextPages = $_GET['page'] + 6;
                                } else {
                                    $nextPages = $_GET['page'] + 3;
                                }
                            } else {
                                $nextPages = 6;
                            }
                            // начало заполнение сокрытия страниц при малом их кол-ве
                            $endPagesCount = $countPages - $_GET['page'] - 4;
                            if ($endPagesCount <= 2) {
                                for($i = 0; $i < $endPagesCount; $i++) {
                                ?>
                                    <a href="<?= pagination('page', $countPages - $endPagesCount + $i) ?>" class="page"><?= $countPages - $endPagesCount + $i?></a>
                                <?php
                                }
                            // конец заполнение сокрытия страниц при малом их кол-ве
                            } else {
                                ?>
                                <a href="<?= pagination('page', $nextPages) ?>" class="page">...</a>
                            <?php
                            }
                        }
                        // конец сокрыет последних страниц
                        ?>
                        <a href="<?= pagination('page', $countPages) ?>" class="page"><?= $countPages ?></a>
                    <?php
                    } else {
                        for ($i = 1; $i <= $countPages; $i++) {
                    ?>
                                <a href="<?= pagination('page', $i) ?>" class="page"><?= $i ?></a>
                            <?php
                            }
                    }
                    // конец пагинации

                    if ($countPages >= 2) {
                    ?>
                        <div class="pageChange">
                            <a href="
                                <?php
                                if (isset($_GET['page'])){
                                    $nextPage = $_GET['page'] + 1;
                                } else {
                                    $nextPage = 2;
                                }
                                
                                if ($nextPage <= $countPages) {
                                    echo pagination('page', $nextPage);
                                }
                                ?>
                            ">></a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php
            } else {
            ?>
                <div>Нет товаров</div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
