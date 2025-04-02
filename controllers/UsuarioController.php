<?php/*
require_once "models/Usuario.php";

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    // 📌 1. Iniciar sesión
    public function login() {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];
    
            $usuario = $this->usuarioModel->obtenerPorEmail($email);
    
            if ($usuario && password_verify($password, $usuario["password"])) {
                $_SESSION["usuario"] = [
                    "id" => $usuario["id"],
                    "nombre" => $usuario["nombre"],
                    "apellidos" => $usuario["apellidos"],
                    "email" => $usuario["email"]
                ];
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Correo o contraseña incorrectos'); window.location.href='index.php';</script>";
            }
        }
    }

    // 📌 2. Cerrar sesión
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    // 📌 3. Registrar un nuevo usuario
    public function registrarUsuario() {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $email = $_POST["email"];
            $password = $_POST["password"]; // Ya se encripta en Usuario.php

            if ($this->usuarioModel->registrar($nombre, $apellidos, $email, $password)) {
                echo "<script>alert('Usuario registrado con éxito.'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error al registrar el usuario.');</script>";
            }
        }
    }

    // 📌 4. Ver perfil del usuario logueado
    public function misDatos() {
        session_start();
        if (!isset($_SESSION["usuario"])) {
            echo "<script>alert('Debes iniciar sesión para ver tus datos.'); window.location.href='index.php';</script>";
            return;
        }

        $usuario = $_SESSION["usuario"];
        include "views/usuarios/mis-datos.php";
    }

    // 📌 5. Editar usuario
    public function editarUsuario() {
        session_start();
        if (!isset($_SESSION["usuario"])) {
            echo "<script>alert('Debes iniciar sesión para editar tu perfil.'); window.location.href='index.php';</script>";
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $id = $_SESSION["usuario"]["id"];

            // Si el usuario escribió una nueva contraseña, la encriptamos
            if (!empty($_POST["password"])) {
                $password = $_POST["password"];
            } else {
                $password = null; // No cambiar la contraseña
            }

            if ($this->usuarioModel->actualizar($id, $nombre, $apellidos, $password)) {
                // Actualizamos los datos en la sesión
                $_SESSION["usuario"]["nombre"] = $nombre;
                $_SESSION["usuario"]["apellidos"] = $apellidos;

                echo "<script>alert('Datos actualizados correctamente.'); window.location.href='index.php?view=usuarios/mis-datos';</script>";
            } else {
                echo "<script>alert('Error al actualizar los datos.');</script>";
            }
        }
    }
}*/
?>
