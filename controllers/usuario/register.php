<?php
require 'blg.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!empty($nombre) && !empty($email) && !empty($_POST['password'])) {
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellidos, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $apellidos, $email, $password);

        if ($stmt->execute()) {
            header("Location: index.php?registro=exitoso");
        } else {
            echo "ERROR";
        }
        $stmt->close();
    } else {
        echo "Es obligatorio rellenar la informacion.";
    }
}
?>