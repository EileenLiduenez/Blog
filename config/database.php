<?php
class Database {
    public static function conectar() { // Debe ser "conectar"
        $conexion = new mysqli("localhost", "root", "", "blog");
        $conexion->set_charset("utf8");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        return $conexion;
    }
}
?>
