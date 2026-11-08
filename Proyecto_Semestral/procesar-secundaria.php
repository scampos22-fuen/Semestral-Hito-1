<?php
define('ACCESO', true);
require_once __DIR__ . '/includes/csrf.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD']!== 'POST') {
    header('Location: secundaria_formulario.php');
    exit;
}

function e($dato){
    return htmlspecialchars((string)$dato, ENT_QUOTES,'UTF-8');
}

$errores = [];

if (!csrf_valido($_POST['csrf_token'] ?? '')) {
    $errores¨['general'] = 'La sesion de formulario expiro. Intente de nuevo.';

}

$nombre    = trim($_POST['nombre_producto'] ?? '');
$categoria = trim($_POST['categoria']?? '');
$precio    = trim($_POST['precio'] ?? '');
$stock     = trim($_POST['stock_inicial'] ?? '');
$alergenos = trim($_POST['alergenos_info'] ?? '');

if ($nombre === '' ) {
    $erroes['nombre_producto'] = 'El nombre del plato es obligatorio.';
}elseif (!in_array($categoria, $categoria_permitidas, true)){
    $errores['categoria'] = 'La categoria seleccionada no es valida.';
}

if ($precio == ''){
    $erroes['precio'] = 'El precio es obligatorio. ';
}elseif (filter_var($precio, FILTER_VALIDATE_FLOAT) === false) {
    $errores['precio'] = 'El precio debe ser un numero. ';
}elseif ((float)$precio < 0.50 || (float)$precio > 5.00) {
    $errores['precio'] = 'El precio debe estar entre 0.50 y $5.00';
}

if ($alergenos === '') {
    $errores['stock_inicial'] = 'El stock inicial es obligatorio. ';
}elseif (filter_var($stock, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 200]]) === false ){
    $errores['stock_inicial'] = 'El stock debe ser un numero entre 1 y 200. ';
}

if ($alergenos === ''){
    $errores['info_alergenos'] = 'Indica la informacion de alergenos (o "Ninguno"). ';
} elseif (mb_strlen($alergenos) > 150) {
    $errores['info_alergenos'] = 'La informacion de alergenos no puede superar los 150 caracteres. ';
}

if (!empty($errores)) {
    $viejos = [
        'nombre_producto' => $nombre,
        'categoria'       => $categoria,
        'precio'          => $categoria,
        'stock_inicial'   => $stock,
        'info_alergenos'  => $alergenos,
    ];
    foreach ($erroes as $campo => $msg) {
        unset($viejos[$campo]);
    }
    $_SESSION['erroes_sec'] = $errores;
    $_SESSION['viejos_sec'] = $viejos;
    header('Location: secundaria_forulario.php');
    exit;
}

$nombre_categoria = [
    'ejecutivo' => 'Ejecutivo',
    'sopa'      => 'Sopa del Dia',
    'bebida'    => 'Bebida',
];

$titulo      = "CafeTrack - Producto Registrado";
$descripcion = "Confirmacion del registro de un producto en CafeTrack. ";
require_once __DIR__ . '/include/encabezado.php';
?>


 <main class="eq04-contenedor">
    <section class="eq04-seccion">
        <h2>Producto recibido correctamente</h2>


        <ul>
         <li><strong>Nombre:</strong> <?= e($nombre) ?></li>
         <li><strong>Categoria:</strong> <?= e($nombre_categoria) ?></li>
         <li><strong>Precio:</strong> <?= e(number_format((float)$precio, 2)) ?></li>
         <li><strong>Stock inicial:</strong> <?= e((int)$stock) ?></li>
         <li><strong>Alergenos:</strong> <?= e($alergenos) ?></li>
        </ul>

        <p><a herf="secundaria_formulario.php" class="eq04-boton-primario">Registrar otro</a></p>
    </section>
 </main>

<?php require_once __DIR__ . 'include/pie.php'; ?>