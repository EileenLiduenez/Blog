<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Blog/assets/css/style.css">
    <title>Blog Emo</title>
</head>
<body>

<?php require_once 'router.php'; ?>

<div class="todo">
    <?php include 'views/layouts/header.php'; ?>  

    <div id="contenedor">
        <main id="principal">
            <h1>Resultados de la búsqueda</h1>

            <?php if (!empty($resultados)) : ?>
                <?php foreach ($resultados as $entrada) : ?>
                    <article class="entrada">
                        <a href="#">
                            <h2><?= $entrada['titulo'] ?></h2>
                            <span class="fecha">
                                <?= $entrada['fecha'] ?> | <?= $entrada['categoria_nombre'] ?> | <?= $entrada['usuario_nombre'] ?>
                            </span>
                            <p><?= $entrada['descripcion'] ?></p>

                        </a>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No se encontraron resultados para tu búsqueda.</p>
            <?php endif; ?>
            
        </main>

        <aside id="sidebar">
            <?php include 'views/layouts/sidebar.php'; ?>
        </aside>
    </div>

    <?php include 'views/layouts/footer.php'; ?>

</div>

    <script src="assets/js/script.js"></script>
</body>
</html>
