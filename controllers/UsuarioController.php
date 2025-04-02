<?php
require_once "models/Usuario.php"; // Asegúrate de tener este modelo

class UsuarioController {

    public function loginUsuario() {
        require_once "config/database.php"; // Asegúrate de que este archivo conecta bien a la BD

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Llamar al modelo para obtener el usuario
            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->getByEmail($email);

            if ($usuario && password_verify($password, $usuario['password'])) {
                // Guardar datos en la sesión
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nombre' => $usuario['nombre'],
                    'email' => $usuario['email']
                ];
                header("Location: index.php"); // Redirigir a la página principal
                exit();
            } else {
                $_SESSION['error_login'] = "Credenciales incorrectas";
                header("Location: index.php");
                exit();
            }
        }
    }
}
?>
