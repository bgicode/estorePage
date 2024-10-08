<?php
require_once('readWriteSQL.php');
require_once('functions.php');

if (!empty($_GET)
    && preg_match("/=&|=$/", $_SERVER['REQUEST_URI'])
) {
    header('Location: ' . cleanEpmtyGet());
    exit;
}

$arExtremums = read($pdo, "SELECT MIN(price) AS minPrice, MAX(price) AS maxPrice, MIN(weight) AS minWeight, MAX(weight) AS maxWeight, MIN(power) AS minPower, MAX(power) AS maxPower FROM stabilizers;");

$minPrice = $arExtremums[0]['minPrice'];
$maxPrice = $arExtremums[0]['maxPrice'];

$minPower = $arExtremums[0]['minPower'];
$maxPower = $arExtremums[0]['maxPower'];

$minWeight = $arExtremums[0]['minWeight'];
$maxWeight = $arExtremums[0]['maxWeight'];

if (isset($_GET["countShow"])) {
    $countShow = $_GET['countShow'];
} else {
    $countShow = 3;
}

$isQueryCondition = false;

$rangePrice = "";
$queryCondition = "";
$rangePower = "";
$brandsCondition = "";
$rangeWeight = "";
$arPrepParamsPrice = [];
$arPrepParamsPower = [];
$arPrepParamsWeight = [];
$arPrepParamsBrands = [];
$arPrepParams = NULL;

if(!empty($_GET['price']['from']) || !empty($_GET['price']['to'])) {
    $rangePrice = rangeQuery($_GET['price'], 'price')[1];
    $isQueryCondition = rangeQuery($_GET['price'], 'price')[0];
    $arPrepParamsPrice = rangeQuery($_GET['price'], 'price')[2];
}

if(!empty($_GET['power']['from']) || !empty($_GET['power']['to'])) {
    $rangePower = rangeQuery($_GET['power'], 'power')[1];
    $isQueryCondition = rangeQuery($_GET['power'], 'power')[0];
    $arPrepParamsPower = rangeQuery($_GET['power'], 'power')[2];
}

if(!empty($_GET['weight']['from']) || !empty($_GET['weight']['to'])) {
    $rangeWeight = rangeQuery($_GET['weight'], 'weight')[1];
    $isQueryCondition = rangeQuery($_GET['weight'], 'weight')[0];
    $arPrepParamsWeight = rangeQuery($_GET['weight'], 'weight')[2];
}

$arBrandList = read($pdo, "SELECT DISTINCT brand FROM stabilizers;");

if (isset($_GET['filterBrands'])) {
    $isQueryCondition = true;
    $brandsCondition = "(brand = ";
    $brandItter = 0;
    foreach ($_GET['filterBrands'] as $brand) {
        if ($brandItter == 0) {
            $brandsCondition .= ":brand" . (string)$brand;
        } else {
            $brandsCondition .= " OR brand = :brand" . (string)$brand;
        }
        $brandItter++;
        $arPrepParamsBrands["brand" . (string)$brand] = $brand;
    }
    $brandsCondition .= ") AND ";
}

if ($isQueryCondition) {
    $queryCondition = "WHERE " . $rangePrice . $brandsCondition . $rangePower . $rangeWeight;
    $arPrepParams = [];
    $arPrepParams = $arPrepParamsPrice + $arPrepParamsPower + $arPrepParamsWeight + $arPrepParamsBrands;
}

$queryCondition = preg_replace('/\sAND\s?$/', '', $queryCondition);

$arBrandListGet = read($pdo, "SELECT DISTINCT brand FROM stabilizers $queryCondition;", $arPrepParams);

$CountRecords = read($pdo, "SELECT COUNT(*) AS count FROM stabilizers $queryCondition", $arPrepParams)[0]['count'];

if (isset($_GET["page"])) {
    if ($countShow == $CountRecords) {
        $queryRecords = "SELECT name, price, power, weight, model FROM stabilizers JOIN brands ON brand = brand_id $queryCondition LIMIT 0,$countShow;";
    } else {
        $showStart = ((integer)$_GET["page"] - 1) * $countShow;
        $queryRecords = "SELECT name, price, power, weight, model FROM stabilizers JOIN brands ON brand = brand_id $queryCondition LIMIT $showStart,$countShow;";
    }
} else {
    $queryRecords = "SELECT name, price, power, weight, model FROM stabilizers JOIN brands ON brand = brand_id $queryCondition LIMIT 0,$countShow;";
}

$arAllRecords = read($pdo, $queryRecords, $arPrepParams);
$countPages = ceil($CountRecords / $countShow);
