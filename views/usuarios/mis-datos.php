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
                <?php if (isset($_SESSION['usuario'])): ?>
            <h2>Mis datos</h2>

            <?php if (isset($_SESSION['completado'])): ?>
                <div class="alerta exito">
                    <?= $_SESSION['completado'] ?>
                </div>
            <?php elseif (isset($_SESSION['errores']['general'])): ?>
                <div class="alerta error">
                    <?= $_SESSION['errores']['general'] ?>
                </div>
            <?php endif; ?>

            <form action="index.php?controller=usuario&action=actualizarUsuario" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre'] ?>" required>

                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellidos'] ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?= $_SESSION['usuario']['email'] ?>" required>

                <input type="submit" value="Actualizar">
            </form>

            <?php Utils::borrarErrores(); ?>

        <?php else: ?>
            <p>Debes iniciar sesión para ver esta página.</p>
        <?php endif; ?>

    </div>

    <?php include 'views/layouts/footer.php'; ?>

</div>

    <script src="assets/js/script.js"></script>
</body>
</html>
