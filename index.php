<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script src="./script.js" type="text/javascript"></script>
</head>
<body>
    <div class="mainWraper">
        <div class="filterWraper">
            <div class="filterWraperFix">
                <?php
                include_once('app/views/filter_tmpl.php');
                ?>
            </div>
        </div>
        <div class="goodsListWraper">
            <?php
            include_once('app/views/catalog_tmpl.php');
            ?>
        </div>
    </div>
</body>
</html>
