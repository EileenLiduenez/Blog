<?php
require_once 'models/Entrada.php'; // Asegúrate de requerir el modelo correcto

class CategoriaController { // Ojo con el nombre de la clase
    private $entradaModel;

    public function __construct() {
        $this->entradaModel = new Entrada();
    }

    public function obtenerEntradasPorCategoria($id_categoria) {
        return $this->entradaModel->obtenerPorCategoria($id_categoria);
    }
}
?>
