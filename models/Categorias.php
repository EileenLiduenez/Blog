<?php
require_once "config/database.php";

class Categoria {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // 📌 1. Obtener todas las categorías
    public function obtenerTodas() {
        $sql = "SELECT * FROM categorias ORDER BY id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 2. Obtener una categoría por su ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM categorias WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 📌 3. Obtener el ID de una categoría por su nombre
    public function obtenerIdPorNombre($nombre) {
        $sql = "SELECT id FROM categorias WHERE nombre = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nombre]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['id'] ?? null;
    }
}
?>
