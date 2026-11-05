<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Inicio de sesión para usuarios de CafeTrack.">
  <title>CafeTrack - Iniciar Sesión</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
  <header class="eq04-header">
    <h1 class="eq04-titulo-sitio">CafeTrack UTP</h1>
    <nav aria-label="Navegación principal">
      <ul class="eq04-nav-lista">
        <li><a href="index.html" class="eq04-nav-enlace">Menú en Vivo</a></li>
        <li><a href="registro.html" class="eq04-nav-enlace">Registrarse</a></li>
        <li><a href="login.html" class="eq04-nav-enlace">Iniciar Sesión</a></li>
      </ul>
    </nav>
  </header>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Acceso a la Plataforma</h2>
      
      <form action="#" method="post" class="eq04-formulario">
        <fieldset class="eq04-fieldset">
          <legend class="eq04-legend">Credenciales de Usuario</legend>
          
          <div class="eq04-grupo-campo">
            <label for="correo_login" class="eq04-label">Correo Institucional:</label>
            <input type="email" id="correo_login" name="correo_login" class="eq04-input" 
                   required maxlength="100" autocomplete="email" placeholder="estudiante@utp.ac.pa">
          </div>

          <div class="eq04-grupo-campo">
            <label for="clave_login" class="eq04-label">Contraseña:</label>
            <input type="password" id="clave_login" name="clave_login" class="eq04-input" 
                   required minlength="8" maxlength="50" autocomplete="current-password">
          </div>
        </fieldset>

        <button type="submit" class="eq04-boton-primario">Ingresar</button>
        <p><a href="recuperar.html">¿Olvidaste tu contraseña?</a> | <a href="registro.html">Crear cuenta nueva</a></p>
      </form>
    </section>
  </main>

  <footer class="eq04-footer">
    <p>&copy; 2026 CafeTrack - UTP</p>
  </footer>
</body>
</html>