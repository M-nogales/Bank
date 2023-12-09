# TO DO para este proyecto
 - [x] crear la bbdd
 - [ ] como unir js y php (ajax)
 - [x] conexion a php
 - [ ] usar framework cake.php
 - [x] como unir js y php (get element by id..)
 - [x] conexion a php
 - [ ] enlaces relativos/estructura de carpeta conex/consultas
 - [ ] mensajes relacion a si mismos
 - [ ] user,direccion mensaje 
 ## Problemas
 - [x] identificar usuarios de forma segura
# NOTAS
### Registro
el usuario se regitra con intorduciendo todo lo necesario de la tabla user (DNI Opcional) y se le dará una **clave** de inicio de sesión
### Tarjeta
en la tarjeta ves todos los datos del usuario (seguridad idk)
### Lista de movimientos
acordion cerrado en el que se ve un resumen, al darle se muestran todos los datos

# sesiones (Doc)
1. Global
    1. $_SESSION["id"]= id user/admin
2. User
    1. $_SESSION["usuario"] = nombre de user (login)
    2. $_SESSION["clave"] = clave user (login)
    3. $_SESSION["accesoUser"]=false; acceso Users
    4. $_SESSION['Apellidos'] = ape user (login)
    5. $_SESSION['DNI'] = dni user (login)
    6. $_SESSION['Email'] = email user (login)
    7. $_SESSION['IBAN'] = iban user (login)
    8. $_SESSION['Foto'] = dirección a foto user (login)
    9. $_SESSION['Saldo_total'] = saldo user (login)
    10. $_SESSION['Fecha_Nacimiento'] = fecha nacimiento user (login)
    11. $_SESSION['Direcciones_ID'] = id de la tabla de direcciones asociada (login)  
3. Admin
    1. $_SESSION["accesoAdmin"]=false; acceso admins 