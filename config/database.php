<?php
class Database {
    public static function connect() {
        $db = new mysqli("localhost", "root", "", "blog");
        if ($db->connect_error) {
            die("Error de conexión: " . $db->connect_error);
        }
        return $db;
    }
}
?>