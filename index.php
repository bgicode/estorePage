
<?php
require_once('handler.php');

ini_set('display_errors', 'off');
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
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
        <form action="<?php $_SERVER['REQUEST_URI']?>" method="GET" id='form'>

            
            <div class="filterParametrWraper">
                <span class="filterUnitTitle">Цена</span>
                <div class="parametrWraper">
                    <div class="parametr priceFrom">
                        <input class="filterUnitValue" type="number" step="any" min="<?= $minPrice?>" max="<?= $maxPrice?>" placeholder="<?= $minPrice?>" name="price[from]" value="<?= $_GET['price']['from'] ?>">
                    </div>
                    <div class="parametr priceTo">
                        <input class="filterUnitValue" type="number" step="any" min="<?= $minPrice?>" max="<?= $maxPrice?>" placeholder="<?= $maxPrice?>" name="price[to]" value="<?= $_GET['price']['to'] ?>">
                    </div>
                </div>
            </div>

            <div class="filterParametrWraper">
                <span class="filterUnitTitle">Мощность</span>
                <div class="parametrWraper">
                    <div class="parametr powerFrom">
                        <input class="filterUnitValue" type="number" step="any" min="<?= $minPower?>" max="<?= $maxPower?>" placeholder="<?= $minPower?>" name="power[from]" value="<?= $_GET['power']['from'] ?>">
                    </div>
                    <div class="parametr powerTo">
                        <input class="filterUnitValue" type="number" step="any" min="<?= $minPower?>" max="<?= $maxPower?>" placeholder="<?= $maxPower?>" name="power[to]" value="<?= $_GET['power']['to'] ?>">
                    </div>
                </div>
            </div>

            <div class="filterParametrWraper">
                <span class="filterUnitTitle">Вес</span>
                <div class="parametrWraper">
                    <div class="parametr weightFrom">
                        <input class="filterUnitValue" type="number" step="any" min="<?= $minWeight?>" max="<?= $maxWeight?>" placeholder="<?= $minWeight?>" name="weight[from]" value="<?= $_GET['weight']['from'] ?>">
                    </div>
                    <div class="parametr powerTo">
                        <input class="filterUnitValue" type="number" step="any" min="<?= $minWeight?>" max="<?= $maxWeight?>" placeholder="<?= $maxWeight?>" name="weight[to]" value="<?= $_GET['weight']['to'] ?>">
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
                                    if ($brandGet['name'] != $brand['name']) {
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
                            <input type="checkbox" name="filterBrands[]" value="<?= $brand['name'] ?>"
                                <?php
                                if (isset($_GET['filterBrands'])) {
                                    if (in_array($brand['name'], $_GET['filterBrands'])) {
                                        echo 'checked';
                                    }
                                } 
                                ?>
                            /><?= $brand['name'] ?><br />
                        </label>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <input class="show" type="submit" value="Показать">
        </form>
    </div>
    <div class="goodsListWraper">
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
                for($i = 1; $i <= ceil($CountRecords / $countShow); $i++) {
            ?>
                    <a href="" class="page" onclick="updateURLParameter('page', <?= $i ?>); return false;"><?= $i ?></a>
            <?php
                }
            ?>
        </div>
    </div>

    </div>
    
    <pre>
        <?php
        // var_dump($CountRecords);
        // echo '<br>';

        // echo($queryRecords);
        // echo '<br>';
        // print_r($_GET);
        // echo '<br>';

        // echo ($_SERVER['REQUEST_URI']);
        //     var_dump($CountRecords);
        //     print_r($arBrandListGet);
        //     foreach ($arBrandListGet as $brandGet) {
        //         echo $brandGet['name'];
        //     }
        ?>
    </pre>
    <div></div>
</body>
</html>