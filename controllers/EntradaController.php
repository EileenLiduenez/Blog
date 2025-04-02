<?php/*
require_once "models/Entrada.php";

class EntradaController {
    private $entradaModel;

    public function __construct() {
        $this->entradaModel = new Entrada();
    }

    // 📌 1. Obtener todas las entradas (para el inicio)
    public function listarEntradas() {
        $entradas = $this->entradaModel->obtenerTodas();
        include "views/home.php";
    }

    // 📌 2. Obtener entradas por categoría
    public function listarPorCategoria($categoria_id) {
        $entradas = $this->entradaModel->obtenerPorCategoria($categoria_id);
        include "views/categorias/ver.php";
    }

    // 📌 3. Obtener las últimas 5 entradas para la página de inicio
    public function listarRecientes() {
        $entradas = $this->entradaModel->obtenerRecientes();
        include "views/home.php";
    }

    // 📌 4. Crear una nueva entrada (solo usuarios logueados)
    public function crearEntrada() {
        session_start();
        if (!isset($_SESSION["usuario"])) {
            echo "<script>alert('Debes iniciar sesión para crear una entrada.'); window.location.href='index.php';</script>";
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = $_POST["titulo"];
            $descripcion = $_POST["descripcion"];
            $usuario_id = $_SESSION["usuario"]["id"];
            $categoria_id = $_POST["categoria_id"];

            if ($this->entradaModel->crear($titulo, $descripcion, $usuario_id, $categoria_id)) {
                echo "<script>alert('Entrada creada correctamente.'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error al crear la entrada.');</script>";
            }
        }
    }

    // 📌 5. Editar una entrada (solo usuarios logueados y dueño de la entrada)
    public function editarEntrada($id) {
        session_start();
        if (!isset($_SESSION["usuario"])) {
            echo "<script>alert('Debes iniciar sesión para editar una entrada.'); window.location.href='index.php';</script>";
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = $_POST["titulo"];
            $descripcion = $_POST["descripcion"];
            $categoria_id = $_POST["categoria_id"];

            if ($this->entradaModel->editar($id, $titulo, $descripcion, $categoria_id)) {
                echo "<script>alert('Entrada actualizada correctamente.'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error al editar la entrada.');</script>";
            }
        }
    }

    // 📌 6. Eliminar una entrada (solo usuarios logueados y dueño de la entrada)
    public function eliminarEntrada($id) {
        session_start();
        if (!isset($_SESSION["usuario"])) {
            echo "<script>alert('Debes iniciar sesión para eliminar una entrada.'); window.location.href='index.php';</script>";
            return;
        }

        if ($this->entradaModel->eliminar($id)) {
            echo "<script>alert('Entrada eliminada correctamente.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error al eliminar la entrada.');</script>";
        }
    }
}*/
?>
