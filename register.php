<?php
session_start();
require_once "controllers/usuarioController.php";

$controller = new UsuarioController();
$controller->registrarUsuario();
?>
