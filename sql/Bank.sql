DROP DATABASE IF EXISTS clear_bank;
CREATE DATABASE clear_bank;
use clear_bank;


CREATE TABLE Direcciones (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Pais VARCHAR(10) NOT NULL,
    Provincia VARCHAR(50),
    Cod_Postal VARCHAR(10),
    Ciudad VARCHAR(50)
);

CREATE TABLE Users (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Apellidos VARCHAR(50) NOT NULL,
    DNI VARCHAR(9) UNIQUE NOT NULL,
    Email VARCHAR(50) UNIQUE NOT NULL,
    IBAN VARCHAR(30) NOT NULL,
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
    Mensualidad DECIMAL(10, 2),
    Motivo TEXT,
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


CREATE TABLE Operaciones(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Cantidad INT,
    Tipo TEXT,
    Usuario_ID INT,
    Fecha_operacion DATE,
    FOREIGN KEY (Usuario_ID) REFERENCES Users(ID)
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
-- Insertar datos en la tabla Direcciones

-- Insertar una dirección y un usuario asociado (la dirección ya existe)
INSERT INTO Direcciones (Pais, Provincia, Cod_Postal, Ciudad)
VALUES ('España', 'Barcelona', '08001', 'Barcelona');

SET @ultimaDireccionID = LAST_INSERT_ID();

-- El trigger asignará automáticamente el ID existente a la nueva dirección
INSERT INTO Users (Nombre, Apellidos, DNI, Email, IBAN, Foto, Clave, Saldo_total, Fecha_Nacimiento, Direcciones_ID)
VALUES ('Juan 1', 'Pérez 1', '123456789', 'juan@example.com', 'ES12345678901234567890', 'url_foto_juan', '123', 1500.00, '1990-05-15', @ultimaDireccionID);

-- Insertar una dirección y un usuario asociado (la dirección no existe)
INSERT INTO Direcciones (Pais, Provincia, Cod_Postal, Ciudad)
VALUES ('España', 'Madrid', '28001', 'Madrid');

SET @ultimaDireccionID = LAST_INSERT_ID();

-- El trigger asignará automáticamente un nuevo ID a la nueva dirección
INSERT INTO Users (Nombre, Apellidos, DNI, Email, IBAN, Foto, Clave, Saldo_total, Fecha_Nacimiento, Direcciones_ID)
VALUES ('Ana 2', 'Gómez 2', '987654321', 'ana@example.com', 'ES98765432109876543210', 'url_foto_ana', '123', 2000.00, '1985-10-20', @ultimaDireccionID);

INSERT INTO Direcciones (Pais, Provincia, Cod_Postal, Ciudad)
VALUES ('España', 'Barcelona', '08001', 'Barcelona');

SET @ultimaDireccionID = LAST_INSERT_ID();

-- El trigger asignará automáticamente el ID existente a la nueva dirección
INSERT INTO Users (Nombre, Apellidos, DNI, Email, IBAN, Foto, Clave, Saldo_total, Fecha_Nacimiento, Direcciones_ID)
VALUES ('awd 3', 'awd 3', 'awd', 'juan@awd.com', 'awd', 'wd', 'wd', 1560.00, '1950-05-15', @ultimaDireccionID);

SELECT
    Users.ID AS Usuario_ID,
    Users.Nombre,
    Users.Apellidos,
    Users.DNI,
    Users.Email,
    Users.IBAN,
    Users.Foto,
    Users.Clave,
    Users.Saldo_total,
    Users.Fecha_Nacimiento,
    Direcciones.ID AS Direccion_ID,
    Direcciones.Pais,
    Direcciones.Provincia,
    Direcciones.Cod_Postal,
    Direcciones.Ciudad
FROM
    Users
JOIN
    Direcciones ON Users.Direcciones_ID = Direcciones.ID;

UPDATE Direcciones
SET
    Pais = 'España',
    Provincia = 'Valencia',
    Cod_Postal = '46003',
    Ciudad = 'Valencia'
WHERE
    ID = (SELECT Direcciones_ID FROM Users WHERE ID = 2);

SELECT
    Users.ID AS Usuario_ID,
    Users.Nombre,
    Users.Apellidos,
    Users.DNI,
    Users.Email,
    Users.IBAN,
    Users.Foto,
    Users.Clave,
    Users.Saldo_total,
    Users.Fecha_Nacimiento,
    Direcciones.ID AS Direccion_ID,
    Direcciones.Pais,
    Direcciones.Provincia,
    Direcciones.Cod_Postal,
    Direcciones.Ciudad
FROM
    Users
JOIN
    Direcciones ON Users.Direcciones_ID = Direcciones.ID;
    
INSERT INTO Enviar (Contenido, FechaEnvio, RemitenteID, DestinatarioID)
VALUES ('Contenido del mensaje', NOW(), 1, 3);

SELECT Enviar.Contenido, Enviar.FechaEnvio, Enviar.Leido, 
       Remitente.Nombre AS RemitenteNombre, Remitente.Apellidos AS RemitenteApellidos,
       Destinatario.Nombre AS DestinatarioNombre, Destinatario.Apellidos AS DestinatarioApellidos
FROM Enviar
JOIN Users AS Remitente ON Enviar.RemitenteID = Remitente.ID
JOIN Users AS Destinatario ON Enviar.DestinatarioID = Destinatario.ID
WHERE Enviar.RemitenteID = 1; -- Este sería el ID del remitente (en este caso, 1)

SELECT Enviar.Contenido, Enviar.FechaEnvio, Enviar.Leido, 
       Destinatario.Nombre AS DestinatarioNombre, Destinatario.Apellidos AS DestinatarioApellidos
FROM Enviar
JOIN Users AS Destinatario ON Enviar.DestinatarioID = Destinatario.ID
WHERE Enviar.DestinatarioID = 3; -- Este sería el ID del destinatario (en este caso, 3)

-- Crear un préstamo para el usuario con ID 2
INSERT INTO Prestamos (User_ID, Cantidada_solicitada, Mensualidad, Motivo, Aceptada)
VALUES (2, 1000.00, 150.00, 'Préstamo para gastos médicos', null);

-- Asociar el préstamo al usuario con ID 2 mediante la tabla Solicitar
INSERT INTO Solicitar (Usuario_ID, Prestamo_ID)
VALUES (2, LAST_INSERT_ID());

-- Ver los préstamos del usuario con ID 2
SELECT Prestamos.ID AS Prestamo_ID,
       Prestamos.Cantidada_solicitada,
       Prestamos.Mensualidad,
       Prestamos.Motivo,
       Prestamos.Aceptada
FROM Prestamos
JOIN Solicitar ON Prestamos.ID = Solicitar.Prestamo_ID
WHERE Solicitar.Usuario_ID = 2;


SET @usuarioOrigenID = 1;  -- ID del usuario que realiza la operación
SET @usuarioDestinoID = 3;  -- ID del usuario cuyo saldo se modificará

-- Definir la cantidad que se sumará o restará al saldo
SET @cantidadOperacion = 500.00;  -- Puedes ajustar esta cantidad según la operación que desees realizar

-- Obtener el saldo actual del usuario de destino
SET @saldoDestinoActual = (SELECT Saldo_total FROM Users WHERE ID = @usuarioDestinoID);

-- Realizar la actualización del saldo del usuario de destino
UPDATE Users
SET Saldo_total = @saldoDestinoActual + @cantidadOperacion
WHERE ID = @usuarioDestinoID;

-- Registrar la operación en la tabla de Operaciones
INSERT INTO Operaciones (Cantidad, Tipo, Usuario_ID, Fecha_operacion)
VALUES (@cantidadOperacion, 'Transferencia', @usuarioOrigenID, NOW());

-- Verificar el resultado
SELECT
    Users.ID AS Usuario_ID,
    Users.Nombre,
    Users.Saldo_total
FROM
    Users
WHERE
    Users.ID IN (@usuarioOrigenID, @usuarioDestinoID);
/*
los usuarios ven si tienen aceptada o no el prestamo según el valor Aceptada en 
Prestamos, si es null aparecerá que está en proceso,y si es true o false
la notificación correspondiente*/
/*
El saldo se puede aumentar, disminuir 
* y transferir
*/