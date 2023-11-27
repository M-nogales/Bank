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
-- CREATE TABLE Residir (
--     Residir_ID INT PRIMARY KEY AUTO_INCREMENT,
--     Usuario_ID INT,
--     Direccion_ID INT,
--     FOREIGN KEY (Usuario_ID) REFERENCES Users(ID),
--     FOREIGN KEY (Direccion_ID) REFERENCES Direcciones(ID)
-- );
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

-- CREATE TABLE Solicitar (
--     Solicitar_ID INT PRIMARY KEY AUTO_INCREMENT,
--     Usuario_ID INT,
--     Prestamo_ID INT,
--     FOREIGN KEY (Usuario_ID) REFERENCES Users(ID),
--     FOREIGN KEY (Prestamo_ID) REFERENCES Prestamos(ID)
-- );

CREATE TABLE Prestamos (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT,
    Cantidada_solicitada DECIMAL(10, 2),
    Mensualidad DECIMAL(10, 2),
    Motivo TEXT,
    Aceptada boolean,
    FOREIGN KEY (User_ID) REFERENCES Users(ID)
);
-- CREATE TABLE Realizar (
--     Realizar_ID INT PRIMARY KEY AUTO_INCREMENT,
--     Usuario_ID INT,
--     Operacion_ID INT,
--     FOREIGN KEY (Usuario_ID) REFERENCES Users(ID),
--     FOREIGN KEY (Operacion_ID) REFERENCES Operaciones(ID)
-- );
CREATE TABLE Operaciones(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Cantidad INT
    Tipo TEXT,
    Fecha_operacion DATE

)
-- CREATE TABLE Enviar (
--     Enviar_ID INT PRIMARY KEY AUTO_INCREMENT,
--     Remitente_ID INT,
--     Destinatario_ID INT,
--     Mensaje_ID INT,
--     FOREIGN KEY (Remitente_ID) REFERENCES Users(ID),
--     FOREIGN KEY (Destinatario_ID) REFERENCES Users(ID),
--     FOREIGN KEY (Mensaje_ID) REFERENCES Mensajes(ID)
-- );
CREATE TABLE Mensajes (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    RemitenteID INT,
    DestinatarioID INT,
    Contenido TEXT NOT NULL,
    FechaEnvio DATETIME NOT NULL,
    Leido BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (RemitenteID) REFERENCES Usuarios(ID),
    FOREIGN KEY (DestinatarioID) REFERENCES Usuarios(ID)
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