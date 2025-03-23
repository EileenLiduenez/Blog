<?php
require_once "core/Controller.php";
require_once "models/Entrada.php";

class EntradaController extends Controller {
    public function index() {
        $entradaModel = new Entrada(); 
        $entradas = $entradaModel->getEntradas(); 
        $this->loadView("entradas/index", ["entradas" => $entradas]); 
    }
}
?>
