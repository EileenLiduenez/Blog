<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nombre, $hash);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hash)) {
        $_SESSION['usuario'] = ['id' => $id, 'nombre' => $nombre];
        header("Location: index.php");
    } else {
        echo "La contraseña o el usuario no concuerdan.";
    }
    $stmt->close();
}
?>
