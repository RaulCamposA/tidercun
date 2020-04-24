CREATE DATABASE tindercun;

USE tindercun;

-- TABLE USER
-- all pasword wil be encrypted using SHA1
CREATE TABLE users (
  id INT(11) NOT NULL,
  username VARCHAR(16) NOT NULL,
  password VARCHAR(60) NOT NULL,
  fullname VARCHAR(100) NOT NULL,
  puesto VARCHAR(50),
  escuela VARCHAR(50),
  ciudad VARCHAR(60),
  id_sexo INT(11),
  about_us VARCHAR(255)
);

CREATE TABLE sexo(
  id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  sexo VARCHAR(6)
);


INSERT INTO sexo (sexo) 
  VALUES ('Hombre');

INSERT INTO sexo (sexo) 
  VALUES ('Mujer');

ALTER TABLE users
  ADD PRIMARY KEY (id);

ALTER TABLE users
  MODIFY id INT(11) NOT NULL AUTO_INCREMENT;

DESCRIBE users;

SELECT * FROM users;

CREATE TABLE picture(
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR (255),
  imagen LONGBLOB NOT NULL
);


CREATE TABLE usuario_picture(
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_user INT(11),
  id_picture LONGBLOB NOT NULL
);


CREATE TABLE lke(
  id INT(11) NOT NULL PRIMARY KEY,
  id_user1 INT(11),
  id_user2 INT(11),
  like1 BOOLEAN,
  like2 BOOLEAN
);

CREATE TABLE tmatch(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_user1 INT(11),
    id_user2 INT(11)
);

-- INSERT INTO users (id, username, password, fullname) 
--   VALUES (1, 'john', 'password1', 'John Carter');


-- *////////////////////////////////////////////////////////////*