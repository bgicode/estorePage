<?php
require_once('./core/handler.php');
require_once('./app/models/filter_model.php');

$arMinMaxFields = [
    [
        'title' => 'Цена',
        'name' => "price",
        'min' => $minPrice,
        'max' => $maxPrice
    ],
    [
        'title' => 'Мощность',
        'name' => "power",
        'min' => $minPower,
        'max' => $maxPower
    ],
    [
        'title' => 'Вес',
        'name' => "weight",
        'min' => $minWeight,
        'max' => $maxWeight
    ],
];

$arBrandsParams = [];
foreach ($arBrandList as $brand) {
    // foreach ($arBrandListGet as $brandGet) {
    //     if ($brandGet['brand'] != $brand['brand']) {
    //         $arBrandsParams[$brand['brand']]['Available'] = 'notAvailable';
    //     } else {
    //         $arBrandsParams[$brand['brand']]['Available'] = 'Available';
    //         break;
    //     }
    // }
    if (isset($_GET['filterBrands'])) {
        if (in_array($brand['brand'], $_GET['filterBrands'])) {
            $arBrandsParams[$brand['brand']]['check'] = ' checked';
        } else {
            $arBrandsParams[$brand['brand']]['check'] = '';
        }
    } else {
        $arBrandsParams[$brand['brand']]['check'] = '';
    }
    $arBrandsParams[$brand['brand']]['name'] = $arBrandsNames[$brand['brand']];
}
