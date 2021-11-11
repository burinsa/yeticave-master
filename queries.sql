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

