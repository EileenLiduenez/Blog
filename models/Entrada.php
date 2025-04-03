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

    public function crearEntrada($usuario_id, $categoria_id, $titulo, $descripcion) {
        $sql = "INSERT INTO entradas (usuario_id, categoria_id, titulo, descripcion, fecha) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iiss", $usuario_id, $categoria_id, $titulo, $descripcion);
        return $stmt->execute();
    }

    // Editar una entrada en la base de datos
    public function editarEntrada($id, $titulo, $descripcion) {
        $sql = "UPDATE entradas SET titulo = ?, descripcion = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi", $titulo, $descripcion, $id);
        return $stmt->execute();
    }

    // Eliminar una entrada de la base de datos
    public function eliminarEntrada($id) {
        $sql = "DELETE FROM entradas WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
}
?>
