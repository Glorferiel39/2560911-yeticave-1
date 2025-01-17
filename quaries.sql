/*Добавление данных в таблицу категории*/
INSERT INTO categories (name, symbol_code) 
VALUES ('Доски и лыжи', 'boards'),
       ('Крепления', 'attachment'),
       ('Ботинки', 'boots'),
       ('Одежда', 'clothing'),
       ('Инструменты', 'tools'),
       ('Разное', 'other');

/*Добавление данных в таблицу users*/
INSERT INTO users (email, name, passw, contacts)
VALUES ('dmitriyivanov123@list.ru', 'Dmitriy Ivanov', 'ivanov1992', '89313673295'),
       ('ivanaksenov2000@gmail.com', 'Ivan Aksenov', 'aaksenov08', '89313576231');
/*Добавление данных в таблицу lots*/
INSERT INTO lots (title, image_url, start_price, ended_at, rate_step, author_id, category_id)
VALUES ('2014 Rossignol District Snowboard', 'img/lot-1.jpg', 10999, '2024-12-27', 100, 1, 1),
       ('DC Ply Mens 2016/2017 Snowboard', 'img/lot-2.jpg', 159999, '2024-12-20', 100, 1, 1),
       ('Крепления Union Contact Pro 2015 года размер L/XL', 'img/lot-3.jpg', 8000, '2024-12-21', 100, 2, 2),
       ('Ботинки для сноуборда DC Mutiny Charocal', 'img/lot-4.jpg', 10999, '2024-12-18', 100, 2, 3),
       ('Куртка для сноуборда DC Mutiny Charocal', 'img/lot-5.jpg', 7500, '2024-12-18', 100, 1, 4),
       ('Маска Oakley Canopy', 'img/lot-6.jpg', 5400, '2024-12-22', 100, 2, 6);

/*Добавление данных в таблицу rates*/
INSERT INTO rates (amount, user_id, lot_id) VALUES (6000, 1, 5);
INSERT INTO rates (amount, user_id, lot_id) VALUES (3000, 2, 6);

/*Запрос на получение всех категорий*/
SELECT * FROM categories;

/*Запрос на получение самых новых, открытых лотов. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории*/
SELECT l.id, l.title, l.start_price, l.image_url, c.name AS category_name,
       COALESCE(MAX(r.amount), l.start_price) AS current_price
FROM lots l
       JOIN categories c ON c.id = l.category_id
       LEFT JOIN rates r ON r.lot_id = l.id
WHERE l.ended_at > NOW()
GROUP BY l.id, l.title, l.start_price, l.image_url, c.name
ORDER BY l.created_at DESC;

/*Запрос на показ лота по его ID. Получите также название категории, к которой принадлежит лот*/
SELECT l.id, c.name
FROM lots l
       INNER JOIN categories c ON c.id = l.category_id
WHERE l.id = 3;

/*Запрос по обновлению названия лота по его идентификатору;*/
UPDATE lots
SET title = 'Куртка Райана Гослинга'
WHERE id = 5;

/*Запрос на получение списка ставок для лота по его идентификатору с сортировкой по дате*/
SELECT r.id, r.сreated_at, r.amount, l.title
FROM rates r
INNER JOIN lots l ON l.id = r.lot_id
WHERE l.id = 5
ORDER BY r.сreated_at DESC;
