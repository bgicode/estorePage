<?php
function rangeQuery($getParam, $column)
{
    if (!empty($getParam['from']) && empty($getParam['to'])) {

        $isQueryCondition = true;
        $range = $column . " >= :$column" . "from AND ";
        $arPrepParams = [$column . 'from' => $getParam['from']];
        return [$isQueryCondition, $range, $arPrepParams];

    } elseif (!empty($getParam['to']) && empty($getParam['from'])) {

        $isQueryCondition = true;
        $range = $column . " <= :$column" . "to AND ";
        $arPrepParams = [$column . 'to' => $getParam['to']];
        return [$isQueryCondition, $range, $arPrepParams];

    } elseif (!empty($getParam['to']) && !empty($getParam['from'])) {

        $isQueryCondition = true;
        $range = $column . " BETWEEN :$column" . "from AND :$column" . "to AND ";
        $arPrepParams = [$column . 'from' => $getParam['from'], $column . 'to' => $getParam['to']];
        return [$isQueryCondition, $range, $arPrepParams];
    } 
    else {
        return [false, '', NULL];
    }
}

function cleanEpmtyGet()
{
    $parsedUrl = preg_replace('/.*\/|.*\?/', '', $_SERVER['REQUEST_URI']);
    $arQeryParams = explode("&", $parsedUrl);

    foreach ($arQeryParams as $key => $param) {
        if (substr($param, -1) == "=" ) {
            unset($arQeryParams[$key]);
        }
    }

    $QeryParams = implode("&", $arQeryParams);
    
    if ($QeryParams !== '') {
        $QeryParams = '?' . $QeryParams;
    }

    if (!empty($_SERVER['HTTPS'])) {
        $url = 'https';
    } else {
        $url = 'http';
    }

    $url .= '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . $QeryParams;

    return $url;
}

function pagination($getParam = NULL, $getParamValue = NULL)
{
    $parsedUrl = preg_replace('/.*\/|.*\?/', '', $_SERVER['REQUEST_URI']);
    parse_str($parsedUrl, $arQueryParams);
    $arQueryParams[$getParam] = $getParamValue;
    $QeryParams = http_build_query($arQueryParams);
    $QeryParams = '?' . $QeryParams;

    if (!empty($_SERVER['HTTPS'])) {
        $url = 'https';
    } else {
        $url = 'http';
    }
    $url .= '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . $QeryParams;

    return $url;
}
