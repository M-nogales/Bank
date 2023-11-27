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
    Saldo_total DECIMAL(10, 2),
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
    Cantidad INT,
    Tipo TEXT,
    Fecha_operacion DATE

);
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
    FOREIGN KEY (RemitenteID) REFERENCES Users(ID),
    FOREIGN KEY (DestinatarioID) REFERENCES Users(ID)
);


CREATE TABLE Admins(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Clave VARCHAR(50) NOT NULL
);
-- Insertar datos en la tabla Direcciones
INSERT INTO Direcciones (Provincia, Cod_Postal, Ciudad, Direccion)
VALUES ('ProvinciaEjemplo', '12345', 'CiudadEjemplo', 'DireccionEjemplo');

-- Obtener el ID de la dirección recién insertada
SET @direccion_id = LAST_INSERT_ID();

-- Insertar datos en la tabla Users con referencia a la dirección insertada
INSERT INTO Users (Nombre, Apellidos, DNI, Email, Pais, Fecha_Nacimiento, Foto, Clave, Saldo_total, IBAN, Direccion_ID)
VALUES (
    'NombreEjemplo',
    'ApellidosEjemplo',
    '123456789',
    'ejemplo@email.com',
    'PaisEjemplo',
    '2000-01-01',
    'ruta/foto.jpg',
    '123abc',
    1000.00,
    'IBANEjemplo',
    @direccion_id  -- Utilizamos el ID de la dirección recién insertada
);

/*
los usuarios ven si tienen aceptada o no el prestamo según el valor Aceptada en 
Prestamos, si es null aparecerá que está en proceso,y si es true o false
la notificación correspondiente*/
/*
El saldo se puede aumentar, disminuir 
* y transferir
*/