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

function rusTranslit($string)
{
    $converter = [
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',    'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    ];

    return strtr($string, $converter);
}
