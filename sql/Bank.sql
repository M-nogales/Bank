DROP DATABASE IF EXISTS clear_bank;
CREATE DATABASE clear_bank;
use clear_bank;

-- añadir boolean numero rojos¿?
CREATE TABLE Users (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_user VARCHAR(50) NOT NULL,
    Contraseña VARCHAR(50) NOT NULL,
    Saldo DECIMAL(10, 2),
    IBAN VARCHAR(30)
);

CREATE TABLE Prestamos (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT,
    Cantidada_solicitada DECIMAL(10, 2),
    Mensualidad DECIMAL(10, 2),
    Motivo TEXT,
    FOREIGN KEY (User_ID) REFERENCES Users(ID)
);

CREATE TABLE Admins(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Contraseña VARCHAR(50) NOT NULL
);