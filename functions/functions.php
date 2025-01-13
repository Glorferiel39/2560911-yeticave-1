<?php
/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 * @return string Итоговый HTML
 */


/**
 *Форматирует время лота
 *@param string $data
 *@return array
 */
function remainingTime(string $date): array
{
    $timeDifference = strtotime($date) - time();
    if ($timeDifference<=0){
        return [0,0];

    }
    $hours = floor($timeDifference / 3600);
    $minutes = floor(($timeDifference / 3600) % 60);

    return [$hours, $minutes];
}

/**
 * Форматирует cумму лота и добавляет знак рубля
 * @param int|float $price
 * @return string
 */
function formatAmount(int|float $price): string
{
    $price = number_format($price, 0, '.', ' ');
    return $price . ' ₽';
}


