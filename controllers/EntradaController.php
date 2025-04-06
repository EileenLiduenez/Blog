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



        public function eliminar(){
        session_start();
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            $entrada = new Entrada();

            if ($entrada->eliminarEntrada($id)) {
                $_SESSION['mensaje'] = "Entrada eliminada con éxito.";
            } else {
                $_SESSION['error'] = "Error al eliminar la entrada.";
            }
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    public function editar() {
        session_start(); // ← Añade esto
    
        if (isset($_POST['id'], $_POST['titulo'], $_POST['descripcion'])) {
            $id = $_POST['id'];
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
    
            if (!empty($titulo) && !empty($descripcion)) {
                $entradaModel = new Entrada();
    
                if ($entradaModel->editarEntrada($id, $titulo, $descripcion)) {
                    $_SESSION['mensaje'] = "Entrada actualizada con éxito.";
                } else {
                    $_SESSION['error'] = "Error al actualizar la entrada.";
                }
            }
        }
    
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    




    public function buscar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['busqueda'])) {
            $termino = trim($_POST['busqueda']);
    
            // Verificar que la búsqueda no esté vacía
            if (empty($termino)) {
                header("Location: index.php");
                exit();
            }
    
            // Importar el modelo y buscar las entradas
            $entradaModel = new Entrada();
            $resultados = $entradaModel->buscarEntradas($termino);
    
            // Cargar la vista con los resultados
            require_once 'views/entradas/busqueda.php';
        } else {
            header("Location: index.php");
            exit();
        }
    }
}
    
?>
