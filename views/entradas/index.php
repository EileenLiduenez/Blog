<?php require_once "views/layout/header.php"; ?>

<main id="principal">
    <h1>Últimas Entradas</h1>

    <?php while ($entrada = $entradas->fetch_assoc()): ?>
        <article>
            <h2><?= htmlspecialchars($entrada['titulo']) ?></h2>
            <p><?= substr(htmlspecialchars($entrada['descripcion']), 0, 100) ?>...</p>
            <small><?= htmlspecialchars($entrada['fecha']) ?> | Categoría: <?= htmlspecialchars($entrada['categoria']) ?></small>
            <br>
            <a href="index.php?controller=entrada&action=editar&id=<?= $entrada['id'] ?>">Editar</a>
            <a href="index.php?controller=entrada&action=eliminar&id=<?= $entrada['id'] ?>" 
                onclick="return confirm('¿Seguro que deseas eliminar esta entrada?');">
                Eliminar
            </a>
        </article>
    <?php endwhile; ?>
</main>

<?php require_once "views/layout/footer.php"; ?>
