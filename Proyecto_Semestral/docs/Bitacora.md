# Bitácora de Desarrollo y Control de Avances

**Proyecto:** CafeTrack · Hito #2  
**Materia/Entorno:** Desarrollo Web / PHP Backend  
**Repositorio Principal:** Proyecto Semestral CafeTrack  

---

## 1. Equipo de Trabajo y Roles Asignados

| Integrante | Rol Principal | Responsabilidades Clave |
| :--- | :--- | :--- |
| **Sergio Ceballos** | Líder de Proyecto / Documentador / Integrador | Organización y asignación de tareas, orientación técnica al equipo, creación del repositorio, jerarquía de archivos, gestión de Pull Requests, supervisión de commits, carga de activos/imágenes y elaboración de la presentación ejecutiva para demostración en clase. |
| **Francisco Quiñones** | Integrante 2: Diseño & UX (PHP) | Migración del maquetado a PHP, desarrollo del sistema de `includes`, menú según rol, listados con paginación dinámica y formularios GET (`buscar.php` y `filtrar.php`). |
| **Eric Alveo** | Integrante 3: Desarrollo Backend PHP | Desarrollo de la lógica de procesamiento POST, clases de entidad (`Usuario`, `Pedido`), funciones auxiliares de saneamiento, hash seguro de contraseñas y manejo de sesiones. |
| **Omar Mojica** | Integrante 4: Calidad, Seguridad & Pruebas | Implementación de la clase `Validador`, seguridad de archivos (`ACCESO`, `.htaccess`), protección contra vulnerabilidades (XSS, CSRF Token), pruebas de datos e informe de calidad. |

---

## 2. Jerarquía de Archivos y Arquitectura del Proyecto

Bajo la gestión de la arquitectura realizada por **Sergio Ceballos**, se estructuró el repositorio para separar responsabilidades de diseño, lógica backend, configuraciones y assets visuales:

```text
Proyecto_Semestral/
├── css/
│   └── estilos.css                # Estilos visuales del sistema
├── images/                         # Recursos gráficos organizados e integrados
├── config/
│   ├── config.php                 # Configuración global y rol de sesión
│   ├── datos_demo.php             # Arreglo de pedidos de demostración
│   └── usuarios_demo.php          # Credenciales iniciales simuladas
├── includes/
│   ├── .htaccess                  # Bloqueo de acceso directo HTTP (403)
│   ├── encabezado.php             # HTML head, header global y session_start()
│   ├── menu.php                   # Renderizado dinámico del menú según rol
│   ├── pie.php                    # Pie de página global
│   ├── funciones.php              # Funciones auxiliares globales y de formateo
│   └── csrf.php                   # Funciones para generación y validación CSRF
├── clases/
│   ├── .htaccess                  # Bloqueo de acceso directo HTTP (403)
│   ├── Usuario.php                # Clase POO para gestión de usuarios
│   ├── Pedido.php                 # Clase POO para entidad de pedidos
│   └── Validador.php              # Clase para validaciones del lado del servidor
├── procesar_login.php             # Script procesador de inicio de sesión (POST)
├── procesar_registro.php          # Script procesador de registro de usuarios (POST)
├── procesar_principal.php         # Script procesador de creación/edición de pedido (POST)
├── procesar-secundario.php        # Script procesador de formulario secundario (POST)
├── principal-listado.php          # Vistas con paginación y datos dinámicos
├── buscar.php                     # Búsqueda GET (plato / número de pedido)
├── filtrar.php                    # Filtro GET combinado (modalidad y estado)
└── README.md                      # Documentación del proyecto
```

---

## 3. Registro Detallado de Actividades por Integrante

