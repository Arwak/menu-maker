
DROP DATABASE IF EXISTS MenuMaker;
CREATE DATABASE MenuMaker;
USE MenuMaker;

CREATE TABLE dish (

    id_dish INT AUTO_INCREMENT,
    alias VARCHAR(255) UNIQUE,
    cost_price FLOAT,
    benefits FLOAT,
    net_price FLOAT,
    course_pos INT,
    tag TEXT,
    PRIMARY KEY (id_dish)
);

CREATE TABLE menu (

	id_menu INT AUTO_INCREMENT,
    alias TEXT,
    full_price FLOAT,
    first_course_price FLOAT,
    second_course_price FLOAT,
    PRIMARY KEY (id_menu)

);

CREATE TABLE allergen (

	id_allergen INT AUTO_INCREMENT,
    allergen_name TEXT,
    PRIMARY KEY (id_allergen)
);



CREATE TABLE language (

	id_language INT AUTO_INCREMENT,
    language_name TEXT,
    PRIMARY KEY (id_language)

);

CREATE TABLE dish_language (

	id_dish INT,
    id_language INT,
    dish_name TEXT,
    dish_description TEXT,
    PRIMARY KEY (id_dish, id_language),
    FOREIGN KEY (id_dish) REFERENCES dish (id_dish)  ON DELETE CASCADE,
    FOREIGN KEY (id_language) REFERENCES language (id_language) ON DELETE CASCADE

);



CREATE TABLE dish_allergen (

	id_dish INT,
    id_allergen INT,
    PRIMARY KEY (id_dish, id_allergen),
    FOREIGN KEY (id_dish) REFERENCES dish (id_dish) ON DELETE CASCADE,
    FOREIGN KEY (id_allergen) REFERENCES allergen (id_allergen) ON DELETE CASCADE

);


CREATE TABLE menu_language (

    id_language INT,
    id_menu INT,
    full_menu_name TEXT,
    first_course_menu_name TEXT,
    second_course_menu_name TEXT,
    description TEXT,

    PRIMARY KEY (id_menu, id_language),
    FOREIGN KEY (id_menu) REFERENCES menu (id_menu) ON DELETE CASCADE,
    FOREIGN KEY (id_language) REFERENCES language (id_language) ON DELETE CASCADE
);

CREATE TABLE menu_dish (

	  id_dish INT,
    id_menu INT,
    PRIMARY KEY (id_dish, id_menu),
    FOREIGN KEY (id_menu) REFERENCES menu (id_menu) ON DELETE CASCADE,
    FOREIGN KEY (id_dish) REFERENCES dish (id_dish) ON DELETE CASCADE

);

CREATE TABLE photo (

    id_dish INT,
    path TEXT,
    PRIMARY KEY (id_dish),
    FOREIGN KEY (id_dish) REFERENCES dish (id_dish) ON DELETE CASCADE

);

INSERT INTO language(language_name) VALUES ('Català');
INSERT INTO language(language_name) VALUES ('Español');
INSERT INTO language(language_name) VALUES ('English');
INSERT INTO allergen(allergen_name) VALUES ('Gluten');
INSERT INTO allergen(allergen_name) VALUES ('Soja');
INSERT INTO allergen(allergen_name) VALUES ('Sésam');
INSERT INTO allergen(allergen_name) VALUES ('Crustàci');
INSERT INTO allergen(allergen_name) VALUES ('Làctics');
INSERT INTO allergen(allergen_name) VALUES ('Tramussos');
INSERT INTO allergen(allergen_name) VALUES ('Ou');
INSERT INTO allergen(allergen_name) VALUES ('Fruits amb closca');
INSERT INTO allergen(allergen_name) VALUES ('Mol·luscs');
INSERT INTO allergen(allergen_name) VALUES ('Peix');
INSERT INTO allergen(allergen_name) VALUES ('Api');
INSERT INTO allergen(allergen_name) VALUES ('Diòxid de sofre i sulfits');
INSERT INTO allergen(allergen_name) VALUES ('Cacauet');
INSERT INTO allergen(allergen_name) VALUES ('Mostassa');