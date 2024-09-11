<?php
require_once('./core/handler.php');

$arHowMuchToShow = [];

if ($CountRecords > 3) {
    $arHowMuchToShow[] = 3;
}
if ($CountRecords > 5) {
    $arHowMuchToShow[] = 5;
}
if ($CountRecords > 7) {
    $arHowMuchToShow[] = 7;
}
if ($CountRecords > 10) {
    $arHowMuchToShow[] = 10;
}

$arPagination = [];

if ($countPages >= 2) {

    if (isset($_GET['page'])){
        $previousPage = $_GET['page'] - 1;
    } else {
        $previousPage = $countPages;
    }
    
    if ($previousPage >= 1) {
        $arPagination['<'] = $previousPage;
    }
}
// Начало пагинации, сокрытие страниц при их количестве больше 9
if ($countPages > 9) {
    $arPagination['1'] = 1;
    // начало символ сокрытия страниц
    if (isset($_GET['page'])) {
        if ($_GET['page'] >= 6) {
            $pageNumber = $_GET['page'] - 3;
            $arPagination['before'] = $pageNumber;
            $afterHidenPageStart = true;
        }
    }
    // конец символ сокрытия страниц
    // начало последнии 4 страницы после сокрытия
    if (($countPages - $_GET['page']) <= 4) {
        for ($i = 0; $i < 4; $i++) {
            $pageNumber = $countPages - 4 + $i;
            $arPagination[$pageNumber] = $pageNumber;
        }
    } else {
    // конец последнии 4 страницы после сокрытия
    // начало дин блок из 4 страниц
        for ($i = 0; $i < 4; $i++) {
            if (!$afterHidenPageStart) {
                $pageNumber = $i + 2;
                $arPagination[$pageNumber] = $pageNumber;
            } else {
                $pageNumber = $_GET['page'] + $i;
                $arPagination[$pageNumber] = $pageNumber;
            }
        }
    }
    // конец дин блок из 4 страниц
    // начало сокрыет последних страниц
    if ($countPages > 9 && ($countPages - $_GET['page']) > 4) {
        if (isset($_GET['page'])) {
            if (!$afterHidenPageStart && $_GET['page'] < 6) {
                $nextPages = 6;
            } elseif ($_GET['page'] == 1) {
                $nextPages = $_GET['page'] + 6;
            } else {
                $nextPages = $_GET['page'] + 3;
            }
        } else {
            $nextPages = 6;
        }
        // начало показать страницы если их мало для скрытия
        $endPagesCount = $countPages - $_GET['page'] - 4;
        if ($endPagesCount <= 1) {
            for($i = 0; $i < $endPagesCount; $i++) {
                $pageNumber = $countPages - $endPagesCount + $i;
                $arPagination[$pageNumber] = $pageNumber; 
            }
        // конец показать страницы если их мало для скрытия
        } else {
            $arPagination['after'] = $nextPages;
        }
    }
    // конец сокрыет последних страниц
    $arPagination[$countPages] = $countPages;
} else {
    for ($i = 1; $i <= $countPages; $i++) {
        $arPagination[$i] = $i;
    }
}
// конец пагинации

if ($countPages >= 2) {

    if (isset($_GET['page'])){
        $nextPage = $_GET['page'] + 1;
    } else {
        $nextPage = 2;
    }
    
    if ($nextPage <= $countPages) {
        $arPagination['>'] = $nextPage;
    }
}
