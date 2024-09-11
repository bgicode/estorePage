<?php
require_once('./core/handler.php');

foreach ($arBrandList as $brand) {
    $arBrandsNames[$brand['brand']] = read($pdo, 'SELECT DISTINCT name FROM brands WHERE brand_id = ' . $brand["brand"] . ';')[0]['name'];
}
