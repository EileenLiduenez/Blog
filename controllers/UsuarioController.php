<?php
require_once "models/Usuario.php"; // Asegúrate de tener este modelo

class UsuarioController {

    public function loginUsuario() {
        require_once "config/database.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->getByEmail($email);

            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nombre' => $usuario['nombre'],
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
        require_once "config/database.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = trim($_POST['nombre']);
            $apellidos = trim($_POST['apellidos']); // Capturar el apellido
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (!empty($nombre) && !empty($apellidos) && !empty($email) && !empty($password)) {
                $usuarioModel = new Usuario();
                
                // Hashear la contraseña
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                
                // Llamar al modelo para registrar al usuario
                $registroExitoso = $usuarioModel->registrar($nombre, $apellidos, $email, $passwordHash);

                if ($registroExitoso) {
                    $_SESSION['mensaje'] = "Usuario registrado con éxito. Ahora puedes iniciar sesión.";
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
}
?>
