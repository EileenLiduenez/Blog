<?php
require_once 'config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db = Database::conectar();
$buscar = isset($_GET['q']) ? trim($_GET['q']) : '';
$entradas = [];

if (!empty($buscar)) {
    $sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, e.usuario_id, e.categoria_id, 
                    c.nombre AS categoria_nombre, u.nombre AS usuario_nombre 
            FROM entradas e
            INNER JOIN categorias c ON e.categoria_id = c.id
            INNER JOIN usuarios u ON e.usuario_id = u.id
            WHERE e.titulo LIKE ? OR e.descripcion LIKE ? 
            ORDER BY e.fecha DESC";
    $stmt = $db->prepare($sql);
    $buscar_param = '%' . $buscar . '%';
    $stmt->bind_param("ss", $buscar_param, $buscar_param);
} else {
    $sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, e.usuario_id, e.categoria_id, 
                    c.nombre AS categoria_nombre, u.nombre AS usuario_nombre 
            FROM entradas e
            INNER JOIN categorias c ON e.categoria_id = c.id
            INNER JOIN usuarios u ON e.usuario_id = u.id
            ORDER BY e.fecha DESC
            LIMIT 5";
    $stmt = $db->prepare($sql);
}

$stmt->execute();
$resultado = $stmt->get_result();
$entradas = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<h1>🖤 Últimos Lamentos</h1>

<?php if (empty($entradas)) : ?>
    <p>No se encontraron entradas.</p>
<?php else : ?>
    <?php foreach ($entradas as $entrada) : ?>
        <div class="entrada">
            <h2><?= htmlspecialchars($entrada["titulo"]) ?></h2>
            <p><strong>Categoría:</strong> <?= htmlspecialchars($entrada["categoria_nombre"]) ?></p>
            <p><strong>Autor:</strong> <?= htmlspecialchars($entrada["usuario_nombre"]) ?></p>
            <p><small><?= htmlspecialchars($entrada["fecha"]) ?></small></p>
            <p><?= nl2br(htmlspecialchars(substr($entrada["descripcion"], 0, 150))) ?>...</p>
            <a href="index.php?view=categorias/ver&id=<?= urlencode($entrada['categoria_id']) ?>&entrada_id=<?= urlencode($entrada['id']) ?>" class="btn btn-secondary">Ver más</a>

            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada['usuario_id']) : ?>
                
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

<?php include 'views/includes/modal.php'; ?>
