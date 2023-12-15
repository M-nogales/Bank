# Índice

1. [Lenguaje de Marcas](#lenguaje-de-marcas)
    - [Uso de Variables](#uso-de-6-variables)
    - [Uso de Selectores](#uso-de-6-selectores)
    - [Uso de Operaciones](#uso-de-4-operaciones)
    - [Uso de Funciones y Bucles](#uso-de-4-funciones-y-4-bucles)
    - [Uso de Mixins](#uso-de-6-mixins)
    - [Includes y otros](#uso-de-2-includes-y-otras-funciones)

2. [Entorno Servidor](#entorno-servidor)
    - [Modelo Entidad-Relación](#modelo-entidad-relación)
    - [Modelo Relacional](#modelo-relacional)
    - [Normalización](#normalización)
    - [Herramientas Utilizadas](#herramientas-utilizadas)
3. [Entorno Servidor](#entorno-servidor)
    - [Retos técnicos](#mayores-retos-técnicos)
    - [Error falso](#error-falso)
4. [Guía de usuario](#guía-de-usuario)    
5. [Otra Documentación](#otros)
    - [Disposición de carpetas](#disposición-de-carpetas)
## Lenguaje de Marcas

### Uso de 6 variables:
[scss con variables principales](css/_var.scss)

```
$palette-Light-Blue: #77A3E0;
$palette-Blue: #3457C8;
$palette-Yellow: #7c5c07;//#E6B637
$palette-White: #EBF0F2;
$palette-Black: #000454;
$font-path1: '../resources/fonts/Roboto/Roboto-Bold.ttf';
```

### Uso de 6 selectores
 [anidamientos y selectores](css/_header.scss)
### Uso de 4 operaciones
 [operaciones calc](css/_var.scss)

```
$icon-sm-md-bottom:calc(#{$navbar-icon-size-bottom} * 1.3vw);
$icon-sm-md-top:calc(#{$navbar-icon-size-top} * 1.3vw);
$icon-xl-top:calc(#{$navbar-icon-size-xl-top} * 1.3vw);
margin-bottom: calc(9vh + 1.6rem); (_msgs.scss)
```

### Uso de 4 funciones y 4 bucles
 [Bucles y funciones](css/_bucles_y_func.scss)

```
// aplicamos esa fuente a todos los h
@for $i from 1 through 6 {
  h#{$i} {
    font-family: $font-family-Roboto;
  }
}
```

```
// a este "array" de elementos le aplicamos otra fuente distinta
$elementos-texto: "button", "input", "textarea", "select", "p";

@each $elemento in $elementos-texto {
  #{$elemento} {
    font-family: $font-family-Muesli;
  }
}
```

```
// font weight personalizada para los <p> que esten dentro de <a>
@function aplicar-font-weight($valor) {
  $font-weight: $valor * 100;
  @return $font-weight;
}

@mixin aplicar-estilos-enlaces-con-p($font-weight) {
  a {
    p {
      font-weight: aplicar-font-weight($font-weight);
    }
  }
}
// 700 = bold
@include aplicar-estilos-enlaces-con-p(7);
```

```
// cambiar color texto de los enlaces y svg al hacer hover oscurecemos el color de antes
@mixin aplicar-color-enlaces-svg($color) {
  a {
    color: $color;

    &:hover {
      color: oscurecer($color, 10%);
      svg {
        fill: oscurecer($color, 10%);
      }
    }

    svg {
      fill: $color;
    }
  }
}
// oscurecemos un 10% el color que tenemos antes del hover
@function oscurecer($color, $porcentaje) {
  @return darken($color, $porcentaje);
}

@include aplicar-color-enlaces-svg($palette-Yellow);
```

```
// apartir de la columna 7 al hacer hover tiene un color, antes otro
@function calcular-color($columna-hover, $umbral) {
  @if $columna-hover < $umbral {
    @return #d5afaf; // Cambiar a color 1 si el número de columna es menor que el umbral
  } @else {
    @return #72878e; // Cambiar a color 2 si el número de columna es mayor o igual al umbral
  }
}

$umbral-columnas: 7;

$numero-de-columnas: 12;

@for $i from 1 through $numero-de-columnas {
  table tbody tr td:nth-child(#{$i}):hover {
    background-color: calcular-color($i, $umbral-columnas);
  }
}
```

```
// cambiamos el color del borde y el tamaño segun la posicion
@function calcular-color-borde($columna) {
  @if $columna % 2 == 0 {
    @return $palette-Black;
  } @else {
    @return $palette-White;
  }
}

$numero-de-columnas: 12;

@for $i from 1 through $numero-de-columnas {
  table tbody tr td:nth-child(#{$i}):hover {
    border: 2px solid calcular-color-borde($i);
  }
}
```

### Uso de 6 mixins
 [mixins](css/_mixins.scss)

```
// evitamos ciertos margenes de boostrap
@mixin antibootstrap{
  margin:0 10px 0 0  !important;
  padding: 0px !important;
}
```

```
// quitamos margenes de boostrap
@mixin antibootstrap-h1{
  margin: 0px !important;
  padding: 0px !important;
}
```

```
// centrar elementos en columnas
@mixin flex-column-align-justify{
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
```

```
// centrar elementos personaliazdo, por defecto row
@mixin flex-align-justify($direction: row, $justify-content: center, $align-items: center) {
  display: flex;
  flex-direction: $direction;
  justify-content: $justify-content;
  align-items: $align-items;
}
```

```
// tamaño de iconos top header personalizable
@mixin icono-estilos($icon-size: $navbar-icon-size-top, $factor-de-tamano: 1.3vw, $max-height: 8vh, $margin-inferior: 5px) {
  width: calc(#{$icon-size} * #{$factor-de-tamano});
  max-height: $max-height;
  margin: $margin-inferior 0;
}
```

```
// tamaño svg billete user_view
@mixin saldo_icon {
  display: none;
  width: calc(#{$icon-xl-top} + 10vw);
  min-width: 15vw;
  max-width: 10vw;
  max-height: 10vh;
}
```

### Uso de 2 includes y otras funciones
(todo el proyecto)
```
@include flex-align-justify;
@include antibootstrap-h1;
@use 'saldo';
@import "var";
@return darken($color, $porcentaje);
```

## Entorno Servidor

### Modelo Entidad-Relación

![Modelo Entidad-Relación](resources/imgs/Modelos/Modelo_Entidad_Relación.png)

### Modelo Relacional

![imagen Modelo Relacional](resources/imgs/Modelos/Modelo_Relacional.png)

### Normalización

he normalizado la tabla hasta el nivel 3NF excepto casos especificos de la tabla usuario que implicarian crear tablas con valores unicos o la tabla admin,que no intercambia datos con ninguna tabla

### Herramientas utilizadas

Draw.io: para la creación del modelo Entidad-Relación.
MySql workbench: para la creación de la base de datos.
ChatGpt: para facilitar la busqueda de información y aumentar la eficiencia Ej.LAST_INSERT_ID(); utilizada en la tabla direcciones entre otras.
VsCode: Editor de código por excelencia.
Git y Github: Para el control de versiones del proyecto.

## Entorno Cliente

En estos apartados no entraré a comentar lineas de codigo como tal, ya las he comentado (o eso creo) en sus respectivos ficheros
### Mayores retos técnicos

Las funcionalidades que más trabajo me ha costado sacar y entender han sido la de [Mensajes.php](Mensajes.php) y la de [Admin_View](admin_view.php).

En Mensajes.php, me fue dificil caer en la conclusión de que podiamos conseguir el id del destinatario atraves de la url y que en caso de que no estuviera me cojiera el otro usuario siempre y cuando no sea uno mismo.

En cuanto a Admin_view.php, uno de los reto fue el como diferenciar en una tabla de tamaño indefinido unas filas de otras.

La solución más simple que encontré fue el enterder que existen tantas filas como prestamos que se van a diferenciar siempre por el id

 Otro detalle que me costó plantear es el como hacer el botón de actualizar, que hablamos en clase Pedro y yo, un botón que en caso de que la fecha de vencimiento hubiese pasado (introducida por nosotros) y aceptasemos el prestamo comparase la fecha actual con la de vencimiento y en caso de que fuese anterior a la actual restaramos la deuda faltante del prestamo al saldo del usuario en concreto, no de todos los usuarios. 
 
 La solución viene de la mano de lo anterior y es que si queremos actualizar un prestamo en concreto necesitamos un id en concreto, y como le pasamos a php un valor en concreto atraves de un boton? con value,value = id del prestamo,con este dato ya podemos diferenciar las filas a la hora de recojer los datos al enviarlos y hacer todas las consultas a la base de datos. 

### Error falso

Denegar acceso a las páginas del proyecto si no se ha logeado correctamente,$_SESSION["accesoUser"] se crea en el login, idem $_SESSION["accesoAdmin"]
```
 if ($_SESSION["accesoUser"] !== true) {
   // Redirigir a inicio_sesion.html si no tiene acceso
   header("Location: inicio_sesion.html");
   exit();
}
```

## Guía de usuario 


### Contenido

1. **Registro e Inicio de Sesión**
    - Para crear una cuenta, ve a la página de registro y sigue las instrucciones e introduce tus datos.
    - Una vez hayas introducidos tus datos de manera correcta, te aparecerá en pantalla tu clave de acceso y podrás iniciar sesion

2. **Welcome**
    - aquí encontraras:

        1. Tu saldo actual, disponible en las monedas con mayor valor.
        2. Una lista de tus últimos movimientos
        3. Tu tarjeta personal

3. **Operaciones**
    - Desde el menú principal, selecciona "Operaciones" ingreso o retiro de dinero a tanto a tu cuenta como a las de otros usuaario.
    - Ingresa la información requerida y confirma la operación.

4. **Mensajes**
    - Aquí podras enviar y recibir mensajes con otros usuarios de Clear Bank

5. **Préstamos**
    - En está sección podrás solicitar un prestamos,ver los prestamos pendientes y además ir pagandolos una vez sean aceptados.

6. **Ajustes**
    - Haz click en tu foto de perfil o en el engranaje para poder modificar tus datos personales.
7. **Cerrar Sesión**
    - Haz click en el icono de una puerta para cerrar tu sesión y volver al inicio de sesión

## Otros

### disposición de carpetas
```
Bank
├── css (Cotiene todos los estilos de sass)
│   ├── _admin.scss
│   ├── _ajustes.scss
│   ├── _bienvenida.scss
│   ├── _bucles_y_func.scss
│   ├── _creditC.scss
│   ├── _header.scss
│   ├── _login.scss
│   ├── _mixins.scss
│   ├── _msgs.scss
│   ├── _operac.scss
│   ├── _prestamos.scss
│   ├── _saldo.scss
│   ├── _var.scss
│   ├── bootstrap.css
│   ├── main.scss
│   └── style.css
├── js (Cotiene todos los estilos de js)
│   ├── bootstrap.bundle.js
│   ├── localStorage.js
│   └── manipulacion.js
├── php (Cotiene la gran mayoria de consultas a bases de datos)
│   ├── FotosPerfil (contiene las imagenes de perfil y por defecto)
│   │   ├── Admin.jpg
│   │   ├── default_1.png
│   │   ├── default_2.jpg
│   │   └── default_3.jpg
│   ├── actualizar_datos.php
│   ├── admin.php
│   ├── ajustes.php
│   ├── conex.php
│   ├── get_all.php
│   ├── get_id.php
│   ├── Insert_operaciones.php
│   ├── insert_prestamos.php
│   ├── login.php
│   ├── mensajes.php
│   ├── prestamos_validation.php
│   ├── registro.php
│   ├── select_operaciones.php
│   ├── select_prestamos.php
├── resources (recursos utilizados para la web)
│    ├── fonts
│    │   ├── Muesli
│    │   └── Roboto
│    └── imgs
│        ├── chip.png
│        ├── Clear_Bank_more_resoluc.png
│        ├── mockup
│        │   ├── ajustes.png
│        │   ├── bienvenida.png
│        │   ├── Components.png
│        │   ├── Inicio_de_sesión.png
│        │   ├── Operaciones.png
│        │   ├── Prestamos.png
│        │   ├── Registro.png
│        │   ├── Sesión_no_iniciada.png
│        │   └── Tarjetas.png
│        └── Modelos
│           ├── Modelo_Entidad_Relación.png
│           └── Modelo_Relacional.png
├── resources
│   └── fonts
│       ├── Muesli
│       └── Roboto
├── sql (base de datos)
│   └── Bank.sql
├── .gitattributes
├── admin_view.php (vista de adminitrador)
├── ajustes.php (cambiar datos del usuario)
├── cerrar_sesion.php ( cerramos sesiones y volvemos al login)
├── DOCUMENTATION.md
├── inicio_sesion.html (login)
├── LICENSE
├── Mensajes.php ( mensajes entre usuarios)
├── operaciones.php ( realizar operaciones)
├── prestamos.php ( realizar prestamos)
├── README.md
├── registro.php ( registrar un usario nuevo)
└── user_view.php ("bienvenida a la web")
```