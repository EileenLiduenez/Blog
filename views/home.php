<?php
require_once 'config/database.php';

$db = Database::conectar();


$sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, e.usuario_id, e.categoria_id, c.nombre AS categoria_nombre, u.nombre AS usuario_nombre 
        FROM entradas e
        INNER JOIN categorias c ON e.categoria_id = c.id
        INNER JOIN usuarios u ON e.usuario_id = u.id
        ORDER BY e.fecha DESC LIMIT 5";  // Puedes ajustar el límite de entradas mostradas

$stmt = $db->prepare($sql);
$stmt->execute();
$entradas = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<h1>🖤 Últimos Lamentos</h1>

<?php if (empty($entradas)) : ?>
    <p>No hay entradas recientes.</p>
<?php else : ?>
    <?php foreach ($entradas as $entrada) : ?>
        <div class="entrada">
            <h2><?= htmlspecialchars($entrada["titulo"]) ?></h2>
            <p><strong>Categoria:</strong> <?= htmlspecialchars($entrada["categoria_nombre"]) ?></p>
            <p><strong>Publicado por:</strong> <?= htmlspecialchars($entrada["usuario_nombre"]) ?></p>
            <p><small>Publicado el <?= htmlspecialchars($entrada["fecha"]) ?></small></p>
            <p><?= nl2br(htmlspecialchars(substr($entrada["descripcion"], 0, 150))) ?>...</p>
            <a href="index.php?view=categorias/ver&id=<?= urlencode($entrada['categoria_id']) ?>&entrada_id=<?= urlencode($entrada['id']) ?>" class="btn btn-secondary">Ver más</a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
