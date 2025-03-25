<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Blog Emo</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>  

    <div id="contenedor" class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <main id="principal">
                    <?php  
                        if (isset($_GET['view'])) {
                            $view = $_GET['view'];  
                            $file = "views/$view.php";
                            if (file_exists($file)) {
                                include $file;
                            } else {
                                echo "<h2>Página no encontrada</h2>";
                            }
                        } else {
                            include "views/home.php"; // Carga las entradas recientes en el inicio
                        }
                    ?>
                </main>
            </div>
            <div class="col-md-4">
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Modal Editar Entrada -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel">✏️ Editar Entrada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="form-editar" method="POST">
                        <input type="hidden" id="edit-id" name="id">

                        <div class="mb-3">
                            <label for="edit-titulo" class="form-label">Título:</label>
                            <input type="text" class="form-control" id="edit-titulo" name="titulo" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-contenido" class="form-label">Contenido:</label>
                            <textarea class="form-control" id="edit-contenido" name="descripcion" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit-categoria" class="form-label">Categoría:</label>
                            <select class="form-select" id="edit-categoria" name="categoria_id">
                                <option value="1">Emo Love</option>
                                <option value="2">Sobre Emos</option>
                                <option value="3">Música</option>
                                <option value="4">Reflexiones</option>
                                <option value="5">Sobre Mí</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/interaccion.js"></script>
</body>
</html>
