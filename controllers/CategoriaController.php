<?php
require_once 'models/Entrada.php';

class CategoriaController { 
    private $entradaModel;

    public function __construct() {
        $this->entradaModel = new Entrada();
    }

    public function obtenerEntradasPorCategoria($id_categoria) {
        return $this->entradaModel->obtenerPorCategoria($id_categoria);
    }
}
?>
