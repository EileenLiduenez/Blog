<?php
require_once 'controllers/CategoriaController.php'; // Asegúrate de que el nombre coincide

$categoriaController = new CategoriaController();
$id_categoria = isset($_GET['view']) ? $_GET['view'] : null;

$categorias = [
    'music' => 1,
    'reflex' => 2,
    'love' => 3,
];

$id_categoria = $categorias[$id_categoria] ?? null;

if ($id_categoria) {
    $entradas = $categoriaController->obtenerEntradasPorCategoria($id_categoria);
} else {
    $entradas = [];
}

echo "<h1>Entradas en la categoría</h1>";
if (empty($entradas)) {
    echo "<p>No hay entradas en esta categoría.</p>";
} else {
    echo "<ul>";
    foreach ($entradas as $entrada) {
        echo "<li><a href='entrada.php?id={$entrada['id']}'>{$entrada['titulo']}</a></li>";
    }
    echo "</ul>";
}
?>
