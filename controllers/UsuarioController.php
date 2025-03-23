<?php
require_once "core/Controller.php";
require_once "models/Usuario.php";

class UsuarioController extends Controller {

    public function registro() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $usuarioModel = new Usuario();
            $resultado = $usuarioModel->crearUsuario($nombre, $email, $password);

            if ($resultado) {
                $_SESSION['mensaje'] = "Registro exitoso";
                $this->redirect("index.php?controller=usuario&action=login");
            } else {
                $_SESSION['error'] = "Error al registrar usuario";
                $this->redirect("index.php?controller=usuario&action=registro");
            }
        } else {
            $this->loadView("usuario/registro");
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->obtenerUsuarioPorEmail($email);

            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['usuario'] = $usuario;
                $this->redirect("index.php");
            } else {
                $_SESSION['error'] = "Credenciales incorrectas";
                $this->redirect("index.php?controller=usuario&action=login");
            }
        } else {
            $this->loadView("usuario/login");
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        $this->redirect("index.php");
    }
}
?>
