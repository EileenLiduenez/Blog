<?php
require_once "config/database.php";

class Entrada {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getEntradas() {
        $sql = "SELECT * FROM entradas ORDER BY fecha DESC";
        $result = $this->db->query($sql);
        return $result;
    }

    public function crearEntrada($titulo, $contenido, $categoria_id, $usuario_id) {
        $sql = "INSERT INTO entradas (titulo, contenido, categoria_id, usuario_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssii", $titulo, $contenido, $categoria_id, $usuario_id);
        return $stmt->execute();
    }


    
}
?>
