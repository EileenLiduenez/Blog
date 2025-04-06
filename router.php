<?php
require_once 'config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'] . 'Controller';

    $ruta_controlador = 'controllers/' . $nombre_controlador . '.php';

    if (file_exists($ruta_controlador)) {
        require_once $ruta_controlador;

        if (class_exists($nombre_controlador)) {
            $controlador = new $nombre_controlador();

            if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
                $action = $_GET['action'];
                $controlador->$action();
                exit(); // Para que no siga cargando el resto del index
            } else {
                echo "❌ Acción no encontrada.";
            }
        } else {
            echo "❌ Clase del controlador no existe.";
        }
    } else {
        echo "❌ Archivo del controlador no encontrado.";
    }
}
?>
