<?php
require '..blog.sql';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$usuario_id = $_SESSION['usuario']['id'];

$stmt = $conn->prepare("DELETE FROM entradas WHERE id=? AND usuario_id=?");
$stmt->bind_param("ii", $id, $usuario_id);

if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Error al eliminar entrada.";
}
$stmt->close();
?>
