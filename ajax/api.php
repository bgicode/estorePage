<?php
include_once(__DIR__ . '/../app/models/filter_model.php');
include_once(__DIR__ . '/../app/models/catalog_model.php');

$arExtremumsNew = read($pdo, "SELECT MIN(price) AS minprice, MAX(price) AS maxprice, MIN(weight) AS minweight, MAX(weight) AS maxweight, MIN(power) AS minpower, MAX(power) AS maxpower FROM stabilizers $queryCondition;", $arPrepParams);

$arBrandListGet = read($pdo, "SELECT DISTINCT brand FROM stabilizers $queryCondition;", $arPrepParams);

foreach ($arBrandListGet as $arBrandId) {
    $arBrandIdList[] = $arBrandId['brand'];
}

$arAllData = $arExtremumsNew;
$arAllData[] = $arBrandIdList;

echo(json_encode($arAllData, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
