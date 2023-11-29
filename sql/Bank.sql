DROP DATABASE IF EXISTS clear_bank;
CREATE DATABASE clear_bank;
use clear_bank;


CREATE TABLE Direcciones (
    ID INT PRIMARY KEY,
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
    FOREIGN KEY (RemitenteID) REFERENCES Users(ID)

);


CREATE TABLE Admins(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Clave VARCHAR(50) NOT NULL
);

-- trigger que evita la repetición de tablas de direcciones
DELIMITER //
CREATE TRIGGER before_insert_direcciones
BEFORE INSERT ON Direcciones
FOR EACH ROW
BEGIN
    DECLARE existing_direccion_id INT;

    -- Buscar si la dirección ya existe en la tabla Direcciones
    SELECT ID INTO existing_direccion_id
    FROM Direcciones
    WHERE Pais = NEW.Pais
      AND Provincia = NEW.Provincia
      AND Cod_Postal = NEW.Cod_Postal
      AND Ciudad = NEW.Ciudad
    LIMIT 1;

    -- Si la dirección ya existe, asignar ese ID a la nueva dirección
    IF existing_direccion_id IS NOT NULL THEN
        SET NEW.ID = existing_direccion_id;
    ELSE
        -- Si la dirección no existe, asignar un nuevo ID manualmente el primero es 1 
        SET NEW.ID = COALESCE((SELECT MAX(ID) + 1 FROM Direcciones), 1);
    END IF;
END;
//
DELIMITER ;


-- Crear admin
INSERT INTO Admins (Nombre, Clave)
VALUES ('mns', 'admin');
-- Insertar datos en la tabla Direcciones

-- Insertar una dirección y un usuario asociado (la dirección ya existe)
INSERT INTO Direcciones (Pais, Provincia, Cod_Postal, Ciudad)
VALUES ('España', 'Barcelona', '08001', 'Barcelona');

-- El trigger asignará automáticamente el ID existente a la nueva dirección
INSERT INTO Users (Nombre, Apellidos, DNI, Email, IBAN, Foto, Clave, Saldo_total, Fecha_Nacimiento, Direcciones_ID)
VALUES ('Juan', 'Pérez', '123456789', 'juan@example.com', 'ES12345678901234567890', 'url_foto_juan', '123', 1500.00, '1990-05-15', NULL);

-- Insertar una dirección y un usuario asociado (la dirección no existe)
INSERT INTO Direcciones (Pais, Provincia, Cod_Postal, Ciudad)
VALUES ('España', 'Madrid', '28001', 'Madrid');

-- El trigger asignará automáticamente un nuevo ID a la nueva dirección
INSERT INTO Users (Nombre, Apellidos, DNI, Email, IBAN, Foto, Clave, Saldo_total, Fecha_Nacimiento, Direcciones_ID)
VALUES ('Ana', 'Gómez', '987654321', 'ana@example.com', 'ES98765432109876543210', 'url_foto_ana', '123', 2000.00, '1985-10-20', NULL);

/*
los usuarios ven si tienen aceptada o no el prestamo según el valor Aceptada en 
Prestamos, si es null aparecerá que está en proceso,y si es true o false
la notificación correspondiente*/
/*
El saldo se puede aumentar, disminuir 
* y transferir
*/