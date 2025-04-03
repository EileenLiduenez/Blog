<?php
require_once "models/Entrada.php";
require_once "config/database.php";

class EntradaController {
    public function guardarEntrada() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();

            if (!isset($_SESSION['usuario'])) {
                die("Error: No hay sesión iniciada.");
            }

            $titulo = $_POST["titulo"] ?? "";
            $descripcion = $_POST["descripcion"] ?? "";
            $categoria_id = $_POST["categoria"] ?? "";
            $usuario_id = $_SESSION["usuario"]["id"];

            if (empty($titulo) || empty($descripcion) || empty($categoria_id)) {
                die("Error: Todos los campos son obligatorios.");
            }

            $entrada = new Entrada();
            if ($entrada->crearEntrada($usuario_id, $categoria_id, $titulo, $descripcion)) {
                header("Location: index.php");
                exit();
            } else {
                die("Error al insertar en la BD.");
            }
        } else {
            die("Error: No se recibió POST.");
        }
    }

      // Editar entrada
    public function editar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];

            $entrada = new Entrada();
            $resultado = $entrada->editarEntrada($id, $titulo, $descripcion);

            if ($resultado) {
                header("Location: index.php");
            } else {
                echo "Error al actualizar la entrada.";
            }
        }
    }

    // Eliminar entrada
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $entrada = new Entrada();
            $resultado = $entrada->eliminarEntrada($id);

            if ($resultado) {
                header("Location: index.php");
            } else {
                echo "Error al eliminar la entrada.";
            }
        }
    }
}
?>
