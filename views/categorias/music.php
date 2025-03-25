<?php
require_once '../../controllers/CategoriasController.php';

$id_categoria = 2; // Asegúrate de que este ID coincide con el de la BD
$controlador = new CategoriasController();
$entradas = $controlador->obtenerEntradasPorCategoria($id_categoria);

if (!$entradas) {
    echo "<p style='color:red;'>⚠ No hay entradas en esta categoría (ID: $id_categoria).</p>";
} else {
    echo "<h1>Love</h1>";
    echo "<ul>";
    foreach ($entradas as $entrada) {
        echo "<li><a href='entrada.php?id={$entrada['id']}'>{$entrada['titulo']}</a></li>";
    }
    echo "</ul>";
}
?>
