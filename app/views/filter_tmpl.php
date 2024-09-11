<?php
    include_once('./app/controllers/filter_ctrl.php');
?>

<form action="<?php $_SERVER['REQUEST_URI']?>" method="GET" id='form'>
    <?php
    foreach ($arMinMaxFields as $field) {
    ?>
        <div class="filterParametrWraper">
        <span class="filterUnitTitle"><?= $field['title'] ?></span>
        <div class="parametrWraper">
            <div class="parametr from">
                <input class="filterUnitValue" type="number" step="any" min="<?= $field['min'] ?>" max="<?= $field['max'] ?>" placeholder="от <?= $field['min'] ?>" name="<?= $field['name'] ?>[from]" value="<?= $_GET[$field['name']]['from'] ?>">
            </div>
            <div class="parametr to">
                <input class="filterUnitValue" type="number" step="any" min="<?= $field['min']?>" max="<?= $field['max'] ?>" placeholder="до <?= $field['max'] ?>" name="<?= $field['name'] ?>[to]" value="<?= $_GET[$field['name']]['to'] ?>">
            </div>
        </div>
    </div>
    <?php
    }
    ?>

    <div class="filterBrandWraper">
        <div class="filterUnitTitle">Бренд</div>
        <div class="brandList">
            
            <?php
            foreach ($arBrandsParams as $brandId => $arBrandCheck) {
            ?>
                <label class="filterBrandUnit <?= $arBrandCheck['Available'] ?>">
                    <input type="checkbox" name="filterBrands[]" value="<?= $brandId ?>"<?= $arBrandCheck['check'] ?>/>
                    <?= $arBrandCheck['name'] ?>
                    <br>
                </label>
            <?php
            }
            ?>

        </div>
    </div>
    <input class="show" type="submit" value="Показать">
</form>
