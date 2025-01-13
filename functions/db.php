<?php
/**
* Подключение к базе данных
* @param array $config Настройки подключения
* @return mysqli|bool Возваращемый тип данных
*/
function dbConnect(array $config):mysqli|bool
{
    if (!isset($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['database'])) {
    exit;
    }
    $dbConfig = $config['db'];

    $con = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['database']);


    if (!$con) {
        echo "Подключения к базе данных не установлено";
        exit("Connection error: " . mysqli_connect_error());
    } else {
        echo "Подключения к базе данных установлено";
    }

mysqli_set_charset($con, "utf8");
return $con;
}
//  Запрос на получение новых лотов
function getNewLotsFromDb(mysqli $con)
{
    $sql = "SELECT l.id, l.title, l.start_price, l.image_url, c.name AS category_name, r.amount AS current_price, l.created_at
FROM lots l
       JOIN categories c ON c.id = l.category_id
       LEFT JOIN rates r ON r.lot_id = l.id
       WHERE l.ended_at > NOW()
GROUP BY l.id, l.title, l.start_price, l.image_url, c.name, current_price
ORDER BY l.created_at DESC
LIMIT 3;";

    $result = mysqli_query($con, $sql);

    if (!$result) {
        $error = mysqli_error($con);
        print("SQL Error: $error");
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

//  Запрос на получения всех категорий
function getAllCategoriesFromDb(mysqli $con)
{
    $sql = "SELECT * FROM categories;";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        $error = mysqli_error($con);
        print("SQL Error: $error");
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
