<?php
require_once 'controllers/CategoriaController.php';
require_once "config/session.php";
require_once 'config/database.php'; 

$db = Database::conectar();
$categoriaController = new CategoriaController();

// Recuperar la categoría desde la URL
$view_categoria = isset($_GET['view']) ? $_GET['view'] : null;

// Mapear los nombres de categorías con sus IDs en la base de datos
$categorias = [
    'music' => 1,
    'love' => 2,
    'reflex' => 3,
];

// Obtener el ID de la categoría seleccionada
$id_categoria = $categorias[$view_categoria] ?? null;

// Inicializar la variable de entradas
$entradas = [];

if ($id_categoria !== null) {
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
}

// Obtener el nombre de la categoría
$nombre_categoria = array_search($id_categoria, $categorias) ?: "Categoría Desconocida";
?>

<h1>🖤 Entradas en <?= htmlspecialchars($nombre_categoria) ?></h1>

<?php if (empty($entradas)) : ?>
    <p>No hay entradas en esta categoría.</p>
<?php else : ?>
    <?php foreach ($entradas as $entrada) : ?>
    <div class="entrada">
        <h2><?= htmlspecialchars($entrada["titulo"]) ?></h2>
        <p><strong>Publicado por:</strong> <?= htmlspecialchars($entrada["usuario_nombre"]) ?></p>
        <p><small>Publicado el <?= htmlspecialchars($entrada["fecha"]) ?></small></p>
        <p><?= nl2br(htmlspecialchars($entrada["descripcion"])) ?></p>

        <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada['usuario_id']) : ?>
            
            <?php include 'views/includes/modal.php'; ?>

            <button class="btn btn-warning"
                    onclick="abrirModalEditar('<?= $entrada['id'] ?>', '<?= htmlspecialchars($entrada['titulo'], ENT_QUOTES) ?>', `<?= htmlspecialchars($entrada['descripcion'], ENT_QUOTES) ?>`)">
                    ✏️ Editar
            </button>

            <button class="btn btn-danger"
                onclick="abrirModalEliminar('<?= $entrada['id'] ?>')">
                🗑️ Eliminar
            </button>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php endif; ?>
