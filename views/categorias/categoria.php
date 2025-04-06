<?php
require_once 'controllers/CategoriaController.php';
require_once 'config/session.php';
require_once 'config/database.php';

$db = Database::conectar();
$categoriaController = new CategoriaController();

// Recuperar la categoría desde la URL (decodificada por si tiene espacios)
$view_categoria = isset($_GET['view']) ? urldecode($_GET['view']) : null;

// Buscar el ID de la categoría según el nombre
$id_categoria = null;

if ($view_categoria !== null) {
    $stmt = $db->prepare("SELECT id FROM categorias WHERE nombre = ?");
    $stmt->bind_param("s", $view_categoria);
    $stmt->execute();
    $result = $stmt->get_result();
    $fila = $result->fetch_assoc();
    $id_categoria = $fila['id'] ?? null;
}

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

// Mostrar nombre original de la categoría
$nombre_categoria = $view_categoria ?: "Categoría Desconocida";
?>

<h1>🖤 Entradas en <?= htmlspecialchars($nombre_categoria) ?></h1>

<?php if (empty($entradas)) : ?>
    <p>No hay entradas en esta categoría.</p>
<?php else : ?>
    <?php foreach ($entradas as $entrada) : ?>
        <div class="entrada" id="entrada-<?= $entrada['id'] ?>">
            <h2><?= htmlspecialchars($entrada["titulo"]) ?></h2>
            <p><strong>Publicado por:</strong> <?= htmlspecialchars($entrada["usuario_nombre"]) ?></p>
            <p><small>Publicado el <?= htmlspecialchars($entrada["fecha"]) ?></small></p>
            <p><?= nl2br(htmlspecialchars($entrada["descripcion"])) ?></p>

            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada['usuario_id']) : ?>
                <button class="btn-warning" onclick="abrirModalEditar('modalEditar<?= $entrada['id'] ?>')">✏️ Editar</button>
                <button class="btn btn-danger" onclick="abrirModalEliminar('modalEliminar<?= $entrada['id'] ?>')">🗑️ Eliminar</button>
                <?php include 'views/includes/modal.php'; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<script>
function abrirModalEditar(id) {
    document.getElementById(id).style.display = "block";
}

function cerrarModalEditar(id) {
    document.getElementById(id).style.display = "none";
}

function abrirModalEliminar(id) {
    document.getElementById(id).style.display = "block";
}

function cerrarModalEliminar(id) {
    document.getElementById(id).style.display = "none";
}

window.onclick = function(event) {
    const modales = document.querySelectorAll('.modal-custom');
    modales.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
};
</script>
