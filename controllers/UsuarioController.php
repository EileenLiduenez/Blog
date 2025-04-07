<?php
require_once "models/Usuario.php";
require_once "helpers/utils.php";

class UsuarioController {

    public function loginUsuario() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->getByEmail($email);

            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nombre' => $usuario['nombre'],
                    'apellidos' => $usuario['apellidos'],
                    'email' => $usuario['email']
                ];
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['error_login'] = "Credenciales incorrectas";
                header("Location: index.php");
                exit();
            }
        }
    }

    public function registrarUsuario() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = trim($_POST['nombre']);
            $apellidos = trim($_POST['apellidos']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (!empty($nombre) && !empty($apellidos) && !empty($email) && !empty($password)) {
                $usuarioModel = new Usuario();
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);

                $registroExitoso = $usuarioModel->registrar($nombre, $apellidos, $email, $passwordHash);

                if ($registroExitoso) {
                    $_SESSION['mensaje'] = "Usuario registrado con éxito.";
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION['error_registro'] = "Error al registrar el usuario.";
                }
            } else {
                $_SESSION['error_registro'] = "Todos los campos son obligatorios.";
            }
        }
    }

    public function logout() {
        if (isset($_SESSION['usuario'])) {
            unset($_SESSION['usuario']);
        }

        header("Location: index.php");
        exit();
    }

    public function misDatos() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php");
            exit();
        }

        require_once 'views/usuarios/mis-datos.php';
    }

    public function actualizarUsuario() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['usuario'])) {
            $id = $_SESSION['usuario']['id'];
            $nombre = trim($_POST['nombre']);
            $apellidos = trim($_POST['apellidos']);
            $email = trim($_POST['email']);

            if (!empty($nombre) && !empty($apellidos) && !empty($email)) {
                $usuarioModel = new Usuario();
                $resultado = $usuarioModel->actualizar($id, $nombre, $apellidos, $email);

                if ($resultado) {
                    $_SESSION['usuario']['nombre'] = $nombre;
                    $_SESSION['usuario']['apellidos'] = $apellidos;
                    $_SESSION['usuario']['email'] = $email;
                    $_SESSION['completado'] = "Datos actualizados correctamente.";
                } else {
                    $_SESSION['errores']['general'] = "Error al actualizar.";
                }
            } else {
                $_SESSION['errores']['general'] = "Todos los campos son obligatorios.";
            }

            header("Location: index.php?controller=usuario&action=misDatos");
            exit();
        }
    }
}
?>