### 3.1. Sergio Ceballos (Liderazgo, Gestión Git, Documentación & Presentación)
- **Organización y Orientación:** Coordinó el reparto de responsabilidades entre los integrantes del equipo y brindó soporte continuo para solventar dudas de desarrollo e integración.
- **Estructuración del Repositorio:** Creó el repositorio oficial del proyecto, definió la jerarquía de carpetas y estableció las normas de codificación.
- **Control de Versiones (Git Supervisor):** 
  - Supervisó y revisó los commits de cada rama temática (`fransisco/Diseno`, `eric/desarrollo`, `omar/Calidad`).
  - Gestionó y aprobó los Pull Requests (PR) para la integración limpia en la rama principal (`main`).
  - Realizó commits de ordenamiento, carga de activos visuales y organización de imágenes del proyecto.
- **Documentación y Presentación:** Elaboró la documentación ejecutiva del proyecto y diseñó la presentación multimedia destinada a la demostración en clase.

---

### 3.2. Francisco Quiñones (Integrante 2: Diseño & Experiencia de Usuario)
- **Migración a PHP:** Convirtió 10 páginas `.html` del Hito #1 a `.php` utilizando `git mv` para mantener el historial de versión.
- **Mantenimiento de Includes:**
  - `config.php`: Centralización de la variable `$rol`.
  - `encabezado.php` & `pie.php`: Reutilización de fragmentos HTML con soporte para `$titulo` y `$descripcion` sanitizados con `htmlspecialchars`.
  - `menu.php`: Menú dinámico adaptado según el rol (`visitante`, `usuario`, `admin`).
- **Funciones Propias (`includes/funciones.php`):**
  - `formatear_fecha()`: Conversión de fechas a formato legible (`DD/MM/AAAA HH:MM AM/PM`).
  - `mostrar_errores()`: Renderizado de arreglos de error dentro de la plantilla.
  - `paginar()`: Cálculo numérico de páginas con `array_slice` y ajuste de rangos con `min(max(...))`.
- **Formularios GET:**
  - `buscar.php`: Búsqueda por coincidencia parcial (`stripos`), recortado a 50 caracteres y preservación del parámetro en paginación (`http_build_query`).
  - `filtrar.php`: Filtros combinados (Modalidad y Estado) validados con listas blancas (`in_array`). Preservación de selección con atributo `selected`.

---

### 3.3. Eric Alveo (Integrante 3: Desarrollo Backend PHP)
- **Funciones Backend Auxiliares:**
  - `limpiar()`: Eliminación de espacios sobrantes en cadenas.
  - `sanear()`: Escapado de caracteres especiales (`htmlspecialchars`).
  - `redirigir()`: Envío del encabezado `Location` con interrupción `exit`.
- **Programación Orientada a Objetos (POO):**
  - **Clase `Usuario`:** Encapsulamiento de datos (nombre, correo, rol y verificación de clave).
  - **Clase `Pedido`:** Encapsulamiento del pedido (código `ORD-123`, plato, modalidad, estado, cédula, cantidad de 1 a 5, hora de retiro de 07:00 a 16:00 y campo de alergias).
- **Procesamiento de Formularios (POST):**
  - `procesar_login.php`: Autenticación mediante `password_verify` y regeneración de ID de sesión (`session_regenerate_id(true)`).
  - `procesar_registro.php`: Creación de usuarios aplicando `password_hash`.
  - `procesar_principal.php`: Procesamiento seguro de pedidos mediante la clase `Pedido`.
- **Credenciales Demo:** Configuración de `config/usuarios_demo.php` con contraseñas encriptadas para pruebas iniciales.

---

### 3.4. Omar Mojica (Integrante 4: Calidad, Seguridad & Pruebas)
- **Clase `Validador` (`clases/Validador.php`):**
  - Implementación de un patrón fluent (métodos encadenables) para validación de datos del lado del servidor: `texto()`, `requerido()`, `longitud()`, `correo()`, `cedula()`, `rango()`, `fecha()`, `listaBlanca()` y `regla()`.
