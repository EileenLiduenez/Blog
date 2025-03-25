<h1>🖤 Últimos Lamentos</h1>

<?php if (empty($entradas)) : ?>
    <p>No hay entradas recientes.</p>
<?php else : ?>
    <?php foreach ($entradas as $entrada) : ?>
        <div class="entrada">
            <h2><?= htmlspecialchars($entrada["titulo"]) ?></h2>
            <p><?= nl2br(htmlspecialchars(substr($entrada["descripcion"], 0, 150))) ?>...</p>
            <p><small>Publicado el <?= $entrada["fecha"] ?></small></p>
            <a href="index.php?view=categorias/ver&id=<?= $entrada['categoria_id'] ?>" class="btn btn-secondary">Ver más</a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
