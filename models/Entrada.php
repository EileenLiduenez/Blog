<?php
require_once 'config/database.php'; // Cambiado para que apunte a config/

class Entrada {
    private $db;

    public function __construct() {
        $this->db = database::conectar(); // Ahora sí llamamos a conectar()
    }

    public function obtenerPorCategoria($id_categoria) {
        $stmt = $this->db->prepare("SELECT * FROM entradas WHERE categoria_id = ?");
        $stmt->bind_param("i", $id_categoria);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
