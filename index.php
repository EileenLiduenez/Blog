<?php
require_once "core/App.php";
require_once "core/Controller.php";
require_once "config/database.php";

// Iniciar sesión para manejar autenticación de usuarios
session_start();

// Incluir el encabezado y la barra lateral
require_once "views/layout/header.php";
require_once "views/layout/sidebar.php";

// Conectar con la base de datos
$db = Database::connect();

// Obtener las últimas entradas
require_once "models/Entrada.php";
$entradaModel = new Entrada();
$entradas = $entradaModel->getUltimasEntradas();
?>

<div id="principal">
    <h1>Últimas entradas</h1>

    <?php foreach ($entradas as $entradas) : ?>
        <article class="entrada">
            <a href="index.php?controller=entrada&action=ver&id=<?= $entradas['id'] ?>">
                <h2><?= htmlspecialchars($entradas['titulo']) ?></h2>
                <span class="fecha"><?= htmlspecialchars($entradas['categoria']) ?> | <?= $entradas['fecha'] ?></span>
                <p><?= substr(htmlspecialchars($entradas['descripcion']), 0, 150) ?>...</p>
            </a>
        </article>
    <?php endforeach; ?>

    <div id="ver-todas">
        <a href="index.php?controller=entrada&action=index">Ver todas las entradas</a>
    </div>
</div>

<?php require_once "views/layout/footer.php"; ?>
