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
}
?>
