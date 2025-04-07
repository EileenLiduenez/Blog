<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Blog/assets/css/style.css">
    <title>Blog Emo</title>
</head>
<body>

<?php 
require_once 'router.php'; 
require_once 'helpers/utils.php';
?>



<div class="todo">
    <?php include 'views/layouts/header.php'; ?>  

    <div id="contenedor">
        <main id="principal">
            <?php include "views/layouts/main.php"; ?> 
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
