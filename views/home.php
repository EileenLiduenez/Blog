<?php
require_once 'config/database.php';
require_once "config/session.php";



if (isset($_SESSION['mensaje'])): ?>
    <div class="mensaje exito"><?= $_SESSION['mensaje'] ?></div>
    <?php unset($_SESSION['mensaje']);
endif;

if (isset($_SESSION['error'])): ?>
    <div class="mensaje error"><?= $_SESSION['error'] ?></div>
    <?php unset($_SESSION['error']);
endif;

$db = Database::conectar();
$buscar = isset($_GET['q']) ? trim($_GET['q']) : ''; // Captura la búsqueda

if (!empty($buscar)) {
    $sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, e.usuario_id, e.categoria_id, 
                   c.nombre AS categoria_nombre, u.nombre AS usuario_nombre 
            FROM entradas e
            INNER JOIN categorias c ON e.categoria_id = c.id
            INNER JOIN usuarios u ON e.usuario_id = u.id
            WHERE e.titulo LIKE ? OR e.descripcion LIKE ? 
            ORDER BY e.fecha DESC";

    $stmt = $db->prepare($sql);
    $buscar_param = "%$buscar%";
    $stmt->bind_param("ss", $buscar_param, $buscar_param);
} else {
    $sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, e.usuario_id, e.categoria_id, 
                   c.nombre AS categoria_nombre, u.nombre AS usuario_nombre 
            FROM entradas e
            INNER JOIN categorias c ON e.categoria_id = c.id
            INNER JOIN usuarios u ON e.usuario_id = u.id
            ORDER BY e.fecha DESC LIMIT 5";

    $stmt = $db->prepare($sql);
}

$stmt->execute();
$entradas = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<h1>🖤 Últimos Lamentos</h1>

<?php if (empty($entradas)) : ?>
    <p>No se encontraron entradas.</p>
<?php else : ?>
    <?php foreach ($entradas as $entrada) : ?>
        <div class="entrada">
            <h2><?= htmlspecialchars($entrada["titulo"]) ?></h2>
            <p><?= htmlspecialchars($entrada["categoria_nombre"]) ?></p>
            <p><?= htmlspecialchars($entrada["usuario_nombre"]) ?></p>
            <p><small><?= htmlspecialchars($entrada["fecha"]) ?></small></p>
            <p><?= nl2br(htmlspecialchars(substr($entrada["descripcion"], 0, 150))) ?>...</p>

            <a href="index.php?view=<?= urlencode($entrada['categoria_nombre']) ?>#entrada-<?= $entrada['id'] ?>">
                Ver más
            </a>




            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada['usuario_id']) : ?>
                <button class="btn btn-warning"
                    onclick="abrirModalEditar('modalEditar<?= $entrada['id'] ?>')">
                    ✏️ Editar
                </button>

                <button class="btn btn-danger"
                    onclick="abrirModalEliminar('modalEliminar<?= $entrada['id'] ?>')">
                    🗑️ Eliminar
                </button>

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

window.addEventListener('DOMContentLoaded', () => {
        const hash = window.location.hash;
        if (hash) {
            const objetivo = document.querySelector(hash);
            if (objetivo) {
                objetivo.scrollIntoView({ behavior: 'smooth', block: 'center' });
                objetivo.style.backgroundColor = '#ffeeba'; 
                setTimeout(() => {
                    objetivo.style.backgroundColor = '';
                }, 1500);
            }
        }
    });
</script>
