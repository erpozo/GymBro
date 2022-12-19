drop database if exists gymbro;
create database gymbro;
use gymbro;

create table usuario (
	usuario_ID INT AUTO_INCREMENT PRIMARY KEY,
    username CHAR(20) NOT NULL UNIQUE,
    email CHAR(100) NOT NULL UNIQUE,
    pw CHAR(100) NOT NULL,
    inscripcion timestamp default current_timestamp()
);

create table ejercicio (
	ejercicio_ID INT AUTO_INCREMENT PRIMARY KEY,
    nombre CHAR(20) NOT NULL,
    descripcion CHAR(100),
    tipo CHAR(20),
    fk_usuario_ID INT NOT NULL,
    FOREIGN KEY (fk_usuario_ID) REFERENCES usuario (usuario_ID)
);

create table rutina (
	rutina_ID INT AUTO_INCREMENT PRIMARY KEY,
    nombre CHAR(20) NOT NULL,
    descripcion CHAR(100),
    fk_usuario_ID INT NOT NULL,
    FOREIGN KEY (fk_usuario_ID) REFERENCES usuario (usuario_ID)
);

create table rutina_ejercicio (
    fk_rutina_ID INT NOT NULL,
    FOREIGN KEY (fk_rutina_ID) REFERENCES rutina (rutina_ID),
    fk_ejercicio_ID INT NOT NULL,
    FOREIGN KEY (fk_ejercicio_ID) REFERENCES ejercicio (ejercicio_ID),
    orden INT,
    recursion INT
);

create table usuario_hace_rutina (
    fk_usuario_ID INT NOT NULL,
    FOREIGN KEY (fk_usuario_ID) REFERENCES usuario (usuario_ID),
    fk_rutina_ID INT NOT NULL,
    FOREIGN KEY (fk_rutina_ID) REFERENCES rutina (rutina_ID),
    inscripcion timestamp default current_timestamp(),
    completado INT
);

create table usuario_guarda_rutina (
    fk_usuario_ID INT NOT NULL,
    FOREIGN KEY (fk_usuario_ID) REFERENCES usuario (usuario_ID),
    fk_rutina_ID INT NOT NULL,
    FOREIGN KEY (fk_rutina_ID) REFERENCES rutina (rutina_ID)
);

create table usuario_guarda_ejercicio (
    fk_usuario_ID INT NOT NULL,
    FOREIGN KEY (fk_usuario_ID) REFERENCES usuario (usuario_ID),
    fk_ejercicio_ID INT NOT NULL,
    FOREIGN KEY (fk_ejercicio_ID) REFERENCES ejercicio (ejercicio_ID)
);