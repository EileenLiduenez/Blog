<?php
require 'blog.sql;
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$id = $_SESSION['usuario']['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    if ($password) {
        $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, email=?, password=? WHERE id=?");
        $stmt->bind_param("sssi", $nombre, $email, $password, $id);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $nombre, $email, $id);
    }

    if ($stmt->execute()) {
        echo "Perfil actualizado.";
    } else {
        echo "Error al actualizar.";
    }
    $stmt->close();
}
?>
