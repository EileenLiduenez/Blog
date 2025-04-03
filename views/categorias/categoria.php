<?php
require_once 'controllers/CategoriaController.php';
require_once "config/session.php";
require_once 'config/database.php'; 
$db = Database::conectar();
$categoriaController = new CategoriaController();
$id_categoria = isset($_GET['view']) ? $_GET['view'] : null;


$categorias = [
    'music' => 1,
    'reflex' => 3,
    'love' => 2,
];

$id_categoria = $categorias[$id_categoria] ?? null;

if ($id_categoria) {
    $sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, e.usuario_id, c.nombre AS categoria_nombre, u.nombre AS usuario_nombre 
            FROM entradas e
            INNER JOIN categorias c ON e.categoria_id = c.id
            INNER JOIN usuarios u ON e.usuario_id = u.id
            WHERE e.categoria_id = ?
            ORDER BY e.fecha DESC";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $entradas = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    $entradas = [];
}
?>

<?php if (empty($entradas)) : ?>
    <p>No hay entradas en esta categoría.</p>
<?php else : ?>
    <?php foreach ($entradas as $entrada) : ?>
        <div class="entrada">
            <h2><?= htmlspecialchars($entrada["titulo"]) ?></h2>
            <p><strong>Publicado por:</strong> <?= htmlspecialchars($entrada["usuario_nombre"]) ?></p>
            <p><small>Publicado el <?= htmlspecialchars($entrada["fecha"]) ?></small></p>
            <p><?= nl2br(htmlspecialchars($entrada["descripcion"])) ?></p> <!-- Muestra todo el texto -->
            


            <!-- Botones Editar y Eliminar solo si la entrada pertenece al usuario logueado -->
            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada['usuario_id']) : ?>
                <a href="editar_entrada.php?id=<?= $entrada['id'] ?>" class="btn btn-warning">✏️ Editar</a>
                <a href="eliminar_entrada.php?id=<?= $entrada['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta entrada?')">🗑️ Eliminar</a>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>
<?php endif; ?>
