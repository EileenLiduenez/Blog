<?php
require_once "core/Controller.php";
require_once "models/Entrada.php";

class CrearController extends Controller {
    public function index() {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = trim($_POST['titulo']);
            $contenido = trim($_POST['contenido']);
            $categoria_id = $_POST['categoria'];
            $usuario_id = $_SESSION['usuario']['id'];

            if (!empty($titulo) && !empty($contenido)) {
                $entradaModel = new Entrada();
                if ($entradaModel->crearEntrada($titulo, $contenido, $categoria_id, $usuario_id)) {
                    header("Location: index.php?controller=entrada&action=index");
                    exit();
                } else {
                    echo "Error al crear la entrada.";
                }
            } else {
                echo "Todos los campos son obligatorios.";
            }
        } else {
            $this->loadView("entradas/crear");
        }
    }
}
?>
