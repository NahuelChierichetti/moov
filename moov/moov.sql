DROP DATABASE IF EXISTS moov;
CREATE DATABASE moov;

USE moov;

CREATE TABLE tipo_usuarios (
    tipo_usuarios_id   TINYINT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    tipo               VARCHAR(80)                 NOT NULL
) ENGINE = innoDB;

INSERT INTO tipo_usuarios (tipo_usuarios_id, tipo) VALUES
    (1, 'admin'),
    (2, 'comun');

CREATE TABLE usuarios (
	usuarios_id		     INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	nombre               VARCHAR(80)                 NOT NULL,
    apellido             VARCHAR(80),
    email                VARCHAR(100)                NOT NULL UNIQUE,
	usuario 		     VARCHAR(60)				 NOT NULL UNIQUE,
	password		     VARCHAR(255)			     NOT NULL,
    tipo_usuarios_id_fk  TINYINT UNSIGNED            NOT NULL,
	
    FOREIGN KEY (tipo_usuarios_id_fk) REFERENCES tipo_usuarios (tipo_usuarios_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = innoDB;

INSERT INTO usuarios VALUES
	(1, 'Tamara', 'Rodríguez Manzanero', 'tamara.rodriguezm@davinci.edu.ar', 'tamara.rodman', '$2y$10$wYoOYsMDL5yzl6WLB.5SE.vPriNl3P2HWFb0FYQyC5Sg/NBR4ZhT.', 1),
    (2, 'Nahuel', 'Chierichietti',  'nahuel.chierichetti@davinci.edu.ar', 'nahuel.chieri', '$2y$10$Yu7vblwT8QluRVPqYY7Ht.fiefAf2gfqRMeYKD43r1Bt6R2kOUNCa', 1);

CREATE TABLE monedas (
    monedas_id     TINYINT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    moneda         VARCHAR(80)                 NOT NULL,
    detalle        VARCHAR(255)                NOT NULL 
) ENGINE = innoDB;

INSERT INTO monedas VALUES
    (1, '$', 'Peso argentino'),
    (2, 'U$D', 'Dólar'),
    (3, '€', 'Euro');

CREATE TABLE productos (
    productos_id      INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre            VARCHAR(80)                 NOT NULL,
    descripcion       VARCHAR(400)                NOT NULL,
    precio            FLOAT(8,2)				  NOT NULL,
    stock             INT UNSIGNED                DEFAULT 0,
    imagen            VARCHAR(80),              
    destacado         TINYINT UNSIGNED DEFAULT 0,
    monedas_id_fk     TINYINT UNSIGNED            NOT NULL,

    FOREIGN KEY (monedas_id_fk) REFERENCES monedas (monedas_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = innoDB;

INSERT INTO productos VALUES
    (1, 'Nike Air Max Axis', 'Zapatillas Nike Air Max Axis', 12799.00, 50, 'air-max-axis-min.jpg', 1, 1),
    (2, 'Adidas 8k 2020', 'Zapatillas Adidas 8k 2020', 9599.00, 50,'8k-2020-min.jpg', 0, 1),
    (3, 'Nike Air Max Command', 'Zapatillas Nike Air Max', 10399.00, 50,'air-max-command-min.jpg', 1, 1),
    (4, 'Nike Downshifter 10', 'Zapatillas Nike Downshifter', 8499.00, 0,'downshifter-10-min.jpg', 0, 1),
    (5, 'Adidas Eq21 Run', 'Zapatillas Adidas Eq21 Run', 13799.00, 50,'eq21-run-min.jpg', 1, 1),
    (6, 'Asics Gel Nagoya 2', 'Zapatillas Asics Gel Nagoya 2', 14999.00, 50,'gel-nagoya-2-min.jpg', 1, 1),
    (7, 'Asics Patriot', 'Zapatillas Asics Patriot', 13799.00, 25,'patriot-min.jpg', 0, 1),
    (8, 'Adidas Supernova', 'Zapatillas Adidas Supernova', 18299.00, 25,'supernova-min.jpg', 0, 1),
    (9, 'Asics Gel Nagoya 3', 'Zapatillas Asics Gel Nagoya 3', 14999.00, 25,'gel-nagoya-3-min.jpg', 1, 1),
    (10, 'Adidas SL20', 'Zapatillas Adidas SL20', 7499.00, 0,'sl20-min.jpg', 0, 1),
    (11, 'Asics Patriot 1', 'Zapatillas Asics Patriot 1', 16199.00, 25,'patriot-1-min.jpg', 1, 1),
    (12, 'Adidas QT Racer', 'Zapatillas Adidas QT Racer Sport', 11099.00, 25,'qt-racer-sport-min.jpg', 0, 1);

CREATE TABLE categorias (
    categorias_id   INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    categoria       VARCHAR(80)                  NOT NULL
) ENGINE = innoDB;

INSERT INTO categorias VALUES
    (1, 'Nike'),
    (2, 'Adidas'),
    (3, 'Asics');

CREATE TABLE productos_tienen_categorias (
    productos_categorias_id   INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    productos_id_fk           INT UNSIGNED                    NOT NULL,
    categorias_id_fk          INT UNSIGNED                    NOT NULL,

    FOREIGN KEY (productos_id_fk) REFERENCES productos (productos_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (categorias_id_fk) REFERENCES categorias (categorias_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = innoDB;

INSERT INTO productos_tienen_categorias VALUES
    (1, 1, 1),
    (2, 2, 2),
    (3, 3, 1),
    (4, 4, 1),
    (5, 5, 2),
    (6, 6, 3),
    (7, 7, 3),
    (8, 8, 2),
    (9, 9, 3),
    (10, 10, 2),
    (11, 11, 3),
    (12, 12, 2);

CREATE TABLE comentarios (
    comentarios_id  INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    fecha           DATE                        NOT NULL,
    puntuacion      TINYINT DEFAULT 1,
    comentario      VARCHAR(200)                NOT NULL,
    usuarios_id_fk  INT UNSIGNED                NOT NULL,
    productos_id_fk INT UNSIGNED,

    FOREIGN KEY (productos_id_fk) REFERENCES productos (productos_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (usuarios_id_fk) REFERENCES usuarios (usuarios_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = innoDB;

INSERT INTO comentarios VALUES 
    (1, '2021-04-05', null, 'Llegarón en buen estado', 2, 2),
    (2, '2021-01-19', null, 'Me encantaron las zapatillas', 1, 3);


CREATE TABLE estado_compras (
	estado_id 	TINYINT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	estado 		VARCHAR(45) 				    NOT NULL
) ENGINE = innoDB;

INSERT INTO estado_compras VALUES
	(1, 'Confirmada'),
    (2, 'Pendiente de envío'),
    (3, 'En camino'),
    (4, 'Entregado'),
    (5, 'Rechazada');

CREATE TABLE compras (
	compras_id 		INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	fecha_compra 	DATETIME					NOT NULL,
	Total			FLOAT(8,2)					NOT NULL,
	usuarios_id_fk  INT UNSIGNED                NOT NULL,
    estado_id_fk 	TINYINT UNSIGNED DEFAULT 1,
    
    FOREIGN KEY (estado_id_fk) REFERENCES estado_compras (estado_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (usuarios_id_fk) REFERENCES usuarios (usuarios_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = innoDB;

INSERT INTO compras VALUES
	(1, '2021-03-07', 9599.00, 2, 4),
    (2, '2021-01-18', 10399.00, 1, 4);

CREATE TABLE compras_tienen_productos (
    compra_prod_id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    compras_id_fk   INT UNSIGNED                NOT NULL,
    productos_id_fk INT UNSIGNED                NOT NULL,
    precio         FLOAT(6, 2),

    FOREIGN KEY (compras_id_fk) REFERENCES compras (compras_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (productos_id_fk) REFERENCES productos (productos_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = innoDB;

INSERT INTO compras_tienen_productos VALUES 
    (1, 1, 2, 9599.00),
    (2, 2, 3, 10399.00);