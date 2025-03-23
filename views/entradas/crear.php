<?php require_once "views/layout/header.php"; ?>
<?php require_once "models/Categoria.php"; ?>

<main id="principal">
    <h1>Crear Nueva Entrada</h1>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <p class="alerta-exito"><?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></p>
    <?php elseif (isset($_SESSION['error'])): ?>
        <p class="alerta-error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form action="index.php?controller=entrada&action=crear" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required>

        <label for="contenido">Contenido:</label>
        <textarea name="contenido" required></textarea>

        <label for="categoria">Categoría:</label>
        <select name="categoria">
            <?php
            $categoriaModel = new Categoria();
            $categorias = $categoriaModel->getCategorias();
            while ($categoria = $categorias->fetch_assoc()):
            ?>
                <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
            <?php endwhile; ?>
        </select>

        <input type="submit" value="Publicar">
    </form>
</main>

<?php require_once "views/layout/footer.php"; ?>
