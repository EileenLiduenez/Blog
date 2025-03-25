<?php
require_once "config/database.php";

class Entrada {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // 📌 1. Obtener TODAS las entradas (para el inicio)
    public function obtenerTodas() {
        $sql = "SELECT * FROM entradas ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 2. Obtener entradas por categoría
    public function obtenerPorCategoria($categoria_id) {
        $sql = "SELECT * FROM entradas WHERE categoria_id = ? ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$categoria_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // 📌 3. Obtener las últimas 5 entradas (para la página de inicio)
    public function obtenerRecientes() {
        $sql = "SELECT * FROM entradas ORDER BY fecha DESC LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 4. Obtener una entrada por su ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM entradas WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 📌 5. Crear una nueva entrada
    public function crear($titulo, $descripcion, $usuario_id, $categoria_id) {
        $sql = "INSERT INTO entradas (titulo, descripcion, usuario_id, categoria_id, fecha) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$titulo, $descripcion, $usuario_id, $categoria_id]);
    }

    // 📌 6. Editar una entrada existente
    public function editar($id, $titulo, $descripcion, $categoria_id) {
        $sql = "UPDATE entradas SET titulo = ?, descripcion = ?, categoria_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$titulo, $descripcion, $categoria_id, $id]);
    }

    // 📌 7. Eliminar una entrada
    public function eliminar($id) {
        $sql = "DELETE FROM entradas WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
