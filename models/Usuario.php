<?php
require_once "config/database.php";

class Usuario {

    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function registrar($nombre, $apellidos, $email, $password) {
        $sql = "INSERT INTO usuarios (nombre, apellidos, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $apellidos, $email, $password]);
    }

    public function getByEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc(); 
    }

    public function actualizar($id, $nombre, $apellidos, $email) {
        $sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, email = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $apellidos, $email, $id);
        return $stmt->execute();
    }
    
    
    
}
?>
