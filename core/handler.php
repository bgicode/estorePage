<?php
require_once('readWriteSQL.php');
require_once('functions.php');

ini_set('display_errors', 'off');
error_reporting(0);

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

$arBrandListGet = read($pdo, "SELECT DISTINCT brand FROM stabilizers $queryCondition;", $arPrepParams);

