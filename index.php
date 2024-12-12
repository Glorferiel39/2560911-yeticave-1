<?php 
require_once ('templates\data.php');
require_once ('helpers.php');

$main_content = include_template('main.php', [
    'categories' => $categories,
    'lots' => $lots,
]);

$layout_content = include_template('layout.php', [
    'content' => $main_content,
    'title' => "Главная",
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'categories' => $categories,
]);

print($layout_content);
?>
