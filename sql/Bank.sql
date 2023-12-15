DROP DATABASE IF EXISTS clear_bank;
CREATE DATABASE clear_bank;
use clear_bank;


CREATE TABLE Direcciones (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Pais VARCHAR(10) NOT NULL,
    Direccion varchar(30),
    Provincia VARCHAR(50),
    Cod_Postal VARCHAR(10),
    Ciudad VARCHAR(50)
);

CREATE TABLE Users (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Apellidos VARCHAR(50) NOT NULL,
    DNI VARCHAR(10) UNIQUE NOT NULL,
    Email VARCHAR(50) UNIQUE NOT NULL,
    IBAN VARCHAR(32) NOT NULL UNIQUE,
    Foto VARCHAR(255),
    Clave VARCHAR(50) NOT NULL,
    Saldo_total DECIMAL(10, 2)NOT NULL,
    Fecha_Nacimiento DATE NOT NULL,
    Direcciones_ID INT,
    FOREIGN KEY (Direcciones_ID) REFERENCES Direcciones(ID)
);

CREATE TABLE Prestamos (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT,
    Cantidada_solicitada DECIMAL(10, 2),
    Cuota DECIMAL(10, 2),
    Deuda DECIMAL(10, 2),
    fecha_de_creacion DATETIME,
    Motivo TEXT,
    Vencimiento DATE,
    Aceptada boolean,
    FOREIGN KEY (User_ID) REFERENCES Users(ID)
);

CREATE TABLE Solicitar (
    Solicitar_ID INT PRIMARY KEY AUTO_INCREMENT,
    Usuario_ID INT,
    Prestamo_ID INT,
    FOREIGN KEY (Usuario_ID) REFERENCES Users(ID),
    FOREIGN KEY (Prestamo_ID) REFERENCES Prestamos(ID)
);

CREATE TABLE Transigir (
    Transigir_ID INT PRIMARY KEY AUTO_INCREMENT,
    Remitente_ID INT,
    Destinatario_ID INT,
    Motivo TEXT,
    Cantidad DECIMAL(10, 2),
    Fecha_operacion DATETIME,
    FOREIGN KEY (Remitente_ID) REFERENCES Users(ID),
    FOREIGN KEY (Destinatario_ID) REFERENCES Users(ID)
);
CREATE TABLE Enviar (
    Enviar_ID INT PRIMARY KEY AUTO_INCREMENT,
    Contenido TEXT NOT NULL,
    FechaEnvio DATETIME NOT NULL,
    Leido BOOLEAN DEFAULT FALSE,
    RemitenteID INT,
    DestinatarioID INT,
    FOREIGN KEY (RemitenteID) REFERENCES Users(ID),
    FOREIGN KEY (DestinatarioID) REFERENCES Users(ID)
);

CREATE TABLE Admins(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Clave VARCHAR(50) NOT NULL
);


-- Crear admin
INSERT INTO Admins (Nombre, Clave)
VALUES ('mns', 'admin');

INSERT INTO Direcciones (Pais, Provincia, Cod_Postal, Ciudad)
VALUES ('España', 'Barcelona', '08001', 'Barcelona');

SET @ultimaDireccionID = LAST_INSERT_ID();

INSERT INTO Users (Nombre, Apellidos, DNI, Email, IBAN, Foto, Clave, Saldo_total, Fecha_Nacimiento, Direcciones_ID)
VALUES ('Juan 1', 'Pérez 1', '123456789', 'juan@example.com', 'ES12345678901234567890', 'url_foto_juan', '123', 1500.00, '1990-05-15', @ultimaDireccionID);

INSERT INTO Direcciones (Pais, Provincia, Cod_Postal, Ciudad)
VALUES ('España', 'Madrid', '28001', 'Madrid');

SET @ultimaDireccionID = LAST_INSERT_ID();

INSERT INTO Users (Nombre, Apellidos, DNI, Email, IBAN, Foto, Clave, Saldo_total, Fecha_Nacimiento, Direcciones_ID)
VALUES ('Ana 2', 'Gómez 2', '987654321', 'ana@example.com', 'ES98765432109876543210', 'url_foto_ana', '1234', 2000.00, '1985-10-20', @ultimaDireccionID);

INSERT INTO Direcciones (Pais, Provincia, Cod_Postal, Ciudad)
VALUES ('España', 'Barcelona', '08001', 'Barcelona');

SET @ultimaDireccionID = LAST_INSERT_ID();

INSERT INTO Users (Nombre, Apellidos, DNI, Email, IBAN, Foto, Clave, Saldo_total, Fecha_Nacimiento, Direcciones_ID)
VALUES ('awd 3', 'awd 3', 'awd', 'juan@awd.com', 'awd', 'wd', 'wd', 1560.00, '1950-05-15', @ultimaDireccionID);
    
INSERT INTO Enviar (Contenido, FechaEnvio, RemitenteID, DestinatarioID)
VALUES ('Contenido del mensaje', NOW(), 1, 3);
INSERT INTO Enviar (Contenido, FechaEnvio, Leido, RemitenteID, DestinatarioID)
VALUES ('¡Hola Usuario2!', NOW(), 1, 1, 2);

INSERT INTO Enviar (Contenido, FechaEnvio, Leido, RemitenteID, DestinatarioID)
VALUES ('¡Hola de nuevo Usuario1!', NOW(), 0, 2, 1);

INSERT INTO Enviar (Contenido, FechaEnvio, Leido, RemitenteID, DestinatarioID)
VALUES ('¿Cómo estás?', NOW(), 1, 3, 1);


INSERT INTO Prestamos (User_ID, Cantidada_solicitada, Cuota, Deuda,fecha_de_creacion, Vencimiento, Motivo, Aceptada)
VALUES (2, 1000.00, 150.00, 1000.00, '2023-12-20', null, 'Préstamo para gastos médicos', null);

INSERT INTO Solicitar (Usuario_ID, Prestamo_ID)
VALUES (2, LAST_INSERT_ID());

INSERT INTO Prestamos (User_ID, Cantidada_solicitada, Cuota, Deuda,fecha_de_creacion, Vencimiento, Motivo, Aceptada)
VALUES (1, 2000.00,200.00, 2000.00, '2023-01-01', null, 'juan juan juan', null);

INSERT INTO Solicitar (Usuario_ID, Prestamo_ID)
VALUES (1, LAST_INSERT_ID());

INSERT INTO Prestamos (User_ID, Cantidada_solicitada, Cuota, Deuda, fecha_de_creacion, Vencimiento, Motivo, Aceptada)
VALUES (1, 500.00,50.00, 500.00, '2023-01-01', null, 'juan juan ', null);

INSERT INTO Solicitar (Usuario_ID, Prestamo_ID)
VALUES (1, LAST_INSERT_ID());

INSERT INTO Prestamos (User_ID, Cantidada_solicitada, Cuota, Deuda, fecha_de_creacion, Motivo, Vencimiento, Aceptada)
VALUES (1, 500.00, 100.00, 500.00, '2023-01-01', 'Préstamo de ejemplo', NULL, NULL);

INSERT INTO Solicitar (Usuario_ID, Prestamo_ID)
VALUES (1, LAST_INSERT_ID());

INSERT INTO Transigir (Remitente_ID, Destinatario_ID, Cantidad, Motivo, Fecha_operacion)
VALUES (1, 1, 10, 'Aumento de Saldo', CURRENT_DATE);

INSERT INTO Transigir (Remitente_ID, Destinatario_ID,Motivo, Cantidad, Fecha_operacion)
VALUES (2, 3, 30, 'Aumento de Saldo', CURRENT_DATE);
