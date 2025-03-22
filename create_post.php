<?php
require '..blog.sql';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location:index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);
    $categoria_id = $_POST['categoria'];
    $usuario_id = $_SESSION['usuario']['id'];

    if (!empty($titulo) && !empty($contenido)) {
        $stmt = $conn->prepare("INSERT INTO entradas (titulo, contenido, categoria_id, usuario_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $titulo, $contenido, $categoria_id, $usuario_id);

        if ($stmt->execute()) {
            header("Location: ../index.php");
        } else {
            echo "Error al crear entrada.";
        }
        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>
