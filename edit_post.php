<?php
require 'blog.sql';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$usuario_id = $_SESSION['usuario']['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);
    $categoria_id = $_POST['categoria'];

    $stmt = $conn->prepare("UPDATE entradas SET titulo=?, contenido=?, categoria_id=? WHERE id=? AND usuario_id=?");
    $stmt->bind_param("ssiii", $titulo, $contenido, $categoria_id, $id, $usuario_id);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error al actualizar entrada.";
    }
    $stmt->close();
}
?>
