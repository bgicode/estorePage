
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
                    <select onfocus="this.size=5;" onblur="this.size=0;" onchange="this.size=1; this.blur()">
                        <option >показать <?=$countShow ?> товаров на странице </option>
                        <option value="5">5</option>
                        <option value="7">7</option>
                        <option value="10">10</option>
                        <option value="<?= $CountRecords ?>">всё</option>
                    </select>
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
                    <div class="pageChange">
                        <a href="
                            <?php
                            if (isset($_GET['page'])){
                                $previousPage = $_GET['page'] - 1;
                            } else {
                                $previousPage = ceil($CountRecords / $countShow);
                            }
                            
                            if ($previousPage >= 1) {
                                echo pagination('page', $previousPage);
                            }
                            ?>
                        "><</a>
                    </div>
                    <?php
                    for ($i = 1; $i <= ceil($CountRecords / $countShow); $i++) {
                    ?>
                        <a href="<?= pagination('page', $i) ?>" class="page"><?= $i ?></a>
                    <?php
                    }
                    ?>
                    <div class="pageChange">
                        <a href="
                            <?php
                            if (isset($_GET['page'])){
                                $nextPage = $_GET['page'] + 1;
                            } else {
                                $nextPage = 2;
                            }
                            
                            if ($nextPage <= ceil($CountRecords / $countShow)) {
                                echo pagination('page', $nextPage);
                            }
                            ?>
                        ">></a>
                    </div>
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
