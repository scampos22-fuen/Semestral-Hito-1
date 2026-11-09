# Semestral-Hito-1

**CafeTrack** es una aplicacion web interactiva orientada a la gestion y seguimiento de pepdidos en cafeteria, EN este **Hito #2**, el sistema evoluciono desde maquetas estaticas en HTML5 hacia una arquitectura modular en **PHP**, integrando programcion orientada a objetos POO, validacion avanzada de datos en el servidor, gestion de sesiones por roles y estrictos controles de seguridad.

---

Francisco Quiñones Rama: `fransisco/Diseno`

## Objetivo:
Migrar la maqueta HTML del Hito #1 a PHP manteniendo el aspecto original, centralizar las partes repetidas del sitio con includes, mostrar un menu distinto segun el rol, generar listados con datos de demostracion y construir los dos GET (busqueda y flitro combinado).

## Que se hizo?
Las 10 paginas pasaron de .html a .php con 'git mv', para que Git las registre como renombraos y no como archivos nuevos. Se actualizaron todos los enlaces 'href' y los 'action' que apuntaban a .html, y se verifico con 'Select-String' que no quedara ninguna referencia. Tambien se corrigio '<time datetime="7:00">' por 'datetime=19:00' es decir formato 24 horas.

Eric Alveo Rama: `eric/desarrollo`

## Objetivo:
Desarrollar la parte de backend del Hito #2: Scripts de procesamiento (`procesar_login.php`, `procesar_registro.php`, `procesar_principal`), clases de validacion (`Usuario`, `Pedido`), manejo seguro de contraseñas y funciones propias `limpiar()`, `sanear()`, `redirigir()`

## Que se hizo?
**Se agregaron las funciones:**
-`limpiar()`: quita espacios sobrantes.
-`sanear()`: aplica `htmlspecialchars` para imprimir de forma segura.
-`redirigir()`: encia el header `Location` y detiene el script con `exit`.

**Se agregaron clases:**
`Usuario`: nombre (3 a 100 caracteres), correo con `filter_var`, rol permitido (`usuario`, `cocina`, `admin`) y método `verificarClave()`.
`Pedido`(entidad principal): código con formato `ORD-123`, fecha, plato, modalidad y estado con listas blancas (`in_array`), cédula con formato `8-888-8888`, cantidad de 1 a 5, hora de retiro entre 07:00 y 16:00 y alergias de hasta 200 caracteres.

**Se agregaron scripts de procesamiento:**
`procesar_login.php`: busca el usuario por correo y usa `password_verify`. Muestra un mensaje genérico ("Credenciales incorrectas") para no revelar si falló el correo o la clave. Usa `session_regenerate_id(true)` al iniciar sesión.
`procesar_registro.php`: valida cédula, rol (lista blanca que traduce 1, 2 y 3 a un rol) y clave, y genera el hash con `password_hash`.
`procesar_principal.php`: traduce los códigos del formulario con listas blancas, valida con `filter_var` y con la clase `Pedido`.

--- 

Omar Mojica Rama: `omar/Calidad`

## Objetivo:
Desarrollar la parte de calidad del Hito #2: validacion de datos con una clase Validador, revision de seguridad del sitio, token CSRF (bonus) y documentacion de pruebas.

## Que se hizo
**Clase Validador (clases/Validador.php), con métodos encadenables:** 
`texto()`: lee un campo de $_POST o $_GET y garantiza que sea una cadena, para descartar arreglos manipulados. 
`requerido()`, `longitud()`, `correo()` `(con filter_var)`, `cedula()`, `rango()` y `fecha()`. 
`listaBlanca()`: valida con in_array. 
`regla()`: aplica una regla de negocio con su propio mensaje. 
`esValido()` y `errores()`: devuelven el resultado de la validación.

**Integración en los scripts de procesamiento:** 
`procesar_login.php`: lectura segura con Validador::texto, validación de correo y contraseña, y verificación de credenciales solo si no hay errores. 
`procesar_principal.php`: plato y modalidad con listaBlanca, cantidad con rango (1 a 5) y hora de retiro con regla (07:00 a 16:00). Después sigue la segunda capa de la clase Pedido. 
`procesar_registro.php`: se indicó migrar la lectura de campos y las validaciones (nombre, correo, cédula, rol y contraseña) al Validador. 

**Seguridad:**
Constante de acceso: las páginas públicas definen `define('ACCESO', true);` y los archivos internos de includes/, clases/ y config/ empiezan con `defined('ACCESO') or die('Acceso denegado');`.
`.htaccess con Require all denied en includes/, clases/ y config/`, para que esos archivos den 403 si se abren por URL. 
Salida escapada con `htmlspecialchars` (ya existía en `mostrar_errores()` y `sanear()`). 
Datos sensibles solo por POST: registro, login y pedido usan `method="post"`. 

**Bonus CSRF (includes/csrf.php):**
Funciones `csrf_token()`, `csrf_campo()` y `csrf_valido()` (con `hash_equals`). 
`csrf_campo()` dentro de los formularios de `login.php`, `registro.php`, `recuperar.php`, `principal-formulario.php` y `secundaria-formulario.php`.
`csrf_valido()` al inicio de `procesar_login.php`, `procesar_registro.php` y `procesar_principal.php`. 

Sergio Ceballos Rama: `sergio/repo`

## Objetivo
Crear la bitacora (`docs/bitacora`) y la matriz de responsabilidades, reorganizar las carpetas segun la seccion 6, integrar los Pull Requests y controlar y revisar todos los commits, crear `config/datos_demo.php` con los arreglos de las entidades, incluyendo los 3 registros dictados en la clase, crear la calse `categoria` y `procesar_secundaria.php` y dividir y asigar una area para cada integrante.

## Que se hizo?

**Organizacion**
Se creo la carpeta `docs/` donde se encuentran los archivos .pdf y .md solicitados en la guia del Hito #2 (Tranzabilidad, bitacora, plan de pruebas e informe tecnico).

**Repositorio**
Se administraron las ramas de cada integrante, los Pull Requests y se reviso y controlo constantemente el historial de commits

**Datos**
Se implementaron `datos_demo.php` con los arreglos de las dos entidades para el uso de la clase `Categoria`

**Codigo**
Creacion de la clase `Categoria` y `procesar_secundaria.php`.