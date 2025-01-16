<?php
require_once ('templates/data.php');
require_once ('functions/db.php');
require_once ('functions/template.php');
require_once ('init.php');

$config = require 'configdb.php';
$connectionDB = dbConnect($config);
$newLots = getNewLotsFromDb($connectionDB);
$newLots = getAllCategoriesFromDb($connectionDB);


$mainContent = includeTemplate('main.php', [
    'categories' => $categories,
    'lots' => $lots,
]);

$layoutContent = includeTemplate('layout.php', [
    'content' => $mainContent,
    'title' => "Главная",
    'isAuth' => $isAuth,
    'userName' => $userName,
    'categories' => $categories,
]);

print($layoutContent);
