<?php
require_once 'config/database.php'; 

class Entrada {
    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function obtenerUltimasEntradas($limite = 5) {
        $sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, e.usuario_id, e.categoria_id, 
                        c.nombre AS categoria_nombre, u.nombre AS usuario_nombre 
                FROM entradas e
                INNER JOIN categorias c ON e.categoria_id = c.id
                INNER JOIN usuarios u ON e.usuario_id = u.id
                ORDER BY e.fecha ASC
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $limite);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerEntradasPorCategoria($id_categoria) {
        $sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, e.usuario_id, 
                        c.nombre AS categoria_nombre, u.nombre AS usuario_nombre
                FROM entradas e
                INNER JOIN categorias c ON e.categoria_id = c.id
                INNER JOIN usuarios u ON e.usuario_id = u.id
                WHERE e.categoria_id = ?
                ORDER BY e.fecha DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_categoria);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    

    public function crearEntrada($usuario_id, $categoria_id, $titulo, $descripcion) {
        $sql = "INSERT INTO entradas (usuario_id, categoria_id, titulo, descripcion, fecha) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iiss", $usuario_id, $categoria_id, $titulo, $descripcion);
        return $stmt->execute();
    }



    public function eliminarEntrada($id) {
        $sql = "DELETE FROM entradas WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function editarEntrada($id, $titulo, $descripcion) {
        $sql = "UPDATE entradas SET titulo = ?, descripcion = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi", $titulo, $descripcion, $id);
        return $stmt->execute();
    }
    
    
    


    public function buscarEntradas($termino) {
        $conexion = Database::conectar();
    
        $sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, c.nombre AS categoria_nombre, CONCAT(u.nombre, ' ', u.apellidos) AS usuario_nombre 
                FROM entradas e
                INNER JOIN categorias c ON e.categoria_id = c.id
                INNER JOIN usuarios u ON e.usuario_id = u.id
                WHERE e.titulo LIKE ? OR e.descripcion LIKE ?
                ORDER BY e.fecha DESC";
    
        $stmt = $conexion->prepare($sql);
        $busqueda = "%" . $termino . "%"; 
        $stmt->bind_param("ss", $busqueda, $busqueda);
        $stmt->execute();
    
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }  
}
?>