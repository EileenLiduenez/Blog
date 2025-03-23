<?php
require_once "config/database.php";

class Entrada {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getEntradas() {
        $sql = "SELECT * FROM entradas ORDER BY fecha DESC";
        return $this->db->query($sql);
    }

    public function getUltimasEntradas($limite = 5) {
        $sql = "SELECT e.*, c.nombre AS categoria, u.nombre AS usuario 
                FROM entradas e
                JOIN categorias c ON e.categoria_id = c.id
                JOIN usuarios u ON e.usuario_id = u.id
                ORDER BY e.fecha DESC 
                LIMIT $limite";
        return $this->db->query($sql);
    }

    public function crearEntrada($titulo, $contenido, $categoria_id, $usuario_id) {
        $sql = "INSERT INTO entradas (titulo, descripcion, categoria_id, usuario_id, fecha) 
                VALUES (?, ?, ?, ?, CURDATE())";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssii", $titulo, $contenido, $categoria_id, $usuario_id);
        return $stmt->execute();
    }

    public function obtenerEntradaPorId($id) {
        $sql = "SELECT * FROM entradas WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
