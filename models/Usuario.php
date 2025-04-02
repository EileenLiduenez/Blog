<?php/*
require_once "config/database.php";

class Usuario {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // 📌 1. Obtener un usuario por email
    public function obtenerPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 📌 2. Registrar un nuevo usuario
    public function registrar($nombre, $apellidos, $email, $password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, fecha) VALUES (?, ?, ?, ?, CURDATE())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $apellidos, $email, $password);
        return $stmt->execute();
    }

    // 📌 3. Obtener un usuario por su ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function actualizar($id, $nombre, $apellidos, $password = null) {
        if ($password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, password = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssi", $nombre, $apellidos, $password, $id);
        } else {
            $sql = "UPDATE usuarios SET nombre = ?, apellidos = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssi", $nombre, $apellidos, $id);
        }
        return $stmt->execute();
    }
}*/
?>
