CREATE TABLE categories (
  cat_id    INT AUTO_INCREMENT PRIMARY KEY,
  cat_name  VARCHAR(64)
);

INSERT INTO categories(cat_name) 
VALUE 
  ('Доски и лыжи'),
  ('Крепления'),
  ('Ботинки'),
  ('Одежда'),
  ('Инструменты'),
  ('Разное');

CREATE TABLE lots (
  lot_id  INT AUTO_INCREMENT PRIMARY KEY,
  dt_add DATETIME,
  lot_name VARCHAR(128),
  lot_desc TEXT,
  lot_img VARCHAR(128),
  lot_price INT,
  lot_date DATETIME,
  lot_step INT,
  count_fav INT,
  user_id INT,
  id_win INT,
  cat_id INT
);

CREATE TABLE rate (
  rate_id INT AUTO_INCREMENT PRIMARY KEY,
  rate_date DATETIME,
  rate_amount INT,
  user_id INT,
  lot_id INT
);

CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  data_add DATETIME,
  user_email VARCHAR(128)  UNIQUE,
  user_name VARCHAR(128),
  user_pass VARCHAR(64),
  user_avatar VARCHAR(128),
  user_contacts VARCHAR(128)
);

CREATE FULLTEXT INDEX search_lots 
ON lots(lot_name, lot_desc);

