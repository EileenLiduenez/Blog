<?php
session_start();
require_once 'config/database.php';

$db = Database::conectar();

$sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, e.usuario_id, e.categoria_id, c.nombre AS categoria_nombre, u.nombre AS usuario_nombre 
        FROM entradas e
        INNER JOIN categorias c ON e.categoria_id = c.id
        INNER JOIN usuarios u ON e.usuario_id = u.id
        ORDER BY e.fecha DESC LIMIT 5"; 

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
            <p><?= htmlspecialchars($entrada["categoria_nombre"]) ?></p>
            <p><?= htmlspecialchars($entrada["usuario_nombre"]) ?></p>
            <p><small><?= htmlspecialchars($entrada["fecha"]) ?></small></p>
            <p><?= nl2br(htmlspecialchars(substr($entrada["descripcion"], 0, 150))) ?>...</p>
            <a href="index.php?view=categorias/ver&id=<?= urlencode($entrada['categoria_id']) ?>&entrada_id=<?= urlencode($entrada['id']) ?>" class="btn btn-secondary">Ver más</a>

            <!-- Botones Editar y Eliminar solo si la entrada pertenece al usuario logueado -->
            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada['usuario_id']) : ?>
                
                <!-- Formulario para Editar -->
                <form action="index.php?controller=entrada&action=editar" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $entrada['id'] ?>">
                    <input type="hidden" name="titulo" value="<?= htmlspecialchars($entrada['titulo']) ?>">
                    <input type="hidden" name="descripcion" value="<?= htmlspecialchars($entrada['descripcion']) ?>">
                    <button type="submit" class="btn btn-warning">✏️ Editar</button>
                </form>

                <!-- Formulario para Eliminar -->
                <form action="index.php?controller=entrada&action=eliminar" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $entrada['id'] ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta entrada?')">🗑️ Eliminar</button>
                </form>

            <?php endif; ?>

        </div>
    <?php endforeach; ?>
<?php endif; ?>