- **Mecanismos de Protección y Seguridad:**
  - **Constante de Acceso:** Uso de `define('ACCESO', true)` en páginas públicas y verificación `defined('ACCESO') or die('Acceso denegado')` en módulos internos.
  - **Configuración Server-Side:** Adición de `.htaccess` en directorios sensibles (`includes/`, `clases/`, `config/`) con la directiva `Require all denied`.
  - **Módulo CSRF (`includes/csrf.php`):** Implementación de funciones `csrf_token()`, `csrf_campo()` y `csrf_valido()` (con comparación mediante `hash_equals`).
- **Pruebas y Matriz de Validación:** Integración de la validación en scripts POST/GET e informe formal de calidad.

---

## 4. Matriz Resumen de Validaciones del Sistema

| Campo | Regla Aplicada | Ubicación de Validación |
| :--- | :--- | :--- |
| **Nombre** | Obligatorio (3 a 80/100 caracteres) | `Validador` / Clase `Usuario` |
| **Correo Electrónico** | Obligatorio, sintaxis `filter_var` | `Validador` / Clase `Usuario` |
| **Cédula** | Formato Panameño (ej. `8-888-8888`) | `Validador` / Clase `Pedido` |
| **Rol de Usuario** | Lista blanca (`usuario`, `cocina`, `admin`) | `Validador` / Clase `Usuario` |
| **Contraseña** | Longitud segura (8 a 50 caracteres), Hash BCRYPT | `Validador` / `procesar_registro.php` |
| **Plato y Modalidad** | Lista blanca de valores permitidos | `Validador` / Clase `Pedido` |
| **Cantidad** | Entero dentro del rango $1 \le x \le 5$ | `Validador` / Clase `Pedido` |
| **Hora de Retiro** | Formato HH:MM (Entre 07:00 y 16:00) | `Validador` / Clase `Pedido` |
| **Token CSRF** | Coincidencia exacta con token de `$_SESSION` | `csrf_valido()` en scripts `procesar_*.php` |

---

## 5. Historial de Incidencias Técnicas y Soluciones

```text
+-------------------------------------------------------+-------------------------------------------------------+-------------------------------------------------------+
| Incidencia Detectada                                  | Causa Raíz                                            | Solución Implementada                                 |
+-------------------------------------------------------+-------------------------------------------------------+-------------------------------------------------------+
| Error 403 al ejecutar 'git push'                      | Credenciales desactualizadas guardadas en Windows     | Limpieza en Administrador de Credenciales y reauth.   |
| Discrepancia en rutas entre Windows y Linux (CSS)     | Nombre de carpeta en mayúsculas 'CSS' vs 'css/'       | Unificación de nomenclatura en minúsculas en Git.     |
| Archivos de 'includes/' con peso 0 bytes              | Creación con PowerShell sin guardar buffer de código  | Edición, guardado explícito y verificación de tamaño. |
| Inyección de Scripts en Búsqueda                      | Cadenas no escapadas en salidas HTML                  | Sanitización global con htmlspecialchars.             |
| Acceso no autorizado a archivos de configuración      | Falta de restricción en servidor web                  | Implementación de .htaccess y constante ACCESO.       |
| Incompatibilidad de entrada tipo Array (ej. texto[])  | Manipulación de parámetros GET/POST                   | Filtrado inicial estricto con Validador::texto().     |
+-------------------------------------------------------+-------------------------------------------------------+-------------------------------------------------------+
```

---

## 6. Estado Final y Próximos Pasos (Hito #3)

1. **Persistencia de Datos:** Migrar los datos encriptados e simulados en `datos_demo.php` a una base de datos relacional (MySQL / MariaDB).
2. **Control de Errores Visuales:** Integrar el arreglo `$errores` retornado por `Validador` directamente sobre la interfaz de los formularios POST, manteniendo los campos válidos pre-llenados (`$viejo`).
3. **Cierre de Sesión:** Implementar script `logout.php` con destrucción completa de variables de sesión (`session_destroy`).