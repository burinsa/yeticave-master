-- Добавление списка категорий

INSERT INTO categories(cat_name) 
VALUES
  ('Доски и лыжи'),
  ('Крепления'),
  ('Ботинки'),
  ('Одежда'),
  ('Инструменты'),
  ('Разное');

-- Добавление пользователей

INSERT INTO users (data_add, user_email, user_name, user_pass) 
VALUES
    (NOW(), 'ignat.v@gmail.com', 'Игнат', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'),
    (NOW(), 'kitty_93@li.ru', 'Леночка', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'),
    (NOW(), 'warrior07@mail.ru', 'Руслан', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW');

-- Список объявлений 

INSERT INTO lots (dt_add, lot_name, lot_desc, lot_img, lot_price, user_id, cat_id)
 VALUES
 (NOW(), '2014 Rossignol District Snowboard', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae', 'img/lot-1.jpg', 10999, 1, 1),
 (NOW(), 'DC Ply Mens 2016/2017 Snowboard', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae.', 'img/lot-2.jpg', 159999, 3, 1),
 (NOW(), 'Крепления Union Contact Pro 2015 года размер L/XL', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae.', 'img/lot-3.jpg', 8000, 2, 2),
 (NOW(), 'Ботинки для сноуборда DC Mutiny Charocal', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae', 'img/lot-4.jpg', 10999, 1, 3),
 (NOW(), 'Куртка для сноуборда DC Mutiny Charocal', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae.', 'img/lot-5.jpg', 7500, 3, 4),
 (NOW(), 'Маска Oakley Canopy', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae.', 'img/lot-6.jpg', 5400, 2, 6);


--  Ставки для объявлений

INSERT INTO rate (rate_date, rate_amount, user_id, lot_id)
 VALUES
 (DATE_SUB(NOW(), INTERVAL 3600 SECOND), 15000, 1, 1),
 (DATE_SUB(NOW(), INTERVAL 4568 SECOND), 10000, 2, 3),
 (DATE_SUB(NOW(), INTERVAL 1123 SECOND), 13000, 3, 1),
 (DATE_SUB(NOW(), INTERVAL 5631 SECOND), 8500, 2, 5),
 (DATE_SUB(NOW(), INTERVAL 7896 SECOND), 12000, 3, 4),
 (DATE_SUB(NOW(), INTERVAL 6699 SECOND), 9000, 3, 6);

-- добавление индекса

CREATE INDEX cat_name ON categories(cat_name);

CREATE INDEX dt_add ON lots(dt_add);

CREATE INDEX rate_date ON rate(rate_date);


-- Получение всех категорий 

SELECT * FROM categories;

-- Получить самые новые открытые лоты.

SELECT l.lot_name, l.lot_price, l.lot_img, COUNT(r.lot_id) AS count_rate, c.cat_name  FROM lots AS l
JOIN rate AS r ON l.lot_id = r.lot_id
JOIN categories AS c ON l.cat_id = c.cat_id
GROUP BY r.lot_id
ORDER BY l.lot_price DESC

-- Показать лот по его id

SELECT l.lot_id, l.lot_name, l.lot_price, c.cat_name AS category 
FROM lots AS l
JOIN categories AS c ON l.cat_id = c.cat_id
WHERE l.lot_id = 2;

-- Обновить название лота по id

UPDATE lots SET lot_name = 'Синхрофазатрон'
WHERE lot_id = 2;

-- Получить список свежих ставок лота по id

SELECT r.rate_id, r.rate_date, r.rate_amount, l.lot_name, u.user_name FROM rate AS r
JOIN lots AS l ON l.lot_id = r.lot_id
JOIN users AS u ON u.user_id = r.user_id
WHERE l.lot_id = 1
ORDER BY r.rate_amount DESC 
