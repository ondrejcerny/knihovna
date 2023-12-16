CREATE DATABASE knihovna_database;

CREATE TABLE uzivatele (
id INT NOT NULL auto_increment,
jmeno varchar(45) NOT NULL,
prijmeni varchar(45) NOT NULL,
adresa varchar(45) NOT NULL,
email varchar (45) NOT NULL,
rodne_cislo varchar(11) NOT NULL,
tel_cislo varchar(13) NOT NULL,
PRIMARY KEY (id),
UNIQUE (rodne_cislo)
);

CREATE TABLE katalog (
id INT NOT NULL primary key auto_increment,
nazev varchar (80) NOT NULL,
pocet INT(2) NOT NULL,
autor INT NOT NULL,
CONSTRAINT `autor1` FOREIGN KEY (`autor`) REFERENCES `autor` (`id`)
);

CREATE TABLE autor (
id INT primary key NOT NULL auto_increment,
jmeno varchar(30) NOT NULL,
prijmeni varchar(30) NOT NULL,
datum_narozeni DATE NOT NULL
);

CREATE TABLE autorstvi (
id INT primary key NOT NULL auto_increment,
id_kniha INT NOT NULL,
id_autor INT NOT NULL,
UNIQUE (id_kniha, id_autor),
CONSTRAINT `autorstvi_ibfk_1` FOREIGN KEY (`id_kniha`) REFERENCES `katalog` (`id`),
CONSTRAINT `autorstvi_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `autor` (`id`)
);

CREATE TABLE vypujceni (
id INT primary key NOT NULL auto_increment,
id_osoba INT NOT NULL,
id_kniha INT NOT NULL,
zacatek DATE NOT NULL,
konec DATE NOT NULL,
stav varchar(9) NOT NULL,
CONSTRAINT `vypujceni1` FOREIGN KEY (`id_osoba`) REFERENCES `uzivatele` (`id`),
CONSTRAINT `vypujceni2` FOREIGN KEY (`id_kniha`) REFERENCES `katalog` (`id`)
);


