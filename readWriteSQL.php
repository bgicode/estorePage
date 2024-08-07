<?php
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=sqltask',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo "Невозможно установить соединение с базой данных";
}

function read($pdo, $query, $arPrepParams = NULL): mixed
{
    try {
        $tab = $pdo->prepare($query);
        $tab->execute($arPrepParams);
        $arReadingLines = $tab->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Ошибка выполнения запроса: " . $e->getMessage();
    }

    return $arReadingLines;
}

function Write(array $arPrepParams, $query, $pdo): mixed
{
    try {
        $write = $pdo->prepare($query);
        $write->execute($arPrepParams);
    } catch (PDOException $e) {
        echo "Ошибка выполнения запроса: " . $e->getMessage();
        return false;
    }

    return $write;
}
