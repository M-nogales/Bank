DROP DATABASE IF EXISTS clear_bank;
CREATE DATABASE clear_bank;
use clear_bank;

DROP DATABASE IF EXISTS clear_bank;
CREATE DATABASE clear_bank;
use clear_bank;

-- añadir boolean numero rojos¿?
CREATE TABLE Direcciones (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Provincia VARCHAR(50),
    Cod_Postal VARCHAR(10),
    Pais VARCHAR(10),
    Ciudad VARCHAR(50),
    Direccion VARCHAR(100)
);

CREATE TABLE Users (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Apellidos VARCHAR(50),
    DNI VARCHAR(9) UNIQUE,
    Email VARCHAR(50) UNIQUE,
    Pais VARCHAR(10),
    Fecha_Nacimiento DATE,
    Foto VARCHAR(255),
    Clave VARCHAR(50) NOT NULL,
    Saldo DECIMAL(10, 2),
    IBAN VARCHAR(30),
    Direccion_ID INT,
    FOREIGN KEY (Direccion_ID) REFERENCES Direcciones(ID)
);

CREATE TABLE Prestamos (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT,
    Cantidada_solicitada DECIMAL(10, 2),
    Mensualidad DECIMAL(10, 2),
    Motivo TEXT,
    Aceptada boolean,
    FOREIGN KEY (User_ID) REFERENCES Users(ID)
);

CREATE TABLE Admins(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Clave VARCHAR(50) NOT NULL
);
/*
los usuarios ven si tienen aceptada o no el prestamo según el valor Aceptada en 
Prestamos, si es null aparecerá que está en proceso,y si es true o false
la notificación correspondiente*/
/*
El saldo se puede aumentar, disminuir 
* y transferir
*/