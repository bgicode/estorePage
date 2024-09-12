<?php
require_once('./core/handler.php');

$arExtremums = read($pdo, "SELECT MIN(price) AS minPrice, MAX(price) AS maxPrice, MIN(weight) AS minWeight, MAX(weight) AS maxWeight, MIN(power) AS minPower, MAX(power) AS maxPower FROM stabilizers;");

$minPrice = $arExtremums[0]['minPrice'];
$maxPrice = $arExtremums[0]['maxPrice'];

$minPower = $arExtremums[0]['minPower'];
$maxPower = $arExtremums[0]['maxPower'];

$minWeight = $arExtremums[0]['minWeight'];
$maxWeight = $arExtremums[0]['maxWeight'];

$arBrandList = read($pdo, "SELECT DISTINCT brand FROM stabilizers;");

$arBrandListGet = read($pdo, "SELECT DISTINCT brand FROM stabilizers $queryCondition;", $arPrepParams);

foreach ($arBrandList as $brand) {
    $arBrandsNames[$brand['brand']] = read($pdo, 'SELECT DISTINCT name FROM brands WHERE brand_id = ' . $brand["brand"] . ';')[0]['name'];
}
