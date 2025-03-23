<?php
require_once "core/Controller.php";
require_once "models/Entrada.php";

class EntradaController extends Controller {

    public function index() {
        $entradaModel = new Entrada();
        $entradas = $entradaModel->getEntradas();
        $this->loadView("entradas/index", ["entradas" => $entradas]);
    }

    public function crear() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = trim($_POST['titulo']);
            $contenido = trim($_POST['contenido']);
            $categoria_id = $_POST['categoria'];
            $usuario_id = $_SESSION['usuario']['id'];

            $entradaModel = new Entrada();
            if ($entradaModel->crearEntrada($titulo, $contenido, $categoria_id, $usuario_id)) {
                header("Location: index.php?controller=entrada&action=index");
                exit();
            } else {
                echo "Error al crear la entrada.";
            }
        } else {
            $this->loadView("entradas/crear");
        }
    }

    public function editar() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }

        $entradaModel = new Entrada();
        $id = $_GET['id'];
        $entrada = $entradaModel->obtenerEntradaPorId($id);

        // 🔍 Verificar que el usuario sea el dueño de la entrada
        if ($entrada['usuario_id'] != $_SESSION['usuario']['id']) {
            echo "No tienes permiso para editar esta entrada.";
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = trim($_POST['titulo']);
            $contenido = trim($_POST['contenido']);
            $categoria_id = $_POST['categoria'];

            if ($entradaModel->editarEntrada($id, $titulo, $contenido, $categoria_id)) {
                header("Location: index.php?controller=entrada&action=index");
                exit();
            } else {
                echo "Error al actualizar la entrada.";
            }
        } else {
            $this->loadView("entradas/editar", ["entrada" => $entrada]);
        }
    }

    public function eliminar() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $entradaModel = new Entrada();
            $entrada = $entradaModel->obtenerEntradaPorId($id);

            // 🔍 Verificar que el usuario sea el dueño de la entrada antes de eliminar
            if ($entrada['usuario_id'] != $_SESSION['usuario']['id']) {
                echo "No tienes permiso para eliminar esta entrada.";
                return;
            }

            if ($entradaModel->eliminarEntrada($id)) {
                header("Location: index.php?controller=entrada&action=index");
                exit();
            } else {
                echo "Error al eliminar la entrada.";
            }
        }
    }
}
?>
